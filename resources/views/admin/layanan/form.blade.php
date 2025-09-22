<x-admin.dashboard-layout :title="($mode === 'edit' ? 'Edit Layanan' : 'Tambah Layanan') . ' - Dwi AC Mobil'">
  <div class="bg-white border-2 border-[#0F044C] p-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-montserrat-48 text-gray-900">
        {{ $mode === 'edit' ? 'EDIT LAYANAN' : 'TAMBAH LAYANAN' }}
      </h1>
      <a href="{{ route('admin.layanan') }}" class="px-4 py-2 border-2 border-gray-400 text-gray-700 hover:bg-gray-100 rounded-sm defparagraf">Kembali</a>
    </div>

      @if ($errors->any())
        <div class="mb-4 border border-red-300 bg-red-50 text-red-700 p-3">
          <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ $mode === 'edit' ? route('admin.layanan.update', $layanan->id_layanan) : route('admin.layanan.store') }}" class="space-y-5">
        @csrf
        @if ($mode === 'edit')
          @method('PUT')
        @endif

        <div>
          <label class="block defparagraf mb-1">Kategori</label>
          <select name="id_kategori" class="w-full border-2 border-gray-300 px-3 py-2 rounded-none">
            <option value="">Tanpa Kategori</option>
            @foreach(($kategoris ?? []) as $kat)
              {{-- @var $kat \App\Models\LayananKategori --}}
              <option value="{{ $kat->id_kategori }}" {{ (string)old('id_kategori', $layanan->id_kategori ?? '') === (string)$kat->id_kategori ? 'selected' : '' }}>{{ $kat->nama }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block defparagraf mb-1">Nama Layanan</label>
          <input type="text" name="nama" value="{{ old('nama', $layanan->nama ?? '') }}" class="w-full border-2 border-gray-300 px-3 py-2 rounded-none" required>
        </div>

        <div>
          <label class="block defparagraf mb-1">Harga Default (opsional)</label>
          <input type="number" name="harga_default" min="0" value="{{ old('harga_default', $layanan->harga_default ?? '') }}" class="w-full border-2 border-gray-300 px-3 py-2 rounded-none">
        </div>

        <div class="flex items-center gap-2">
          <input type="checkbox" name="is_active" id="layananActiveInput" value="1" {{ old('is_active', ($layanan->is_active ?? true)) ? 'checked' : '' }}>
          <label for="layananActiveInput" class="defparagraf">Aktif</label>
        </div>

        <div class="pt-3 flex gap-3">
          <a href="{{ route('admin.layanan') }}" class="px-4 py-2 border-2 border-gray-400 text-gray-700 rounded-none">Batal</a>
          <button type="submit" class="px-4 py-2 bg-[#141E61] text-white hover:bg-[#0F044C] rounded-none">Simpan</button>
        </div>
      </form>
  </div>
</x-admin.dashboard-layout>
