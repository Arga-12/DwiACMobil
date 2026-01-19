<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\LayananKategori;

class AdminLayananController extends Controller
{
    // GET /admin/layanan
    public function index(Request $request)
    {
        $kategoris = LayananKategori::orderBy("nama")->get();

        $query = Layanan::with("kategori")->orderByDesc("id_layanan");
        if ($request->filled("kategori")) {
            if ($request->get("kategori") === "null") {
                $query->whereNull("id_kategori");
            } else {
                $query->where("id_kategori", $request->integer("kategori"));
            }
        }
        if ($request->filled("q")) {
            $q = trim($request->string("q")->toString());
            $query->where("nama", "like", "%" . $q . "%");
        }
        $layanans = $query->paginate(15)->withQueryString();

        return view("admin.layanan.index", compact("kategoris", "layanans"));
    }

    // GET /admin/layanan/create
    public function create()
    {
        $kategoris = LayananKategori::orderBy("nama")->get();
        $layanan = new Layanan();
        return view("admin.layanan.form", [
            "mode" => "create",
            "layanan" => $layanan,
            "kategoris" => $kategoris,
        ]);
    }

    // GET /admin/layanan/{id}/edit
    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        $kategoris = LayananKategori::orderBy("nama")->get();
        return view("admin.layanan.form", [
            "mode" => "edit",
            "layanan" => $layanan,
            "kategoris" => $kategoris,
        ]);
    }

    // POST /admin/layanan
    public function storeLayanan(Request $request)
    {
        $data = $request->validate([
            "id_kategori" => "nullable|exists:layanan_kategori,id_kategori",
            "nama" => "required|string|max:150",
            "harga_default" => "nullable|integer|min:0",
            "permanen" => "nullable|boolean",
            // 'aktif' column is optional in schema; only fill if exists
        ]);

        $payload = [
            "id_kategori" => $data["id_kategori"] ?? null,
            "nama" => $data["nama"],
            "harga_default" => $data["harga_default"] ?? null,
        ];

        // Guard for optional aktif column
        if (
            $request->has("aktif") &&
            \Schema::hasColumn("layanan", "aktif")
        ) {
            $payload["aktif"] = (bool) $request->boolean("aktif");
        }

        // Guard for optional permanen column
        if (
            $request->has("permanen") &&
            \Schema::hasColumn("layanan", "permanen")
        ) {
            $payload["permanen"] = (bool) $request->boolean("permanen");
        }

        Layanan::create($payload);

        return redirect()
            ->route("admin.layanan")
            ->with("success", "Layanan berhasil dibuat");
    }

    // PUT /admin/layanan/{id}
    public function updateLayanan(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);
        $data = $request->validate([
            "id_kategori" => "nullable|exists:layanan_kategori,id_kategori",
            "nama" => "required|string|max:150",
            "harga_default" => "nullable|integer|min:0",
            "permanen" => "nullable|boolean",
        ]);

        $payload = [
            "id_kategori" => $data["id_kategori"] ?? null,
            "nama" => $data["nama"],
            "harga_default" => $data["harga_default"] ?? null,
        ];
        if (
            $request->has("aktif") &&
            \Schema::hasColumn("layanan", "aktif")
        ) {
            $payload["aktif"] = (bool) $request->boolean("aktif");
        }
        if (
            $request->has("permanen") &&
            \Schema::hasColumn("layanan", "permanen")
        ) {
            $payload["permanen"] = (bool) $request->boolean("permanen");
        }

        $layanan->update($payload);

        return redirect()
            ->route("admin.layanan")
            ->with("success", "Layanan berhasil diperbarui");
    }

    // DELETE /admin/layanan/{id}
    public function destroyLayanan($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();
        return redirect()
            ->route("admin.layanan")
            ->with("success", "Layanan berhasil dihapus");
    }

    // POST /admin/kategori
    public function storeKategori(Request $request)
    {
        $data = $request->validate([
            "nama" => "required|string|max:100",
            "slug" => "required|string|max:120|unique:layanan_kategori,slug",
        ]);

        LayananKategori::create([
            "nama" => $data["nama"],
            "slug" => $data["slug"],
        ]);

        return redirect()
            ->route("admin.layanan")
            ->with("success", "Kategori berhasil dibuat");
    }

    // DELETE /admin/kategori/{id}
    public function destroyKategori($id)
    {
        $kategori = LayananKategori::findOrFail($id);

        // Check if there are services using this category
        $layananCount = $kategori->layanan()->count();

        if ($layananCount > 0) {
            return redirect()
                ->route("admin.layanan")
                ->with(
                    "warning",
                    "Kategori '{$kategori->nama}' memiliki {$layananCount} layanan. Jika dihapus, layanan tersebut akan menjadi tidak berkategori.",
                );
        }

        $kategori->delete();
        return redirect()
            ->route("admin.layanan")
            ->with("success", "Kategori berhasil dihapus");
    }
}
