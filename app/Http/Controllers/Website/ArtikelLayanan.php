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
            ->when(Schema::hasColumn('artikel_layanan', 'is_published'), fn($q) =>
                $q->where('is_published', true)
            )
            ->orderByDesc('updated_at')
            ->get()
            ->map(function ($article) {
                $sessionKey = 'liked_artikel_' . $article->id;
                $article->liked = session()->has($sessionKey);
                return $article;
            });

        return view('layanan', compact('articles'));
    }

    public function home()
    {
        \Log::info('=== HOME PAGE LOAD ===');
        \Log::info('Session ID: ' . session()->getId());
        \Log::info('All session data: ', session()->all());

        $articles = Artikel::query()
            ->when(Schema::hasColumn('artikel_layanan', 'is_published'), fn($q) =>
                $q->where('is_published', true)
            )
            ->orderByDesc('updated_at')
            ->limit(6)
            ->get()
            ->map(function ($article) {
                $sessionKey = 'liked_artikel_' . $article->id;
                $article->liked = session()->has($sessionKey);
                
                \Log::info("Article ID: {$article->id}, Session Key: {$sessionKey}, Has Key: " . (session()->has($sessionKey) ? 'YES' : 'NO') . ", Liked: " . ($article->liked ? 'TRUE' : 'FALSE'));
                
                return $article;
            });

        \Log::info('=== HOME PAGE LOAD END ===');

        return view('beranda', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = Artikel::where('slug', $slug)->firstOrFail();
        return view('layanan-detail-contoh', compact('article'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $destination = public_path('images/artikel');
            if (!is_dir($destination)) {
                @mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['foto'] = 'images/artikel/' . $filename;
        }

        if (isset($data['points']) && is_string($data['points'])) {
            $data['points'] = $this->parsePoints($data['points']);
        }

        $article = Artikel::create($data);
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['ok' => true, 'data' => $article], 201);
        }
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dibuat.');
    }

    public function update(Request $request, int $id)
    {
        $article = Artikel::findOrFail($id);
        $data = $this->validatedData($request, $article->id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $destination = public_path('images/artikel');
            if (!is_dir($destination)) {
                @mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['foto'] = 'images/artikel/' . $filename;
        }

        if (isset($data['points']) && is_string($data['points'])) {
            $data['points'] = $this->parsePoints($data['points']);
        }

        $article->update($data);
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['ok' => true, 'data' => $article]);
        }
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Request $request, int $id)
    {
        $article = Artikel::findOrFail($id);
        $article->delete();
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['ok' => true]);
        }
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    protected function validatedData(Request $request, ?int $ignoreId = null): array
    {
        $slugRule = 'required|string|max:200|unique:artikel_layanan,slug';
        if ($ignoreId) {
            $slugRule .= ',' . $ignoreId . ',id';
        }
        return $request->validate([
            'title' => 'required|string|max:200',
            'slug' => $slugRule,
            'foto' => 'nullable',
            'description' => 'nullable|string',
            'points' => 'nullable',
            'duration_min' => 'nullable|integer|min:0|max:43200',
            'duration_max' => 'nullable|integer|min:0|max:43200',
            'price' => 'nullable|integer|min:0',
            'guarantee_days' => 'nullable|integer|min:0|max:3650',
            'is_published' => 'sometimes|boolean',
            'published_at' => 'nullable|date',
        ]);
    }

    protected function parsePoints(string $raw): array
    {
        $sep = str_contains($raw, "|") ? "|" : "\n";
        return collect(explode($sep, $raw))
            ->map(fn ($s) => trim($s))
            ->filter()
            ->values()
            ->all();
    }

    public function likesCount(Request $request, string $slug)
    {
        $article = Artikel::where('slug', $slug)->firstOrFail();
        $sessionKey = 'liked_artikel_' . $article->id;

        return response()->json([
            'ok'    => true,
            'likes' => (int) ($article->likes ?? 0),
            'liked' => $request->session()->has($sessionKey),
        ]);
    }

    public function like(Request $request, string $slug)
    {
        $article = Artikel::where('slug', $slug)->firstOrFail();
        $sessionKey = 'liked_artikel_' . $article->id;

        \Log::info('=== LIKE ACTION START ===');
        \Log::info('Slug: ' . $slug);
        \Log::info('Article ID: ' . $article->id);
        \Log::info('Session Key: ' . $sessionKey);
        \Log::info('Session ID: ' . $request->session()->getId());
        \Log::info('Before - Session has key: ' . ($request->session()->has($sessionKey) ? 'YES' : 'NO'));
        \Log::info('Before - All session data: ', $request->session()->all());

        // Cek apakah sudah like sebelumnya
        $alreadyLiked = $request->session()->has($sessionKey);

        if (!$alreadyLiked) {
            // Belum like → increment
            $article->increment('likes');
            $request->session()->put($sessionKey, true);
            $liked = true;
            \Log::info('Action: INCREMENT - Setting liked to TRUE');
        } else {
            // Sudah like → decrement
            if ((int) $article->likes > 0) {
                $article->decrement('likes');
            }
            $request->session()->forget($sessionKey);
            $liked = false;
            \Log::info('Action: DECREMENT - Setting liked to FALSE');
        }

        // Force save session
        $request->session()->save();

        \Log::info('After - Session has key: ' . ($request->session()->has($sessionKey) ? 'YES' : 'NO'));
        \Log::info('After - All session data: ', $request->session()->all());
        \Log::info('=== LIKE ACTION END ===');

        return response()->json([
            'ok' => true,
            'likes' => (int) $article->likes,
            'liked' => $liked,
            'debug' => [
                'session_id' => $request->session()->getId(),
                'session_key' => $sessionKey,
                'session_has_key' => $request->session()->has($sessionKey)
            ]
        ]);
    }

    public function unlike(Request $request, string $slug)
    {
        $article = Artikel::where('slug', $slug)->firstOrFail();
        $sessionKey = 'liked_artikel_' . $article->id;

        if ($request->session()->has($sessionKey) && (int) $article->likes > 0) {
            $article->decrement('likes');
            $request->session()->forget($sessionKey);
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['ok' => true, 'likes' => (int) $article->likes]);
        }
        return back()->with('success', 'Like dibatalkan.');
    }
}
