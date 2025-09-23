<x-admin.dashboard-layout title="Manajemen Layanan - Dwi AC Mobil">
    <!-- Dashboard Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 text-gray-900 uppercase mb-2">Manajemen Layanan</h1>
                    <p class="text-gray-600 defparagraf">Kelola layanan AC mobil yang tersedia.</p>
                </div>
                <a href="{{ route('admin.layanan.create') }}" class="bg-[#0F044C] hover:bg-[#141E61] text-white px-6 py-3 defparagraf font-medium flex items-center space-x-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah Layanan</span>
                </a>
            </div>
        </div>

        <!-- PENCARIAN & FILTER Section -->
          <div class="space-y-4">
            <!-- Search and Filter -->
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <form method="GET" class="relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama layanan..." class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf">
                                @if(request()->filled('kategori'))
                                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <form method="GET" class="flex items-center gap-3">
                          <select name="kategori" class="px-4 py-3 border-2 border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf">
                              <option value="">Semua Kategori</option>
                              <option value="null" {{ request('kategori') === 'null' ? 'selected' : '' }}>Tanpa Kategori</option>
                              @foreach(($kategoris ?? []) as $kat)
                                {{-- @var $kat \App\Models\LayananKategori --}}
                                <option value="{{ $kat->id_kategori }}" {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>{{ $kat->nama }}</option>
                              @endforeach
                          </select>
                          @if(request()->filled('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                          @endif
                          <button type="submit" class="px-4 py-3 bg-[#141E61] text-white hover:bg-[#0F044C] defparagraf">Filter</button>
                        </form>
                        <button type="button" onclick="openKategoriModal()" class="px-4 py-3 border-2 border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white transition-colors defparagraf">Tambah Kategori</button>
                    </div>
                </div>
          </div>

        <!-- DAFTAR KATEGORI Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900">DAFTAR KATEGORI</h2>
            
            <!-- Categories Table -->
            <div class="bg-white border-2 border-[#0F044C] shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#141E61]">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Nama Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Jumlah Layanan</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold defparagraf text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                          @forelse(($kategoris ?? []) as $kat)
                            {{-- @var $kat \App\Models\LayananKategori --}}
                            <tr>
                              <td class="px-6 py-4 text-sm text-gray-800">{{ $kat->id_kategori }}</td>
                              <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $kat->nama }}</td>
                              <td class="px-6 py-4 text-sm text-gray-600">{{ $kat->slug }}</td>
                              <td class="px-6 py-4 text-sm text-gray-800">{{ $kat->layanan()->count() }} layanan</td>
                              <td class="px-6 py-4 text-right text-sm">
                                <form method="POST" action="{{ route('admin.kategori.destroy', $kat->id_kategori) }}" onsubmit="return confirm('Hapus kategori ini? Layanan yang menggunakan kategori ini akan menjadi tidak berkategori.')">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="px-3 py-1 border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white transition-colors">Hapus</button>
                                </form>
                              </td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="5" class="px-6 py-6 text-center text-sm text-gray-600">Belum ada kategori.</td>
                            </tr>
                          @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- DAFTAR LAYANAN Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900">DAFTAR LAYANAN</h2>
            
            <!-- Services Table -->
            <div class="bg-white border-2 border-[#0F044C] shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#141E61]">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Nama Layanan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Harga Default</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold defparagraf text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                          @forelse(($layanans ?? []) as $ly)
                            {{-- @var $ly \App\Models\Layanan --}}
                            <tr>
                              <td class="px-6 py-4 text-sm text-gray-800">{{ $ly->id_layanan }}</td>
                              <td class="px-6 py-4 text-sm text-gray-600">
                                @if($ly->kategori)
                                  {{ $ly->kategori->nama }}
                                @else
                                  <span class="text-orange-600 italic">Tanpa Kategori</span>
                                @endif
                              </td>
                              <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $ly->nama }}</td>
                              <td class="px-6 py-4 text-sm text-gray-800">{{ $ly->harga_default ? 'Rp '.number_format($ly->harga_default,0,',','.') : '-' }}</td>
                              <td class="px-6 py-4 text-sm">
                                @if(($ly->is_active ?? true))
                                  <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs">Tersedia</span>
                                @else
                                  <span class="inline-flex items-center px-2 py-1 bg-gray-200 text-gray-700 text-xs">Belum Tersedia</span>
                                @endif
                              </td>
                              <td class="px-6 py-4 text-right text-sm">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.layanan.edit', $ly->id_layanan) }}" class="px-3 py-1 border-2 border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white transition-colors">Edit</a>
                                   <form method="POST" action="{{ route('admin.layanan.destroy', $ly->id_layanan) }}" onsubmit="return confirm('Hapus layanan ini?')">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="px-3 py-1 border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white transition-colors">Hapus</button>
                                   </form>
                                </div>
                              </td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="6" class="px-6 py-6 text-center text-sm text-gray-600">Belum ada layanan.</td>
                            </tr>
                          @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if(($layanans ?? null) && method_exists($layanans, 'links'))
            <div class="mt-4">
                {{ $layanans->links() }}
            </div>
            @endif
        </div>

        <!-- MODALS -->
        <!-- Catatan: Modal Layanan dihapus karena berpindah ke halaman khusus create/edit -->
        <!-- Create Kategori Modal -->
        <div id="kategoriModal" class="hidden fixed inset-0 bg-black/50 z-50 items-center justify-center">
          <div class="bg-white w-full max-w-lg border-2 border-[#0F044C] p-6 relative">
            <button type="button" class="absolute top-2 right-2 text-gray-600" onclick="closeKategoriModal()">✕</button>
            <h3 class="text-xl font-montserrat-48 mb-4">Tambah Kategori</h3>
            <form method="POST" action="{{ route('admin.kategori.store') }}">
              @csrf
              <div class="space-y-4">
                <div>
                  <label class="block defparagraf mb-1">Nama Kategori</label>
                  <input type="text" name="nama" class="w-full border-2 border-gray-300 px-3 py-2" required>
                </div>
                <div>
                  <label class="block defparagraf mb-1">Slug</label>
                  <input type="text" name="slug" class="w-full border-2 border-gray-300 px-3 py-2" placeholder="perawatan-berkala" required>
                </div>
              </div>
              <div class="mt-5 flex justify-end gap-3">
                <button type="button" onclick="closeKategoriModal()" class="px-4 py-2 border-2 border-gray-400 text-gray-700">Batal</button>
                <button type="submit" class="px-4 py-2 bg-[#141E61] text-white hover:bg-[#0F044C]">Simpan</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Modal/Filter Scripts -->
        <script>
          function openKategoriModal(){
            const m = document.getElementById('kategoriModal');
            m.classList.remove('hidden');
            m.classList.add('flex');
          }
          function closeKategoriModal(){
            const m = document.getElementById('kategoriModal');
            m.classList.add('hidden');
            m.classList.remove('flex');
          }
        </script>
    </div>
</x-admin.dashboard-layout>
