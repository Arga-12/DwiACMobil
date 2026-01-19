<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArtikelLayanan as Artikel;
use Illuminate\Support\Facades\Schema;

class ArtikelLayanan extends Controller
{
    public function index()
    {
        $articles = Artikel::query()
            ->when(
                Schema::hasColumn("artikel_layanan", "dipublikasi"),
                fn($q) => $q->where("dipublikasi", true),
            )
            ->orderByDesc("updated_at")
            ->get()
            ->map(function ($article) {
                $sessionKey = "liked_artikel_" . $article->id;
                $article->liked = session()->has($sessionKey);
                return $article;
            });

        return view("layanan", compact("articles"));
    }

    public function home()
    {
        try {
            $articles = Artikel::query()
                ->when(
                    Schema::hasColumn("artikel_layanan", "dipublikasi"),
                    fn($q) => $q->where("dipublikasi", true),
                )
                ->orderByDesc("updated_at")
                ->limit(6)
                ->get();

            // Safely handle empty collection
            if ($articles->isEmpty()) {
                $articles = collect();
            } else {
                $articles = $articles->map(function ($article) {
                    if ($article && $article->id) {
                        $sessionKey = "liked_artikel_" . $article->id;
                        $article->liked = session()->has($sessionKey);
                    }
                    return $article;
                });
            }

            return view("beranda", compact("articles"));
        } catch (\Exception $e) {
            \Log::error("Home page error: " . $e->getMessage());
            // Return empty collection on error
            $articles = collect();
            return view("beranda", compact("articles"));
        }
    }

    public function show(string $slug)
    {
        $article = Artikel::where("slug", $slug)->firstOrFail();
        return view("layanan-detail-contoh", compact("article"));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        if ($request->hasFile("foto")) {
            $file = $request->file("foto");
            $filename =
                time() .
                "_" .
                preg_replace("/\s+/", "_", $file->getClientOriginalName());
            // Store in storage/app/public/artikel
            $path = $file->storeAs("artikel", $filename, "public");
            $data["foto"] = $path; // Will be 'artikel/filename.jpg'
        }

        if (isset($data["poin"]) && is_string($data["poin"])) {
            $data["poin"] = $this->parsePoints($data["poin"]);
        }

        $article = Artikel::create($data);
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(["ok" => true, "data" => $article], 201);
        }
        return redirect()
            ->route("admin.artikel.index")
            ->with("success", "Artikel berhasil dibuat.");
    }

    public function update(Request $request, int $id)
    {
        $article = Artikel::findOrFail($id);
        $data = $this->validatedData($request, $article->id);

        // Handle foto upload
        if ($request->hasFile("foto")) {
            // Delete old foto if exists
            if (!empty($article->foto) && \Storage::disk('public')->exists($article->foto)) {
                \Storage::disk('public')->delete($article->foto);
            }
            
            $file = $request->file("foto");
            $filename =
                time() .
                "_" .
                preg_replace("/\s+/", "_", $file->getClientOriginalName());
            // Store in storage/app/public/artikel
            $path = $file->storeAs("artikel", $filename, "public");
            $data["foto"] = $path; // Will be 'artikel/filename.jpg'
        }
        // Note: If no file uploaded, 'foto' key won't exist in $data (handled in validatedData)

        if (isset($data["poin"]) && is_string($data["poin"])) {
            $data["poin"] = $this->parsePoints($data["poin"]);
        }

        $article->update($data);
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(["ok" => true, "data" => $article]);
        }
        return redirect()
            ->route("admin.artikel.index")
            ->with("success", "Artikel berhasil diperbarui.");
    }

    public function destroy(Request $request, int $id)
    {
        $article = Artikel::findOrFail($id);
        $article->delete();
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(["ok" => true]);
        }
        return redirect()
            ->route("admin.artikel.index")
            ->with("success", "Artikel berhasil dihapus.");
    }

    protected function validatedData(
        Request $request,
        ?int $ignoreId = null,
    ): array {
        $slugRule = "required|string|max:200|unique:artikel_layanan,slug";
        if ($ignoreId) {
            $slugRule .= "," . $ignoreId . ",id";
        }
        
        $rules = [
            "judul" => "required|string|max:200",
            "slug" => $slugRule,
            "foto" => "nullable|image|mimes:jpeg,jpg,png,webp|max:2048",
            "deskripsi" => "nullable|string",
            "poin" => "nullable",
            "durasi_min" => "nullable|integer|min:0|max:43200",
            "durasi_maks" => "nullable|integer|min:0|max:43200",
            "harga" => "nullable|integer|min:0",
            "garansi_hari" => "nullable|integer|min:0|max:3650",
            "dipublikasi" => "sometimes|boolean",
            "tanggal_publikasi" => "nullable|date",
        ];
        
        $validated = $request->validate($rules);
        
        // Remove foto from validated data if no file was uploaded
        // This prevents overwriting existing foto with null
        if (!$request->hasFile('foto')) {
            unset($validated['foto']);
        }
        
        return $validated;
    }

    protected function parsePoints(string $raw): array
    {
        $sep = str_contains($raw, "|") ? "|" : "\n";
        return collect(explode($sep, $raw))
            ->map(fn($s) => trim($s))
            ->filter()
            ->values()
            ->all();
    }

    public function likesCount(Request $request, string $slug)
    {
        $article = Artikel::where("slug", $slug)->firstOrFail();
        $sessionKey = "liked_artikel_" . $article->id;

        return response()->json([
            "ok" => true,
            "likes" => (int) ($article->suka ?? 0),
            "liked" => $request->session()->has($sessionKey),
        ]);
    }

    public function like(Request $request, string $slug)
    {
        $article = Artikel::where("slug", $slug)->firstOrFail();
        $sessionKey = "liked_artikel_" . $article->id;

        // Cek apakah sudah like sebelumnya
        $alreadyLiked = $request->session()->has($sessionKey);

        if (!$alreadyLiked) {
            // Belum like → increment
            $article->increment("suka");
            $request->session()->put($sessionKey, true);
            $message = "Artikel berhasil di-like.";
        } else {
            // Sudah like → decrement (toggle behavior)
            if ((int) $article->suka > 0) {
                $article->decrement("suka");
            }
            $request->session()->forget($sessionKey);
            $message = "Like dibatalkan.";
        }

        // Force save session
        $request->session()->save();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                "ok" => true,
                "likes" => (int) $article->suka,
                "liked" => !$alreadyLiked,
            ]);
        }
        
        return back()->with("success", $message);
    }

    public function unlike(Request $request, string $slug)
    {
        $article = Artikel::where("slug", $slug)->firstOrFail();
        $sessionKey = "liked_artikel_" . $article->id;

        if ($request->session()->has($sessionKey)) {
            if ((int) $article->suka > 0) {
                $article->decrement("suka");
            }
            $request->session()->forget($sessionKey);
            $request->session()->save();
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                "ok" => true,
                "likes" => (int) $article->suka,
                "liked" => false,
            ]);
        }
        
        return back()->with("success", "Like dibatalkan.");
    }
}
