<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::orderByDesc("id_galeri")->paginate(12);
        return view("admin.galeri.index", compact("galeris"));
    }

    public function create()
    {
        return view("admin.galeri.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "nama_foto" => "required|string|max:255",
            "foto" => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        // Handle image upload
        if ($request->hasFile("foto")) {
            $image = $request->file("foto");
            $imageName =
                time() .
                "_" .
                Str::slug($validated["nama_foto"]) .
                "." .
                $image->getClientOriginalExtension();
            $image->storeAs("galeri", $imageName, "public");
            $validated["foto"] = $imageName;
        }

        Galeri::create($validated);

        return redirect()
            ->route("admin.galeri.index")
            ->with("success", "Galeri berhasil ditambahkan.");
    }

    public function show($id)
    {
        $galeri = Galeri::findOrFail($id);
        return response()->json($galeri);
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view("admin.galeri.edit", compact("galeri"));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
            "nama_foto" => "required|string|max:255",
            "foto" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        // Handle image upload
        if ($request->hasFile("foto")) {
            // Delete old image if exists
            if (
                $galeri->foto &&
                Storage::disk("public")->exists("galeri/" . $galeri->foto)
            ) {
                Storage::disk("public")->delete("galeri/" . $galeri->foto);
            }

            $image = $request->file("foto");
            $imageName =
                time() .
                "_" .
                Str::slug($validated["nama_foto"]) .
                "." .
                $image->getClientOriginalExtension();
            $image->storeAs("galeri", $imageName, "public");
            $validated["foto"] = $imageName;
        }

        $galeri->update($validated);

        return redirect()
            ->route("admin.galeri.index")
            ->with("success", "Galeri berhasil diperbarui.");
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // Delete image file if exists
        if (
            $galeri->foto &&
            Storage::disk("public")->exists("galeri/" . $galeri->foto)
        ) {
            Storage::disk("public")->delete("galeri/" . $galeri->foto);
        }

        $galeri->delete();

        return redirect()
            ->route("admin.galeri.index")
            ->with("success", "Galeri berhasil dihapus.");
    }
}
