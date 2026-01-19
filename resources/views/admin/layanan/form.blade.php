<x-admin.dashboard-layout :title="($mode === 'edit' ? 'Edit Layanan' : 'Tambah Layanan') . ' - Dwi AC Mobil'">
  <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
    <!-- Hero / Header -->
    <div class="bg-gradient-to-br from-[#0F044C] via-[#1D2C90] to-[#192BC2] text-white rounded-2xl px-6 py-8 sm:px-8 sm:py-10 shadow-xl relative overflow-hidden">
        <div class="absolute inset-0 opacity-20 pointer-events-none">
            <div class="w-56 h-56 bg-white/10 rounded-full blur-3xl absolute -right-16 top-4"></div>
            <div class="w-40 h-40 bg-white/5 rounded-full blur-3xl absolute -left-10 bottom-0"></div>
        </div>
        <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="flex-1">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-montserrat-48 font-bold leading-tight mb-3">
                    {{ $mode === 'edit' ? 'Edit Layanan' : 'Tambah Layanan' }}
                </h1>
                <p class="text-sm sm:text-base text-white/80 defparagraf max-w-3xl">
                    {{ $mode === 'edit' ? 'Ubah informasi layanan yang sudah ada.' : 'Tambahkan layanan baru ke dalam sistem.' }}
                </p>
            </div>
            <a href="{{ route('admin.layanan') }}" class="bg-white text-[#0F044C] px-6 py-3 rounded-xl font-semibold defparagraf flex items-center space-x-2 shadow-lg hover:shadow-xl transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 md:p-8">
      @if ($errors->any())
        <div class="mb-6 border-2 border-red-300 bg-red-50 rounded-lg p-4">
          <h3 class="text-sm font-semibold text-red-800 mb-2">Terjadi kesalahan:</h3>
          <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ $mode === 'edit' ? route('admin.layanan.update', $layanan->id_layanan) : route('admin.layanan.store') }}" class="space-y-6">
        @csrf
        @if ($mode === 'edit')
          @method('PUT')
        @endif

        <div>
          <label class="block text-sm font-semibold text-[#0F044C] mb-1.5">Kategori</label>
          <select name="id_kategori" class="w-full border border-[#0F044C]/30 rounded-lg px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf bg-white">
            <option value="">Tanpa Kategori</option>
            @foreach(($kategoris ?? []) as $kat)
              {{-- @var $kat \App\Models\LayananKategori --}}
              <option value="{{ $kat->id_kategori }}" {{ (string)old('id_kategori', $layanan->id_kategori ?? '') === (string)$kat->id_kategori ? 'selected' : '' }}>{{ $kat->nama }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block text-sm font-semibold text-[#0F044C] mb-1.5">Nama Layanan <span class="text-red-500">*</span></label>
          <input type="text" name="nama" value="{{ old('nama', $layanan->nama ?? '') }}" class="w-full border border-[#0F044C]/30 rounded-lg px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf" required>
        </div>

        <div>
          <label class="block text-sm font-semibold text-[#0F044C] mb-1.5">Harga Default (opsional)</label>
          <input type="number" name="harga_default" min="0" value="{{ old('harga_default', $layanan->harga_default ?? '') }}" class="w-full border border-[#0F044C]/30 rounded-lg px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf" placeholder="Contoh: 50000">
          <p class="mt-1.5 text-xs text-gray-500">Harga default akan digunakan jika tidak ada harga khusus untuk mobil tertentu.</p>
        </div>

        <div class="space-y-4">
          <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg border border-gray-200">
            <input type="checkbox" name="aktif" id="layananActiveInput" value="1" {{ old('aktif', ($layanan->aktif ?? true)) ? 'checked' : '' }} class="w-4 h-4 text-[#0F044C] border-gray-300 rounded focus:ring-[#1D2C90]/30">
            <label for="layananActiveInput" class="text-sm font-medium text-gray-700 defparagraf cursor-pointer">Aktifkan layanan ini</label>
          </div>

          <div class="flex items-center gap-3 p-4 bg-orange-50 rounded-lg border border-orange-200">
            <input type="checkbox" name="permanen" id="layananPermanentInput" value="1" {{ old('permanen', ($layanan->permanen ?? false)) ? 'checked' : '' }} class="w-4 h-4 text-orange-600 border-orange-300 rounded focus:ring-orange-500/30">
            <div>
              <label for="layananPermanentInput" class="text-sm font-medium text-orange-800 defparagraf cursor-pointer">Layanan Permanen</label>
              <p class="text-xs text-orange-600 mt-1">Layanan ini akan otomatis ditambahkan ke setiap booking dan tidak ditampilkan di pilihan layanan</p>
            </div>
          </div>
        </div>

        <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-200">
          <a href="{{ route('admin.layanan') }}" class="px-4 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition-colors font-medium">Batal</a>
          <button type="submit" class="px-4 py-2.5 bg-gradient-to-r from-[#0F044C] to-[#1D2C90] text-white rounded-lg text-sm font-semibold hover:opacity-95 transition-all duration-200 shadow-md">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</x-admin.dashboard-layout>
