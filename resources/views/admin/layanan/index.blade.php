<x-admin.dashboard-layout title="Manajemen Layanan - Dwi AC Mobil">
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Hero / Header -->
        <div class="bg-gradient-to-br from-[#0F044C] via-[#1D2C90] to-[#192BC2] text-white rounded-2xl px-6 py-8 sm:px-8 sm:py-10 shadow-xl relative overflow-hidden">
            <div class="absolute inset-0 opacity-20 pointer-events-none">
                <div class="w-56 h-56 bg-white/10 rounded-full blur-3xl absolute -right-16 top-4"></div>
                <div class="w-40 h-40 bg-white/5 rounded-full blur-3xl absolute -left-10 bottom-0"></div>
            </div>
            <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex-1">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-montserrat-48 font-bold leading-tight mb-3">Manajemen Layanan</h1>
                    <p class="text-sm sm:text-base text-white/80 defparagraf max-w-3xl">
                        Kelola layanan AC mobil yang tersedia untuk pelanggan.
                    </p>
                </div>
                <a href="{{ route('admin.layanan.create') }}" class="bg-white text-[#0F044C] px-6 py-3 rounded-xl font-semibold defparagraf flex items-center space-x-2 shadow-lg hover:shadow-xl transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah Layanan</span>
                </a>
            </div>
        </div>

        <!-- Pencarian & Filter -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-4 md:p-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="relative md:col-span-2">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text"
                           id="searchInput"
                           placeholder="Cari nama layanan..."
                           class="w-full pl-10 pr-4 py-3 border border-[#0F044C]/30 rounded-xl focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf bg-white"
                           autocomplete="off">
                </div>
                <div class="flex gap-3">
                    <select id="categorySelect"
                            class="flex-1 px-4 py-3 border border-[#0F044C]/30 rounded-xl focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf bg-white">
                        <option value="">Semua Kategori</option>
                        <option value="null">Tanpa Kategori</option>
                        @foreach(($kategoris ?? []) as $kat)
                            {{-- @var $kat \App\Models\LayananKategori --}}
                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama }}</option>
                        @endforeach
                    </select>
                    <button type="button" onclick="openKategoriModal()" class="px-4 py-3 border border-[#0F044C] text-[#0F044C] rounded-xl font-semibold defparagraf hover:bg-[#0F044C] hover:text-white transition-all duration-200 whitespace-nowrap">Kategori</button>
                </div>
            </div>
        </div>

        <!-- DAFTAR KATEGORI Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl font-montserrat-48 text-gray-900 font-bold">DAFTAR KATEGORI</h2>

            <!-- Categories Table -->
            <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-[#0F044C] to-[#1D2C90]">
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
                            <tr class="hover:bg-gray-50 transition-colors">
                              <td class="px-6 py-4 text-sm text-gray-800">{{ $kat->id_kategori }}</td>
                              <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $kat->nama }}</td>
                              <td class="px-6 py-4 text-sm text-gray-600">{{ $kat->slug }}</td>
                              <td class="px-6 py-4 text-sm text-gray-800">{{ $kat->layanan()->count() }} layanan</td>
                              <td class="px-6 py-4 text-right text-sm">
                                <form method="POST" action="{{ route('admin.kategori.destroy', $kat->id_kategori) }}" onsubmit="return confirm('Hapus kategori ini? Layanan yang menggunakan kategori ini akan menjadi tidak berkategori.')" class="inline">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="px-3 py-1.5 border border-red-600 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all duration-200 text-xs font-medium">Hapus</button>
                                </form>
                              </td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-600">Belum ada kategori.</td>
                            </tr>
                          @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- DAFTAR LAYANAN Section -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-lg sm:text-xl font-montserrat-48 text-gray-900 font-bold">DAFTAR LAYANAN</h2>
                <div class="text-sm text-gray-600 defparagraf">
                    Menampilkan: <span class="font-semibold text-[#0F044C]" data-total-count>{{ ($layanans ?? collect())->count() }}</span> dari <span class="font-semibold text-[#0F044C]">{{ ($layanans ?? collect())->count() }}</span> layanan
                </div>
            </div>

            <!-- Services Card Grid -->
            @if(($layanans ?? collect())->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">
                    @foreach($layanans as $ly)
                        {{-- @var $ly \App\Models\Layanan --}}
                        <div class="layanan-card bg-white border border-[#0F044C]/20 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 overflow-hidden group"
                             data-id="{{ $ly->id_layanan }}"
                             data-name="{{ strtolower($ly->nama) }}"
                             data-category="{{ $ly->kategori ? $ly->kategori->id_kategori : 'null' }}"
                             data-category-name="{{ $ly->kategori ? strtolower($ly->kategori->nama) : 'tanpa kategori' }}">
                            <div class="p-5">
                                <!-- Header dengan Icon -->
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-2 flex-wrap">
                                            @if($ly->kategori)
                                                <span class="px-2.5 py-1 bg-gradient-to-r from-[#1D2C90]/10 to-[#1D2C90]/5 text-[#1D2C90] rounded-lg text-xs font-semibold border border-[#1D2C90]/20 whitespace-nowrap">
                                                    {{ $ly->kategori->nama }}
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 bg-orange-50 text-orange-600 rounded-lg text-xs font-semibold border border-orange-200 whitespace-nowrap">
                                                    Tanpa Kategori
                                                </span>
                                            @endif
                                            @if(($ly->is_active ?? true))
                                                <span class="inline-flex items-center px-2 py-0.5 bg-green-100 text-green-800 rounded-lg text-xs font-medium">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 bg-gray-200 text-gray-700 rounded-lg text-xs font-medium">
                                                    Nonaktif
                                                </span>
                                            @endif
                                            @if(($ly->permanen ?? false))
                                                <span class="inline-flex items-center px-2 py-0.5 bg-amber-100 text-amber-800 rounded-lg text-xs font-medium">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 17a2 2 0 0 1-2-2c0-1.11.89-2 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2m6 3V10H6v10zm0-12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10c0-1.11.89-2 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3"/>
                                                    </svg>
                                                    Permanen
                                                </span>
                                            @endif
                                        </div>
                                        <h3 class="text-base font-montserrat-48 font-bold text-[#0F044C] mb-1 line-clamp-2 group-hover:text-[#1D2C90] transition-colors">
                                            {{ $ly->nama }}
                                        </h3>
                                        <p class="text-xs text-gray-400 defparagraf">ID: {{ $ly->id_layanan }}</p>
                                    </div>
                                    <div class="flex-shrink-0 ml-3">
                                        <div class="w-12 h-12 bg-gradient-to-br from-[#0F044C]/10 to-[#1D2C90]/10 rounded-lg flex items-center justify-center border border-[#0F044C]/20 group-hover:from-[#0F044C]/20 group-hover:to-[#1D2C90]/20 transition-all">
                                            <svg class="w-6 h-6 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Harga -->
                                <div class="border-t border-gray-200 pt-3 mb-4">
                                    <p class="text-xs text-gray-500 defparagraf mb-1">Harga Default</p>
                                    @if($ly->harga_default)
                                        <p class="text-lg font-montserrat-36 font-bold text-[#0F044C]">
                                            Rp {{ number_format($ly->harga_default, 0, ',', '.') }}
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-400 italic">Tidak ada harga default</p>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="flex items-center gap-2 pt-3 border-t border-gray-200">
                                    <a href="{{ route('admin.layanan.edit', $ly->id_layanan) }}" class="flex-1 px-3 py-2 border border-[#0F044C] text-[#0F044C] rounded-lg hover:bg-[#0F044C] hover:text-white transition-all duration-200 text-xs font-semibold text-center">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.layanan.destroy', $ly->id_layanan) }}" onsubmit="return confirm('Hapus layanan ini?')" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-3 py-2 border border-red-600 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all duration-200 text-xs font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-12 text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada layanan</h3>
                    <p class="text-sm text-gray-600 mb-6">Mulai dengan menambahkan layanan baru untuk pelanggan.</p>
                    <a href="{{ route('admin.layanan.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#0F044C] to-[#1D2C90] text-white rounded-xl font-semibold hover:opacity-95 transition-all duration-200 shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Layanan Pertama
                    </a>
                </div>
            @endif

            @if(($layanans ?? null) && method_exists($layanans, 'links') && $layanans->hasPages())
            <div class="mt-6">
                {{ $layanans->links() }}
            </div>
            @endif
        </div>

        <!-- MODALS -->
        <!-- Create Kategori Modal -->
        <div id="kategoriModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 items-center justify-center px-4">
          <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-6 relative">
            <button type="button" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition-colors" onclick="closeKategoriModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
            <h3 class="text-lg font-montserrat-48 text-gray-900 font-bold mb-1">Tambah Kategori</h3>
            <p class="text-sm text-gray-500 mb-5">Buat kategori baru untuk mengelompokkan layanan.</p>
            <form method="POST" action="{{ route('admin.kategori.store') }}">
              @csrf
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-semibold text-[#0F044C] mb-1.5">Nama Kategori</label>
                  <input type="text" name="nama" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 transition-colors" required>
                </div>
                <div>
                  <label class="block text-sm font-semibold text-[#0F044C] mb-1.5">Slug</label>
                  <input type="text" name="slug" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 transition-colors" placeholder="perawatan-berkala" required>
                </div>
              </div>
              <div class="mt-5 flex justify-end gap-3 pt-2">
                <button type="button" onclick="closeKategoriModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-[#0F044C] to-[#1D2C90] text-white rounded-lg text-sm font-semibold hover:opacity-95 transition-all duration-200">Simpan</button>
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

          // Real-time filtering (client-side, like antrian page)
          (function() {
            const searchInput = document.getElementById('searchInput');
            const categorySelect = document.getElementById('categorySelect');

            if (!searchInput || !categorySelect) return;

            function applyFilters() {
              const searchValue = (searchInput.value || '').toLowerCase().trim();
              const categoryValue = categorySelect.value || '';

              const cards = document.querySelectorAll('.layanan-card');
              let visibleCount = 0;

              cards.forEach(function(card) {
                const cardId = (card.getAttribute('data-id') || '').toString();
                const cardName = (card.getAttribute('data-name') || '').toLowerCase();
                const cardCategory = card.getAttribute('data-category') || '';
                const cardCategoryName = (card.getAttribute('data-category-name') || '').toLowerCase();

                // Match search query
                const matchSearch = !searchValue ||
                  cardId.includes(searchValue) ||
                  cardName.includes(searchValue) ||
                  cardCategoryName.includes(searchValue);

                // Match category
                const matchCategory = !categoryValue || cardCategory === categoryValue;

                // Show/hide card
                if (matchSearch && matchCategory) {
                  card.style.display = '';
                  visibleCount++;
                } else {
                  card.style.display = 'none';
                }
              });

              // Update total count if element exists
              const totalCountEl = document.querySelector('[data-total-count]');
              if (totalCountEl) {
                totalCountEl.textContent = visibleCount;
              }
            }

            // Apply filters on input/change
            searchInput.addEventListener('input', applyFilters);
            categorySelect.addEventListener('change', applyFilters);

            // Apply filters on page load (in case there are URL params)
            applyFilters();
          })();
        </script>
    </div>
</x-admin.dashboard-layout>
