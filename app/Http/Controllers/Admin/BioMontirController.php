<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BioMontir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BioMontirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bioMontir = BioMontir::orderBy("created_at", "desc")->get();

        return view("admin.montir.index", compact("bioMontir"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.montir.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required|string|max:255",
            "peringkat" => "required|string|max:255",
            "email" => "required|email|unique:bio_montir,email",
            "nomor_telepon" => "required|string|max:20",
            "kutipan" => "required|string",
            "foto" => "nullable|image|mimes:jpeg,jpg,png|max:2048",
        ]);

        $data = $request->only([
            "nama",
            "peringkat",
            "email",
            "nomor_telepon",
            "kutipan",
        ]);

        // Handle photo upload
        if ($request->hasFile("foto")) {
            $foto = $request->file("foto");
            $filename = time() . "_" . $foto->getClientOriginalName();
            $foto->storeAs("montir", $filename, "public");
            $data["foto"] = $filename;
        }

        BioMontir::create($data);

        return redirect()
            ->route("admin.montir.index")
            ->with("success", "Data montir berhasil ditambahkan");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BioMontir $montir)
    {
        return view("admin.montir.edit", compact("montir"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BioMontir $montir)
    {
        $request->validate([
            "nama" => "required|string|max:255",
            "peringkat" => "required|string|max:255",
            "email" => [
                "required",
                "email",
                Rule::unique("bio_montir")->ignore($montir->id),
            ],
            "nomor_telepon" => "required|string|max:20",
            "kutipan" => "required|string",
            "foto" => "nullable|image|mimes:jpeg,jpg,png|max:2048",
        ]);

        $data = $request->only([
            "nama",
            "peringkat",
            "email",
            "nomor_telepon",
            "kutipan",
        ]);

        // Handle photo upload
        if ($request->hasFile("foto")) {
            // Delete old photo if exists
            if (
                $montir->foto &&
                Storage::disk("public")->exists("montir/" . $montir->foto)
            ) {
                Storage::disk("public")->delete("montir/" . $montir->foto);
            }

            $foto = $request->file("foto");
            $filename = time() . "_" . $foto->getClientOriginalName();
            $foto->storeAs("montir", $filename, "public");
            $data["foto"] = $filename;
        }

        $montir->update($data);

        return redirect()
            ->route("admin.montir.index")
            ->with("success", "Data montir berhasil diperbarui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BioMontir $montir)
    {
        // Delete photo if exists
        if (
            $montir->foto &&
            Storage::disk("public")->exists("montir/" . $montir->foto)
        ) {
            Storage::disk("public")->delete("montir/" . $montir->foto);
        }

        $montir->delete();

        return redirect()
            ->route("admin.montir.index")
            ->with("success", "Data montir berhasil dihapus");
    }
}
