<x-admin.dashboard-layout title="Manajemen Antrian - Dwi AC Mobil">
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Header -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 text-gray-900 uppercase mb-2">Manajemen Antrian</h1>
                    <p class="text-gray-600 defparagraf">Pantau antrian, konfirmasi harga, dan servis yang sudah selesai.</p>
                </div>
                <button onclick="openCreateModal()" class="bg-[#141E61] hover:bg-[#0F044C] text-white px-6 py-3 defparagraf font-medium flex items-center space-x-2 transition-colors rounded-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah Antrian</span>
                </button>
            </div>
        </div>

        <!-- Pencarian & Filter -->
        <div class="space-y-4">
            {{-- <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-semibold">PENCARIAN & FILTER</h2> --}}
            <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 md:p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    <div class="relative col-span-2">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input id="q" type="text" placeholder="Cari ID/Nama/Layanan/Plat..." class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf" />
                    </div>
                    <div>
                        <select id="f-status" class="w-full px-4 py-3 border-2 border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf">
                            <option value="">Semua Status</option>
                            <option value="waiting">Sedang Antri</option>
                            <option value="in_progress">Sedang Dikerjakan</option>
                            <option value="need_confirmation">Butuh Konfirmasi Harga</option>
                            <option value="completed">Selesai Servis</option>
                        </select>
                    </div>
                    <div>
                        <select id="f-service" class="w-full px-4 py-3 border-2 border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf">
                            <option value="">Semua Layanan</option>
                            <option value="Isi Freon">Isi Freon</option>
                            <option value="Ganti Oli">Ganti Oli</option>
                            <option value="Service AC">Service AC</option>
                            <option value="Cuci Evaporator">Cuci Evaporator</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        @php
            $queue = collect($queueData ?? []);
            $byStatus = $queue->groupBy('status');
            $waiting = $byStatus->get('waiting', collect());
            $inProgress = $byStatus->get('in_progress', collect());
            $needConfirmation = $byStatus->get('need_confirmation', collect());
            $completed = $byStatus->get('completed', collect());
        @endphp

        <!-- Ringkasan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 flex items-center justify-between">
                <div>
                    <div class="defparagraf text-[#787A91] text-xs">Sedang Antri</div>
                    <div class="text-2xl font-bold defparagraf text-[#0F044C]" id="count-waiting">{{ $waiting->count() }}</div>
                </div>
                <div class="w-10 h-10 bg-yellow-100 border border-yellow-300 flex items-center justify-center">
                    <div class="w-2 h-2 bg-yellow-500"></div>
                </div>
            </div>
            <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 flex items-center justify-between">
                <div>
                    <div class="defparagraf text-[#787A91] text-xs">Sedang Dikerjakan</div>
                    <div class="text-2xl font-bold defparagraf text-[#0F044C]" id="count-inprogress">{{ $inProgress->count() }}</div>
                </div>
                <div class="w-10 h-10 bg-blue-100 border border-blue-300 flex items-center justify-center">
                    <div class="w-2 h-2 bg-blue-500 animate-pulse"></div>
                </div>
            </div>
            <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 flex items-center justify-between">
                <div>
                    <div class="defparagraf text-[#787A91] text-xs">Butuh Konfirmasi</div>
                    <div class="text-2xl font-bold defparagraf text-[#0F044C]" id="count-need">{{ $needConfirmation->count() }}</div>
                </div>
                <div class="w-10 h-10 bg-orange-100 border border-orange-300 flex items-center justify-center">
                    <div class="w-2 h-2 bg-orange-500"></div>
                </div>
            </div>
            <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 flex items-center justify-between">
                <div>
                    <div class="defparagraf text-[#787A91] text-xs">Selesai</div>
                    <div class="text-2xl font-bold defparagraf text-[#0F044C]" id="count-completed">{{ $completed->count() }}</div>
                </div>
                <div class="w-10 h-10 bg-green-100 border border-green-300 flex items-center justify-center">
                    <div class="w-2 h-2 bg-green-500"></div>
                </div>
            </div>
        </div>

        <!-- Board 3 Kolom -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- Sedang Antri + Sedang Dikerjakan -->
            <div class="bg-white border-2 border-[#0F044C] shadow-sm">
                <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="defparagraf font-semibold text-[#0F044C]">SEDANG ANTRI & DIKERJAKAN</h3>
                    <span class="text-xs defparagraf text-[#787A91]">{{ $waiting->count() + $inProgress->count() }} item</span>
                </div>
                <div class="p-3 space-y-3" id="col-waiting">
                    @foreach($waiting as $item)
                        <div class="border-2 border-gray-800 p-3 bg-white queue-card"
                             data-id="{{ $item['id'] ?? '' }}"
                             data-status="waiting"
                             data-service="{{ $item['service'] ?? '' }}"
                             data-customer="{{ $item['customer_name'] ?? '' }}"
                             data-plate="{{ $item['plate'] ?? '' }}">
                            <div class="flex items-start justify-between mb-1">
                                <div class="defparagraf font-semibold text-[#0F044C] text-sm">{{ $item['service'] ?? '-' }}</div>
                                <span class="text-xs defparagraf text-[#787A91]">{{ $item['time'] ?? '-' }}</span>
                            </div>
                            <div class="text-xs defparagraf text-[#787A91] mb-1">{{ $item['date'] ?? '-' }}</div>
                            <div class="mb-1">
                                <div class="text-xs defparagraf text-[#0F044C] font-medium">{{ $item['customer_name'] ?? '-' }}</div>
                                <div class="text-xs defparagraf text-[#787A91]">{{ $item['car'] ?? '-' }} • {{ $item['plate'] ?? '-' }}</div>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-sm defparagraf text-[#0F044C] font-semibold">Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</div>
                                <div class="flex gap-2">
                                    <button class="px-3 py-1 border border-[#0F044C] text-[#0F044C] defparagraf text-xs hover:bg-[#EEEEEE]" onclick='markInProgress(@json($item), this.closest(".queue-card"))'>Mulai</button>
                                    <button class="px-3 py-1 bg-[#141E61] text-white defparagraf text-xs hover:bg-[#0F044C]" onclick='openReceipt(@json($item))'>Detail Struk</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @foreach($inProgress as $item)
                        <div class="border-2 border-gray-800 p-3 bg-white queue-card"
                             data-id="{{ $item['id'] ?? '' }}"
                             data-status="in_progress"
                             data-service="{{ $item['service'] ?? '' }}"
                             data-customer="{{ $item['customer_name'] ?? '' }}"
                             data-plate="{{ $item['plate'] ?? '' }}">
                            <div class="flex items-start justify-between mb-1">
                                <div class="defparagraf font-semibold text-[#0F044C] text-sm">{{ $item['service'] ?? '-' }}</div>
                                <span class="text-xs defparagraf text-[#787A91]">{{ $item['time'] ?? '-' }}</span>
                            </div>
                            <div class="text-xs defparagraf text-[#787A91] mb-1">{{ $item['date'] ?? '-' }}</div>
                            <div class="mb-1">
                                <div class="text-xs defparagraf text-[#0F044C] font-medium">{{ $item['customer_name'] ?? '-' }}</div>
                                <div class="text-xs defparagraf text-[#787A91]">{{ $item['car'] ?? '-' }} • {{ $item['plate'] ?? '-' }}</div>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-sm defparagraf text-[#0F044C] font-semibold">Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</div>
                                <div class="flex gap-2">
                                    <button class="px-3 py-1 border border-[#0F044C] text-[#0F044C] defparagraf text-xs hover:bg-[#EEEEEE]" onclick='markCompleted(@json($item), this.closest(".queue-card"))'>Selesai</button>
                                    <button class="px-3 py-1 border border-orange-600 text-orange-700 defparagraf text-xs hover:bg-orange-50" onclick='moveToNeedConfirmation(@json($item), this.closest(".queue-card"))'>Butuh Konfirmasi</button>
                                    <button class="px-3 py-1 bg-[#141E61] text-white defparagraf text-xs hover:bg-[#0F044C]" onclick='openReceipt(@json($item))'>Detail Struk</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if(($waiting->count() + $inProgress->count()) === 0)
                        <div class="defparagraf text-sm text-[#787A91]">Tidak ada antrian.</div>
                    @endif
                </div>
            </div>

            <!-- Butuh Konfirmasi Harga -->
            <div class="bg-white border-2 border-[#0F044C] shadow-sm">
                <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="defparagraf font-semibold text-[#0F044C]">BUTUH KONFIRMASI HARGA</h3>
                    <span class="text-xs defparagraf text-[#787A91]" id="count-need-head">{{ $needConfirmation->count() }} item</span>
                </div>
                <div class="p-3 space-y-3" id="col-need">
                    @foreach($needConfirmation as $item)
                        <div class="border-2 border-gray-800 p-3 bg-white queue-card"
                             data-id="{{ $item['id'] ?? '' }}"
                             data-status="need_confirmation"
                             data-service="{{ $item['service'] ?? '' }}"
                             data-customer="{{ $item['customer_name'] ?? '' }}"
                             data-plate="{{ $item['plate'] ?? '' }}">
                            <div class="flex items-start justify-between mb-1">
                                <div class="defparagraf font-semibold text-[#0F044C] text-sm">{{ $item['service'] ?? '-' }}</div>
                                <span class="text-xs defparagraf text-[#787A91]">{{ $item['time'] ?? '-' }}</span>
                            </div>
                            <div class="text-xs defparagraf text-[#787A91] mb-1">{{ $item['date'] ?? '-' }}</div>
                            <div class="mb-1">
                                <div class="text-xs defparagraf text-[#0F044C] font-medium">{{ $item['customer_name'] ?? '-' }}</div>
                                <div class="text-xs defparagraf text-[#787A91]">{{ $item['car'] ?? '-' }} • {{ $item['plate'] ?? '-' }}</div>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-sm defparagraf text-[#0F044C] font-semibold">Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</div>
                                <div class="flex gap-2">
                                    <button class="px-3 py-1 border border-orange-600 text-orange-700 defparagraf text-xs hover:bg-orange-50" onclick='sendConfirmation(@json($item))'>Kirim Konfirmasi</button>
                                    <button class="px-3 py-1 border border-green-600 text-green-700 defparagraf text-xs hover:bg-green-50" onclick='approveAndStart(@json($item), this.closest(".queue-card"))'>Disetujui</button>
                                    <button class="px-3 py-1 bg-[#141E61] text-white defparagraf text-xs hover:bg-[#0F044C]" onclick='openReceipt(@json($item))'>Detail Struk</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($needConfirmation->count() === 0)
                        <div class="defparagraf text-sm text-[#787A91]">Tidak ada permintaan konfirmasi.</div>
                    @endif
                </div>
            </div>

            <!-- Selesai Servis -->
            <div class="bg-white border-2 border-[#0F044C] shadow-sm">
                <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="defparagraf font-semibold text-[#0F044C]">SELESAI SERVIS</h3>
                    <span class="text-xs defparagraf text-[#787A91]">{{ $completed->count() }} item</span>
                </div>
                <div class="p-3 space-y-3" id="col-completed">
                    @foreach($completed as $item)
                        <div class="border-2 border-gray-800 p-3 bg-white queue-card"
                             data-id="{{ $item['id'] ?? '' }}"
                             data-status="completed"
                             data-service="{{ $item['service'] ?? '' }}"
                             data-customer="{{ $item['customer_name'] ?? '' }}"
                             data-plate="{{ $item['plate'] ?? '' }}">
                            <div class="flex items-start justify-between mb-1">
                                <div class="defparagraf font-semibold text-[#0F044C] text-sm">{{ $item['service'] ?? '-' }}</div>
                                <span class="text-xs defparagraf text-[#787A91]">{{ $item['time'] ?? '-' }}</span>
                            </div>
                            <div class="text-xs defparagraf text-[#787A91] mb-1">{{ $item['date'] ?? '-' }}</div>
                            <div class="mb-1">
                                <div class="text-xs defparagraf text-[#0F044C] font-medium">{{ $item['customer_name'] ?? '-' }}</div>
                                <div class="text-xs defparagraf text-[#787A91]">{{ $item['car'] ?? '-' }} • {{ $item['plate'] ?? '-' }}</div>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-sm defparagraf text-[#0F044C] font-semibold">Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</div>
                                <div class="flex gap-2">
                                    <button class="px-3 py-1 bg-[#141E61] text-white defparagraf text-xs hover:bg-[#0F044C]" onclick='openReceipt(@json($item))'>Lihat Struk</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($completed->count() === 0)
                        <div class="defparagraf text-sm text-[#787A91]">Belum ada yang selesai.</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal cepat tambah (tetap dari versi sebelumnya) -->
        <div id="createModal" class="fixed inset-0 bg-black bg-opacity-60 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4">
            <div class="relative w-full max-w-md bg-white shadow-2xl transform transition-all">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-[#3B2A7A] flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">Tambah Antrian Baru</h3>
                        </div>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form id="queueForm">
                        <div class="space-y-5">
                            <div class="grid grid-cols-1 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pelanggan</label>
                                    <input type="text" id="customerName" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" required />
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kendaraan</label>
                                    <input type="text" id="vehicle" placeholder="Contoh: Honda Civic 2020" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" required />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Layanan</label>
                                    <select id="service" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" required>
                                        <option value="">Pilih Layanan</option>
                                        <option>Isi Freon</option>
                                        <option>Ganti Oli</option>
                                        <option>Service AC</option>
                                        <option>Cuci Evaporator</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu</label>
                                    <input type="text" id="time" placeholder="09:00-10:00" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" required />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                                    <select id="status" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" required>
                                        <option value="waiting">Menunggu</option>
                                        <option value="in_progress">Sedang Dikerjakan</option>
                                        <option value="need_confirmation">Butuh Konfirmasi Harga</option>
                                        <option value="completed">Selesai</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Plat Nomor</label>
                                    <input type="text" id="plate" placeholder="B 1234 ABC" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" />
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                            <button type="button" onclick="closeModal()" class="px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 hover:bg-gray-200 transition-colors">Batal</button>
                            <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-[#3B2A7A] border border-transparent hover:bg-[#2D1B69] transition-colors shadow-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Komponen modal struk admin untuk direuse -->
        <x-admin.receipt-modal />

        <!-- Delete Confirmation Modal (opsional) -->
        <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg bg-white">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 bg-red-100 mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Antrian</h3>
                    <p class="text-sm text-gray-500 mb-4">Apakah Anda yakin ingin menghapus antrian ini? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="flex justify-center space-x-3">
                        <button onclick="closeDeleteModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 hover:bg-gray-200">Batal</button>
                        <button onclick="confirmDelete()" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent hover:bg-red-700">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Simple tiny reactive helper using template cloning (no Vue dependency required)
            function formatPrice(num){
                try{ return (num || 0).toLocaleString('id-ID'); }catch(e){ return num; }
            }

            // Note: renderQueueCard was removed because it relied on a client-side template using double curly braces (Blade syntax)
            // which conflicted with Blade parsing and caused syntax errors. It is not needed anymore
            // since cards are rendered directly via Blade loops above.
            // function renderQueueCard(){ /* not used */ }

            // Bootstrap: render from server data already printed in Blade as HTML via components or fallback to plain blade loops
            document.addEventListener('DOMContentLoaded', function(){
                // Filtering
                var q = document.getElementById('q');
                var fStatus = document.getElementById('f-status');
                var fService = document.getElementById('f-service');

                function applyFilters(){
                    var qv = (q.value || '').toLowerCase();
                    var sv = (fStatus.value || '').toLowerCase();
                    var srv = (fService.value || '').toLowerCase();
                    var cards = document.querySelectorAll('.queue-card');
                    cards.forEach(function(card){
                        var id = (card.getAttribute('data-id') || '').toLowerCase();
                        var st = (card.getAttribute('data-status') || '').toLowerCase();
                        var se = (card.getAttribute('data-service') || '').toLowerCase();
                        var cu = (card.getAttribute('data-customer') || '').toLowerCase();
                        var pl = (card.getAttribute('data-plate') || '').toLowerCase();
                        var matchQ = !qv || id.includes(qv) || se.includes(qv) || cu.includes(qv) || pl.includes(qv);
                        var matchS = !sv || st === sv;
                        var matchSrv = !srv || se === srv;
                        card.style.display = (matchQ && matchS && matchSrv) ? '' : 'none';
                    });
                }

                q.addEventListener('input', applyFilters);
                fStatus.addEventListener('change', applyFilters);
                fService.addEventListener('change', applyFilters);

                // Receipt modal reuse
                window.openReceipt = function(item){
                    try{
                        var data = {
                            id: item.id || '-',
                            date: item.date || '-',
                            time: item.time || '-',
                            car: (item.car || '-') + (item.plate ? ' • ' + item.plate : ''),
                            services: [item.service || '-'],
                            status: 'admin',
                            context: 'admin',
                            pricing: item.pricing || null,
                            address: item.address || null,
                            notes: item.notes || null,
                            editUrl: item.editUrl || null
                        };
                        if (window.showAdminReceiptModal){
                            window.showAdminReceiptModal(data);
                        } else {
                            alert('Detail Struk: ' + (item.id || '-'))
                        }
                    }catch(e){ console.warn(e); }
                }

                // State transfer helpers (demo only)
                function updateCounters(){
                    var countW = document.querySelectorAll('#col-waiting .queue-card').length;
                    var countN = document.querySelectorAll('#col-need .queue-card').length;
                    var countC = document.querySelectorAll('#col-completed .queue-card').length;
                    document.getElementById('count-waiting').textContent = countW;
                    document.getElementById('count-inprogress').textContent = countW; // combined with in_progress in this column
                    document.getElementById('count-need').textContent = countN;
                    var head = document.getElementById('count-need-head'); if(head) head.textContent = countN + ' item';
                    document.getElementById('count-completed').textContent = countC;
                }

                window.markInProgress = function(item, card){
                    // For demo, simply keep in column but update badge would be required if we added it
                    alert('Mulai pengerjaan untuk ' + (item.id || '-'));
                }

                window.markCompleted = function(item, card){
                    alert('Menandai selesai untuk ' + (item.id || '-'));
                    if(card){
                        document.getElementById('col-completed').appendChild(card);
                        card.setAttribute('data-status', 'completed');
                        updateCounters();
                    }
                }

                window.moveToNeedConfirmation = function(item, card){
                    alert('Memindahkan ke Butuh Konfirmasi: ' + (item.id || '-'));
                    if(card){
                        document.getElementById('col-need').appendChild(card);
                        card.setAttribute('data-status', 'need_confirmation');
                        updateCounters();
                    }
                }

                window.sendConfirmation = function(item){
                    alert('Konfirmasi harga dikirim ke pelanggan untuk ' + (item.id || '-'));
                }

                window.approveAndStart = function(item, card){
                    alert('Pelanggan menyetujui harga. Mulai pengerjaan ' + (item.id || '-'));
                    if(card){
                        document.getElementById('col-waiting').appendChild(card);
                        card.setAttribute('data-status', 'in_progress');
                        updateCounters();
                    }
                }

                // Modal basic handlers
                window.openCreateModal = function(){ document.getElementById('createModal').classList.remove('hidden'); }
                window.closeModal = function(){ document.getElementById('createModal').classList.add('hidden'); }
                document.getElementById('createModal').addEventListener('click', function(e){ if(e.target === this) { window.closeModal(); } });
                document.getElementById('queueForm').addEventListener('submit', function(e){
                    e.preventDefault();
                    alert('Data antrian tersimpan (demo)');
                    window.closeModal();
                });

                // Attach data attributes to server-rendered items to enable filtering
                document.querySelectorAll('#col-waiting .border-2, #col-need .border-2, #col-completed .border-2').forEach(function(card){
                    card.classList.add('queue-card');
                    if(!card.hasAttribute('data-id')){ card.setAttribute('data-id', ''); }
                });
            });
        </script>
    </div>
</x-admin.dashboard-layout>
