<x-admin.dashboard-layout title="Manajemen Antrian - Dwi AC Mobil">
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Hero / Header -->
        <div class="bg-gradient-to-br from-[#0F044C] via-[#1D2C90] to-[#192BC2] text-white rounded-2xl px-6 py-8 sm:px-8 sm:py-10 shadow-xl relative overflow-hidden">
            <div class="absolute inset-0 opacity-20 pointer-events-none">
                <div class="w-56 h-56 bg-white/10 rounded-full blur-3xl absolute -right-16 top-4"></div>
                <div class="w-40 h-40 bg-white/5 rounded-full blur-3xl absolute -left-10 bottom-0"></div>
            </div>
            <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex-1">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-montserrat-48 font-bold leading-tight mb-3">Manajemen Antrian</h1>
                    <p class="text-sm sm:text-base text-white/80 defparagraf max-w-3xl">
                        Pantau antrian, konfirmasi harga, dan kelola servis yang sudah selesai dengan mudah.
                    </p>
                </div>
                <button onclick="openCreateModal()" class="bg-white text-[#0F044C] px-6 py-3 rounded-xl font-semibold defparagraf flex items-center space-x-2 shadow-lg hover:shadow-xl transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah Antrian</span>
                </button>
            </div>
        </div>

        <!-- Pencarian & Filter -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-4 md:p-5">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <div class="relative col-span-2">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input id="q" type="text" placeholder="Cari ID/Nama/Layanan/Plat..." class="w-full pl-10 pr-4 py-3 border border-[#0F044C]/30 rounded-xl focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf bg-white" />
                </div>
                <div>
                    <select id="f-status" class="w-full px-4 py-3 border border-[#0F044C]/30 rounded-xl focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf bg-white">
                        <option value="">Semua Status</option>
                        <option value="waiting">Sedang Antri</option>
                        <option value="in_progress">Sedang Dikerjakan</option>
                        <option value="need_confirmation">Butuh Konfirmasi Harga</option>
                        <option value="completed">Selesai Servis</option>
                    </select>
                </div>
                <div>
                    <select id="f-category" class="w-full px-4 py-3 border border-[#0F044C]/30 rounded-xl focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf bg-white">
                        <option value="">Semua Kategori</option>
                        @foreach(($categories ?? []) as $cat)
                            <option value="{{ $cat->id_kategori }}" {{ (string)($category ?? '') === (string)$cat->id_kategori ? 'selected' : '' }}>
                                {{ $cat->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        @php
            // Gunakan data real dari controller, bukan dummy data
            $queue = collect($bookings ?? []);
            $byStatus = $queue->groupBy(function($booking) {
                // Pastikan $booking adalah object, bukan integer
                if (!is_object($booking) || !isset($booking->status)) {
                    return 'waiting'; // default fallback
                }
                
                $status = strtolower($booking->status ?? '');
                // Map database status ke UI status
                switch($status) {
                    case \App\Models\AntriStruk::STATUS_PENDING:
                    case \App\Models\AntriStruk::STATUS_HARGA_DARI_ADMIN:
                        return 'need_confirmation';
                    case \App\Models\AntriStruk::STATUS_DALAM_ANTRIAN:
                        return 'waiting';
                    case \App\Models\AntriStruk::STATUS_DALAM_SERVISAN:
                        return 'in_progress';
                    case \App\Models\AntriStruk::STATUS_SELESAI:
                        return 'completed';
                    default:
                        return 'waiting';
                }
            });
            $waiting = $byStatus->get('waiting', collect());
            $inProgress = $byStatus->get('in_progress', collect());
            $needConfirmation = $byStatus->get('need_confirmation', collect());
            $completed = $byStatus->get('completed', collect());
        @endphp

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
            <!-- Sedang Antri -->
            <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
                <p class="bigparafraf font-semibold text-black mb-4">Sedang Antri</p>
                <div class="flex items-center gap-4">
                    <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                        <p class="font-montserrat-36 font-bold text-[#1D2C90]" id="count-waiting">{{ $waiting->count() }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <svg class="w-12 h-12 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="currentColor">
                                <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                                <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" clip-rule="evenodd"/>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Sedang Dikerjakan -->
            <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
                <p class="bigparafraf font-semibold text-black mb-4">Sedang Dikerjakan</p>
                <div class="flex items-center gap-4">
                    <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                        <p class="font-montserrat-36 font-bold text-[#1D2C90]" id="count-inprogress">{{ $inProgress->count() }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <svg class="w-12 h-12 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="none">
                                <path d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12"/>
                                <path stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12Z"/>
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 7v6m0 4h.01"/>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Butuh Konfirmasi -->
            <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
                <p class="bigparafraf font-semibold text-black mb-4">Butuh Konfirmasi</p>
                <div class="flex items-center gap-4">
                    <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                        <p class="font-montserrat-36 font-bold text-[#1D2C90]" id="count-need">{{ $needConfirmation->count() }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <svg class="w-12 h-12 text-yellow-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <defs><path id="admBadgeIconSum" d="M21.5 11v10h-19V11z"/></defs>
                            <g fill="none">
                                <use href="#admBadgeIconSum"/>
                                <path d="M12 13.5a2.5 2.5 0 1 1 0 5a2.5 2.5 0 0 1 0-5m5.136-7.209L19 5.67l1.824 5.333H3.002L3 11.004L14.146 2.1z"/>
                                <path stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M21 11.003h-.176L19.001 5.67L3.354 11.003L3 11m-.5.004H3L14.146 2.1l2.817 3.95"/>
                                <g stroke="currentColor" stroke-linecap="square" stroke-width="2">
                                    <path d="M14.5 16a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0Z"/>
                                    <use href="#admBadgeIconSum"/>
                                    <path d="M2.5 11h2a2 2 0 0 1-2 2zm19 0h-2a2 2 0 0 0 2 2zm-19 10h2.002A2 2 0 0 0 2.5 18.998zm19 0h-2a2 2 0 0 1 2-2z"/>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Selesai -->
            <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
                <p class="bigparafraf font-semibold text-black mb-4">Selesai Servis</p>
                <div class="flex items-center gap-4">
                    <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                        <p class="font-montserrat-36 font-bold text-[#1D2C90]" id="count-completed">{{ $completed->count() }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <svg class="w-12 h-12 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="currentColor">
                                <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                                <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" clip-rule="evenodd"/>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Sections - 3 Kolom -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6 mb-6">
            <!-- BUTUH KONFIRMASI HARGA (Kolom 1) -->
            <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md overflow-hidden flex flex-col">
                <div class="bg-gradient-to-r from-yellow-50 to-yellow-100/50 border-b border-yellow-200 px-4 py-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-yellow-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <defs><path id="admBadgeIconSum" d="M21.5 11v10h-19V11z"/></defs>
                                <g fill="none">
                                    <use href="#admBadgeIconSum"/>
                                    <path d="M12 13.5a2.5 2.5 0 1 1 0 5a2.5 2.5 0 0 1 0-5m5.136-7.209L19 5.67l1.824 5.333H3.002L3 11.004L14.146 2.1z"/>
                                    <path stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M21 11.003h-.176L19.001 5.67L3.354 11.003L3 11m-.5.004H3L14.146 2.1l2.817 3.95"/>
                                    <g stroke="currentColor" stroke-linecap="square" stroke-width="2">
                                        <path d="M14.5 16a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0Z"/>
                                        <use href="#admBadgeIconSum"/>
                                        <path d="M2.5 11h2a2 2 0 0 1-2 2zm19 0h-2a2 2 0 0 0 2 2zm-19 10h2.002A2 2 0 0 0 2.5 18.998zm19 0h-2a2 2 0 0 1 2-2z"/>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-base sm:text-lg font-montserrat-48 font-bold text-[#0F044C] truncate">Butuh Konfirmasi</h2>
                            <p class="text-xs defparagraf text-[#787A91]" id="count-need-head">{{ $needConfirmation->count() }} item</p>
                        </div>
                    </div>
                </div>
                <div class="p-3 md:p-4 flex-1 overflow-y-auto max-h-[600px]">
                    <div class="space-y-3" id="col-need">
                        @forelse($needConfirmation as $booking)
                            <div class="bg-white border border-[#0F044C]/20 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow queue-card"
                                 data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                 data-status="need_confirmation"
                                 data-service="{{ $booking->details->pluck('deskripsi')->join(', ') }}"
                                 data-customer="{{ optional($booking->pelanggan)->nama ?? '-' }}"
                                 data-plate="{{ optional($booking->mobil)->plat_nomor ?? '-' }}">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            @php $status = strtolower($booking->status ?? ''); @endphp
                                            @if ($status === \App\Models\AntriStruk::STATUS_PENDING)
                                                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-lg">MENUNGGU HARGA</span>
                                            @elseif ($status === \App\Models\AntriStruk::STATUS_HARGA_DARI_ADMIN)
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-lg">HARGA DARI ADMIN</span>
                                            @else
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-lg">KONFIRMASI</span>
                                            @endif
                                            <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->tanggal_pesan)->format('H:i') ?? '-' }}</span>
                                        </div>
                                        <h3 class="defparagraf font-bold text-[#0F044C] text-sm mb-1">{{ $booking->details->pluck('deskripsi')->join(', ') ?: 'Layanan' }}</h3>
                                        <p class="text-xs defparagraf text-[#787A91] mb-3">{{ optional($booking->tanggal_pesan)->format('d F Y') ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 pt-3 mb-3">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span class="text-sm defparagraf font-medium text-[#0F044C]">{{ optional($booking->pelanggan)->nama ?? '-' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->mobil)->nama_mobil ?? '-' }} • {{ optional($booking->mobil)->plat_nomor ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-3 border-t border-gray-200 mb-3">
                                    <div class="text-base defparagraf font-bold text-[#0F044C]">Rp {{ number_format($booking->harga_keseluruhan ?? 0, 0, ',', '.') }}</div>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    <button type="button" 
                                            class="px-4 py-2 border border-[#0F044C] text-[#0F044C] text-xs font-semibold rounded-lg hover:bg-[#0F044C] hover:text-white transition-colors"
                                            onclick="openAdminReceiptFromDataset(this)"
                                            data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                            data-date="{{ optional($booking->tanggal_pesan)->format('d/m/Y') }}"
                                            data-time="{{ optional($booking->tanggal_pesan)->format('H.i') }} - {{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '...' }}"
                                            data-status="{{ strtolower($booking->status) }}"
                                            data-car="{{ optional($booking->mobil)->nama_mobil ? optional($booking->mobil)->nama_mobil.' ('.optional($booking->mobil)->plat_nomor.')' : '—' }}"
                                            data-services='@json($booking->details ? $booking->details->pluck("deskripsi")->toArray() : [])'
                                            data-address="{{ ($booking->pengambilan && $booking->alamat_pengambilan ? 'Jemput: '.$booking->alamat_pengambilan : '') . ($booking->pengiriman && $booking->alamat_pengiriman ? (($booking->pengambilan ? ' | ' : '').'Antar: '.$booking->alamat_pengiriman) : '') }}"
                                            data-notes="{{ $booking->catatan ?? '' }}"
                                            data-pricing='@json(null)'
                                            data-mechanic="{{ optional($booking->montir)->nama ?? '' }}"
                                            data-menginap="{{ $booking->menginap ? '1' : '0' }}"
                                            data-duration="{{ $booking->durasi_hari ?? 1 }}"
                                            data-enddate="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('d/m/Y') : '' }}"
                                            data-endtime="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '' }}">
                                        Detail
                                    </button>
                                    
                                    @if ($status === \App\Models\AntriStruk::STATUS_PENDING)
                                        <button type="button" 
                                                class="px-4 py-2 bg-[#1D2C90] text-white text-xs font-semibold rounded-lg hover:bg-[#0F044C] transition-colors"
                                                onclick="openAdminReceiptFromDataset(this)"
                                                data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                                data-date="{{ optional($booking->tanggal_pesan)->format('d/m/Y') }}"
                                                data-time="{{ optional($booking->tanggal_pesan)->format('H.i') }} - {{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '...' }}"
                                                data-status="{{ strtolower($booking->status) }}"
                                                data-car="{{ optional($booking->mobil)->nama_mobil ? optional($booking->mobil)->nama_mobil.' ('.optional($booking->mobil)->plat_nomor.')' : '—' }}"
                                                data-services='@json($booking->details ? $booking->details->pluck("deskripsi")->toArray() : [])'
                                                data-address="{{ ($booking->pengambilan && $booking->alamat_pengambilan ? 'Jemput: '.$booking->alamat_pengambilan : '') . ($booking->pengiriman && $booking->alamat_pengiriman ? (($booking->pengambilan ? ' | ' : '').'Antar: '.$booking->alamat_pengiriman) : '') }}"
                                                data-notes="{{ $booking->catatan ?? '' }}"
                                                data-pricing='@json(null)'
                                                data-mechanic="{{ optional($booking->montir)->nama ?? '' }}"
                                                data-menginap="{{ $booking->menginap ? '1' : '0' }}"
                                                data-duration="{{ $booking->durasi_hari ?? 1 }}"
                                                data-enddate="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('d/m/Y') : '' }}"
                                                data-endtime="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '' }}">
                                            Set Harga
                                        </button>
                                        <form method="POST" action="{{ route('admin.antrian.cancel', $booking->nomor_booking ?? $booking->id_antri_struk) }}" class="inline">
                                            @csrf
                                            <button class="px-4 py-2 border border-red-600 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-600 hover:text-white transition-colors">Batal</button>
                                        </form>
                                    @elseif ($status === \App\Models\AntriStruk::STATUS_HARGA_DARI_ADMIN)
                                        <form method="POST" action="{{ route('admin.antrian.cancel', $booking->nomor_booking ?? $booking->id_antri_struk) }}" class="inline">
                                            @csrf
                                            <button class="px-4 py-2 border border-red-600 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-600 hover:text-white transition-colors">Batal</button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.antrian.cancel', $booking->nomor_booking ?? $booking->id_antri_struk) }}" class="inline">
                                            @csrf
                                            <button class="px-4 py-2 border border-red-600 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-600 hover:text-white transition-colors">Batal</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="defparagraf text-[#787A91] text-sm">Tidak ada permintaan konfirmasi</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- SEDANG ANTRI (Kolom 2) -->
            <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md overflow-hidden flex flex-col">
                <div class="bg-gradient-to-r from-green-50 to-green-100/50 border-b border-green-200 px-4 py-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="currentColor">
                                    <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                                    <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" clip-rule="evenodd"/>
                                </g>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-base sm:text-lg font-montserrat-48 font-bold text-[#0F044C] truncate">Sedang Antri</h2>
                            <p class="text-xs defparagraf text-[#787A91]">{{ $waiting->count() }} item</p>
                        </div>
                    </div>
                </div>
                <div class="p-3 md:p-4 flex-1 overflow-y-auto max-h-[600px]">
                    <div class="space-y-3" id="col-waiting">
                        @forelse($waiting as $booking)
                            <div class="bg-white border border-[#0F044C]/20 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow queue-card"
                                 data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                 data-status="waiting"
                                 data-service="{{ $booking->details->pluck('deskripsi')->join(', ') }}"
                                 data-customer="{{ optional($booking->pelanggan)->nama ?? '-' }}"
                                 data-plate="{{ optional($booking->mobil)->plat_nomor ?? '-' }}">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-lg">ANTRI</span>
                                            <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->tanggal_pesan)->format('H:i') ?? '-' }}</span>
                                        </div>
                                        <h3 class="defparagraf font-bold text-[#0F044C] text-sm mb-1">{{ $booking->details->pluck('deskripsi')->join(', ') ?: 'Layanan' }}</h3>
                                        <p class="text-xs defparagraf text-[#787A91] mb-3">{{ optional($booking->tanggal_pesan)->format('d F Y') ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 pt-3 mb-3">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span class="text-sm defparagraf font-medium text-[#0F044C]">{{ optional($booking->pelanggan)->nama ?? '-' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->mobil)->nama_mobil ?? '-' }} • {{ optional($booking->mobil)->plat_nomor ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                    <div class="text-base defparagraf font-bold text-[#0F044C]">Rp {{ number_format($booking->harga_keseluruhan ?? 0, 0, ',', '.') }}</div>
                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('admin.antrian.start', $booking->nomor_booking ?? $booking->id_antri_struk) }}">
                                            @csrf
                                            <button class="px-3 py-1.5 bg-[#1D2C90] text-white text-xs font-semibold rounded-lg hover:bg-[#0F044C] transition-colors">Mulai</button>
                                        </form>
                                        <button class="px-3 py-1.5 border border-[#0F044C] text-[#0F044C] text-xs font-semibold rounded-lg hover:bg-[#0F044C] hover:text-white transition-colors" 
                                                onclick="openAdminReceiptFromDataset(this)"
                                                data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                                data-date="{{ optional($booking->tanggal_pesan)->format('d/m/Y') }}"
                                                data-time="{{ optional($booking->tanggal_pesan)->format('H.i') }} - {{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '...' }}"
                                                data-status="{{ strtolower($booking->status) }}"
                                                data-car="{{ optional($booking->mobil)->nama_mobil ? optional($booking->mobil)->nama_mobil.' ('.optional($booking->mobil)->plat_nomor.')' : '—' }}"
                                                data-services='@json($booking->details ? $booking->details->pluck("deskripsi")->toArray() : [])'
                                                data-address="{{ ($booking->pengambilan && $booking->alamat_pengambilan ? 'Jemput: '.$booking->alamat_pengambilan : '') . ($booking->pengiriman && $booking->alamat_pengiriman ? (($booking->pengambilan ? ' | ' : '').'Antar: '.$booking->alamat_pengiriman) : '') }}"
                                                data-notes="{{ $booking->catatan ?? '' }}"
                                                data-pricing='@json(null)'
                                                data-mechanic="{{ optional($booking->montir)->nama ?? '' }}"
                                                data-menginap="{{ $booking->menginap ? '1' : '0' }}"
                                                data-duration="{{ $booking->durasi_hari ?? 1 }}"
                                                data-enddate="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('d/m/Y') : '' }}"
                                                data-endtime="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '' }}">Detail</button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <p class="defparagraf text-[#787A91] text-sm">Tidak ada antrian</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- SEDANG DIKERJAKAN (Kolom 3) -->
            <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md overflow-hidden flex flex-col">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100/50 border-b border-blue-200 px-4 py-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="none">
                                    <path d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12"/>
                                    <path stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12Z"/>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 7v6m0 4h.01"/>
                                </g>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-base sm:text-lg font-montserrat-48 font-bold text-[#0F044C] truncate">Sedang Dikerjakan</h2>
                            <p class="text-xs defparagraf text-[#787A91]">{{ $inProgress->count() }} item</p>
                        </div>
                    </div>
                </div>
                <div class="p-3 md:p-4 flex-1 overflow-y-auto max-h-[600px]">
                    <div class="space-y-3" id="col-inprogress">
                        @forelse($inProgress as $booking)
                            <div class="bg-white border border-[#0F044C]/20 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow queue-card"
                                 data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                 data-status="in_progress"
                                 data-service="{{ $booking->details->pluck('deskripsi')->join(', ') }}"
                                 data-customer="{{ optional($booking->pelanggan)->nama ?? '-' }}"
                                 data-plate="{{ optional($booking->mobil)->plat_nomor ?? '-' }}">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-lg">DIKERJAKAN</span>
                                            <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->tanggal_pesan)->format('H:i') ?? '-' }}</span>
                                        </div>
                                        <h3 class="defparagraf font-bold text-[#0F044C] text-sm mb-1">{{ $booking->details->pluck('deskripsi')->join(', ') ?: 'Layanan' }}</h3>
                                        <p class="text-xs defparagraf text-[#787A91] mb-3">{{ optional($booking->tanggal_pesan)->format('d F Y') ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 pt-3 mb-3">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span class="text-sm defparagraf font-medium text-[#0F044C]">{{ optional($booking->pelanggan)->nama ?? '-' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->mobil)->nama_mobil ?? '-' }} • {{ optional($booking->mobil)->plat_nomor ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                    <div class="text-base defparagraf font-bold text-[#0F044C]">Rp {{ number_format($booking->harga_keseluruhan ?? 0, 0, ',', '.') }}</div>
                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('admin.antrian.finish', $booking->nomor_booking ?? $booking->id_antri_struk) }}">
                                            @csrf
                                            <button class="px-3 py-1.5 bg-green-600 text-white text-xs font-semibold rounded-lg hover:bg-green-700 transition-colors">Selesai</button>
                                        </form>
                                        <button class="px-3 py-1.5 border border-[#0F044C] text-[#0F044C] text-xs font-semibold rounded-lg hover:bg-[#0F044C] hover:text-white transition-colors" 
                                                onclick="openAdminReceiptFromDataset(this)"
                                                data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                                data-date="{{ optional($booking->tanggal_pesan)->format('d/m/Y') }}"
                                                data-time="{{ optional($booking->tanggal_pesan)->format('H.i') }} - {{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '...' }}"
                                                data-status="{{ strtolower($booking->status) }}"
                                                data-car="{{ optional($booking->mobil)->nama_mobil ? optional($booking->mobil)->nama_mobil.' ('.optional($booking->mobil)->plat_nomor.')' : '—' }}"
                                                data-services='@json($booking->details ? $booking->details->pluck("deskripsi")->toArray() : [])'
                                                data-address="{{ ($booking->pengambilan && $booking->alamat_pengambilan ? 'Jemput: '.$booking->alamat_pengambilan : '') . ($booking->pengiriman && $booking->alamat_pengiriman ? (($booking->pengambilan ? ' | ' : '').'Antar: '.$booking->alamat_pengiriman) : '') }}"
                                                data-notes="{{ $booking->catatan ?? '' }}"
                                                data-pricing='@json(null)'
                                                data-mechanic="{{ optional($booking->montir)->nama ?? '' }}"
                                                data-menginap="{{ $booking->menginap ? '1' : '0' }}"
                                                data-duration="{{ $booking->durasi_hari ?? 1 }}"
                                                data-enddate="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('d/m/Y') : '' }}"
                                                data-endtime="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '' }}">Detail</button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="defparagraf text-[#787A91] text-sm">Tidak ada servis dikerjakan</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- SELESAI SERVIS (Section Terpisah di Bawah) -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-blue-50 to-blue-100/50 border-b border-blue-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="currentColor">
                                    <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                                    <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" clip-rule="evenodd"/>
                                </g>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg sm:text-xl font-montserrat-48 font-bold text-[#0F044C]">Selesai Servis</h2>
                            <p class="text-xs defparagraf text-[#787A91]">{{ $completed->count() }} servis telah selesai</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 md:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="col-completed">
                    @forelse($completed as $booking)
                        <div class="bg-white border border-[#0F044C]/20 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow queue-card"
                                 data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                 data-status="completed"
                                 data-service="{{ $booking->details->pluck('deskripsi')->join(', ') }}"
                                 data-customer="{{ optional($booking->pelanggan)->nama ?? '-' }}"
                                 data-plate="{{ optional($booking->mobil)->plat_nomor ?? '-' }}">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-lg">SELESAI</span>
                                            <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->tanggal_pesan)->format('H:i') ?? '-' }}</span>
                                        </div>
                                        <h3 class="defparagraf font-bold text-[#0F044C] text-sm mb-1">{{ $booking->details->pluck('deskripsi')->join(', ') ?: 'Layanan' }}</h3>
                                        <p class="text-xs defparagraf text-[#787A91] mb-3">{{ optional($booking->tanggal_pesan)->format('d F Y') ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 pt-3 mb-3">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span class="text-sm defparagraf font-medium text-[#0F044C]">{{ optional($booking->pelanggan)->nama ?? '-' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->mobil)->nama_mobil ?? '-' }} • {{ optional($booking->mobil)->plat_nomor ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                    <div class="text-base defparagraf font-bold text-[#0F044C]">Rp {{ number_format($booking->harga_keseluruhan ?? 0, 0, ',', '.') }}</div>
                                    <button class="px-4 py-2 bg-[#1D2C90] text-white text-xs font-semibold rounded-lg hover:bg-[#0F044C] transition-colors" 
                                            onclick="openAdminReceiptFromDataset(this)"
                                            data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                            data-date="{{ optional($booking->tanggal_pesan)->format('d/m/Y') }}"
                                            data-time="{{ optional($booking->tanggal_pesan)->format('H.i') }} - {{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '...' }}"
                                            data-status="{{ strtolower($booking->status) }}"
                                            data-car="{{ optional($booking->mobil)->nama_mobil ? optional($booking->mobil)->nama_mobil.' ('.optional($booking->mobil)->plat_nomor.')' : '—' }}"
                                            data-services='@json($booking->details ? $booking->details->pluck("deskripsi")->toArray() : [])'
                                            data-address="{{ ($booking->pengambilan && $booking->alamat_pengambilan ? 'Jemput: '.$booking->alamat_pengambilan : '') . ($booking->pengiriman && $booking->alamat_pengiriman ? (($booking->pengambilan ? ' | ' : '').'Antar: '.$booking->alamat_pengiriman) : '') }}"
                                            data-notes="{{ $booking->catatan ?? '' }}"
                                            data-pricing='@json(null)'
                                            data-mechanic="{{ optional($booking->montir)->nama ?? '' }}"
                                            data-menginap="{{ $booking->menginap ? '1' : '0' }}"
                                            data-duration="{{ $booking->durasi_hari ?? 1 }}"
                                            data-enddate="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('d/m/Y') : '' }}"
                                            data-endtime="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '' }}">Lihat Struk</button>
                                </div>
                            </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="defparagraf text-[#787A91]">Belum ada servis yang selesai</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Modal cepat tambah (tetap dari versi sebelumnya) -->
        <div id="createModal" class="fixed inset-0 bg-black bg-opacity-60 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4">
            <div class="relative w-full max-w-md bg-white shadow-2xl transform transition-all rounded-2xl">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-[#0F044C] rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">Tambah Antrian Baru</h3>
                        </div>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form id="queueForm">
                        <div class="space-y-5">
                            <div class="grid grid-cols-1 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2">Nama Pelanggan</label>
                                    <input type="text" id="customerName" class="w-full px-4 py-3 border border-[#0F044C]/30 rounded-xl focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf bg-white" required />
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2">Kendaraan</label>
                                    <input type="text" id="vehicle" placeholder="Contoh: Honda Civic 2020" class="w-full px-4 py-3 border border-[#0F044C]/30 rounded-xl focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf bg-white" required />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2">Layanan</label>
                                    <select id="service" class="w-full px-4 py-3 border border-[#0F044C]/30 rounded-xl focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf bg-white" required>
                                        <option value="">Pilih Layanan</option>
                                        <option>Isi Freon</option>
                                        <option>Ganti Oli</option>
                                        <option>Service AC</option>
                                        <option>Cuci Evaporator</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2">Waktu</label>
                                    <input type="text" id="time" placeholder="09:00-10:00" class="w-full px-4 py-3 border border-[#0F044C]/30 rounded-xl focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf bg-white" required />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2">Status</label>
                                    <select id="status" class="w-full px-4 py-3 border border-[#0F044C]/30 rounded-xl focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf bg-white" required>
                                        <option value="waiting">Menunggu</option>
                                        <option value="in_progress">Sedang Dikerjakan</option>
                                        <option value="need_confirmation">Butuh Konfirmasi Harga</option>
                                        <option value="completed">Selesai</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2">Plat Nomor</label>
                                    <input type="text" id="plate" placeholder="B 1234 ABC" class="w-full px-4 py-3 border border-[#0F044C]/30 rounded-xl focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] transition-colors defparagraf bg-white" />
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                            <button type="button" onclick="closeModal()" class="px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-xl hover:bg-gray-200 transition-colors">Batal</button>
                            <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-[#1D2C90] to-[#0F044C] rounded-xl hover:from-[#0F044C] hover:to-[#1D2C90] transition-colors shadow-md">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Komponen modal struk admin untuk direuse -->
        <x-admin.receipt-modal />

        <!-- Delete Confirmation Modal (opsional) -->
        <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg bg-white rounded-xl">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 bg-red-100 rounded-full mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Antrian</h3>
                    <p class="text-sm text-gray-500 mb-4">Apakah Anda yakin ingin menghapus antrian ini? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="flex justify-center space-x-3">
                        <button onclick="closeDeleteModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200">Batal</button>
                        <button onclick="confirmDelete()" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Simple tiny reactive helper using template cloning (no Vue dependency required)
            function formatPrice(num){
                try{ return (num || 0).toLocaleString('id-ID'); }catch(e){ return num; }
            }

            // Bootstrap: render from server data already printed in Blade as HTML via components or fallback to plain blade loops
            document.addEventListener('DOMContentLoaded', function(){
                // Filtering
                var q = document.getElementById('q');
                var fStatus = document.getElementById('f-status');
                var fCategory = document.getElementById('f-category');

                function applyFilters(){
                    var qv = (q.value || '').toLowerCase();
                    var sv = (fStatus.value || '').toLowerCase();
                    var catv = (fCategory.value || '').toLowerCase();
                    var cards = document.querySelectorAll('.queue-card');
                    cards.forEach(function(card){
                        var id = (card.getAttribute('data-id') || '').toLowerCase();
                        var st = (card.getAttribute('data-status') || '').toLowerCase();
                        var se = (card.getAttribute('data-service') || '').toLowerCase();
                        var cu = (card.getAttribute('data-customer') || '').toLowerCase();
                        var pl = (card.getAttribute('data-plate') || '').toLowerCase();
                        var matchQ = !qv || id.includes(qv) || se.includes(qv) || cu.includes(qv) || pl.includes(qv);
                        var matchS = !sv || st === sv;
                        var matchCat = !catv || se === catv;
                        card.style.display = (matchQ && matchS && matchCat) ? '' : 'none';
                    });
                }

                q.addEventListener('input', applyFilters);
                fStatus.addEventListener('change', applyFilters);
                fCategory.addEventListener('change', applyFilters);

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
                    var countI = document.querySelectorAll('#col-inprogress .queue-card').length;
                    var countN = document.querySelectorAll('#col-need .queue-card').length;
                    var countC = document.querySelectorAll('#col-completed .queue-card').length;
                    document.getElementById('count-waiting').textContent = countW;
                    document.getElementById('count-inprogress').textContent = countI;
                    document.getElementById('count-need').textContent = countN;
                    var head = document.getElementById('count-need-head'); if(head) head.textContent = countN + ' permintaan menunggu konfirmasi';
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
                document.querySelectorAll('#col-waiting .queue-card, #col-inprogress .queue-card, #col-need .queue-card, #col-completed .queue-card').forEach(function(card){
                    if(!card.hasAttribute('data-id')){ card.setAttribute('data-id', ''); }
                });
            });
        </script>

        <script>
            // Handle change on category filter to reload with query params
            (function(){
                const sel = document.getElementById('f-category');
                if (!sel) return;
                sel.addEventListener('change', function(){
                    const base = "{{ route('admin.antrian') }}";
                    const qEl = document.getElementById('q');
                    const stEl = document.getElementById('f-status');
                    const params = new URLSearchParams();
                    const qVal = qEl && qEl.value ? qEl.value : '';
                    const stVal = stEl && stEl.value ? stEl.value : '';
                    if (qVal) params.set('q', qVal);
                    if (stVal) params.set('status', stVal);
                    if (this.value) params.set('category', this.value);
                    window.location.href = base + (params.toString() ? ('?' + params.toString()) : '');
                });
            })();
        </script>
    </div>
</x-admin.dashboard-layout>
