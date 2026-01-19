@php
    // Helper function to get service names from booking details
    function getServiceNames($booking) {
        if (!$booking || !$booking->details) {
            return 'Layanan';
        }
        
        $names = $booking->details
            ->pluck('deskripsi')
            ->filter(function($desc) {
                return !empty($desc) && $desc !== '-';
            })
            ->join(', ');
        
        if (empty($names)) {
            $count = $booking->details->count();
            return $count > 0 ? $count . ' layanan (lihat detail)' : 'Layanan';
        }
        
        return $names;
    }
@endphp

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
                // Map database status ke UI status (dipisah jadi 2 kolom)
                switch($status) {
                    case \App\Models\AntriStruk::STATUS_PENDING:
                        return 'need_admin_price';
                    case \App\Models\AntriStruk::STATUS_HARGA_DARI_ADMIN:
                        return 'waiting_customer_confirm';
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
            $needAdminPrice = $byStatus->get('need_admin_price', collect());
            $waitingConfirm = $byStatus->get('waiting_customer_confirm', collect());
            // Tetap sediakan aggregate untuk kartu statistik "Butuh Konfirmasi"
            $needConfirmation = $needAdminPrice->concat($waitingConfirm);
            $completed = $byStatus->get('completed', collect());
        @endphp

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-5">
            <!-- Butuh Konfirmasi - Warm Yellow -->
            <div class="bg-gradient-to-br from-[#FFDC7F]/20 to-[#FFDC7F]/5 border-2 border-[#FFDC7F]/40 rounded-xl shadow-lg p-6 min-h-full flex flex-col hover:shadow-xl transition-all duration-200 hover:border-[#FFDC7F]/60">
                <p class="bigparafraf font-semibold text-[#B8941F] mb-4">Butuh Konfirmasi</p>
                <div class="flex items-center gap-4">
                    <div class="flex-1 bg-gradient-to-br from-[#FFDC7F]/25 to-[#FFDC7F]/10 border-2 border-[#FFDC7F]/30 rounded-lg p-4">
                        <p class="font-montserrat-36 font-bold text-[#B8941F]" id="count-need">{{ $needConfirmation->count() }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#FFDC7F] to-[#E6C870] rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-7 h-7 text-[#3D3D3D]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
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
            </div>

            <div class="bg-gradient-to-br from-[#F59E0B]/20 to-[#F59E0B]/5 border-2 border-[#F59E0B]/40 rounded-xl shadow-lg p-6 min-h-full flex flex-col hover:shadow-xl transition-all duration-200 hover:border-[#F59E0B]/60">
                <p class="bigparafraf font-semibold text-[#B45309] mb-4">Menunggu Konfirmasi Pelanggan</p>
                <div class="flex items-center gap-4">
                    <div class="flex-1 bg-gradient-to-br from-[#F59E0B]/25 to-[#F59E0B]/10 border-2 border-[#F59E0B]/30 rounded-lg p-4">
                        <p class="font-montserrat-36 font-bold text-[#B45309]" id="count-waiting-customer">{{ $waitingConfirm->count() }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#F59E0B] to-[#D97706] rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-7 h-7 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="m16 11l2 2l4-4m-6 12v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sedang Antri - Blue -->
            <div class="bg-gradient-to-br from-[#141E61]/10 to-[#141E61]/5 border-2 border-[#141E61]/30 rounded-xl shadow-lg p-6 min-h-full flex flex-col hover:shadow-xl transition-all duration-200 hover:border-[#141E61]/50">
                <p class="bigparafraf font-semibold text-[#141E61] mb-4">Sedang Antri</p>
                <div class="flex items-center gap-4">
                    <div class="flex-1 bg-gradient-to-br from-[#141E61]/15 to-[#0F044C]/10 border-2 border-[#141E61]/25 rounded-lg p-4">
                        <p class="font-montserrat-36 font-bold text-[#141E61]" id="count-waiting">{{ $waiting->count() }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#141E61] to-[#0F044C] rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-7 h-7 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g fill="none">
                                <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                                <path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 2a8 8 0 1 0 0 16a8 8 0 0 0 0-16m0 2a1 1 0 0 1 .993.883L13 7v4.586l2.707 2.707a1 1 0 0 1-1.32 1.497l-.094-.083l-3-3a1 1 0 0 1-.284-.576L11 12V7a1 1 0 0 1 1-1"/>
                            </g>
                        </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sedang Dikerjakan - Terracotta/Coral -->
            <div class="bg-gradient-to-br from-[#C66E52]/15 to-[#C66E52]/5 border-2 border-[#C66E52]/35 rounded-xl shadow-lg p-6 min-h-full flex flex-col hover:shadow-xl transition-all duration-200 hover:border-[#C66E52]/55">
                <p class="bigparafraf font-semibold text-[#A0523C] mb-4">Sedang Dikerjakan</p>
                <div class="flex items-center gap-4">
                    <div class="flex-1 bg-gradient-to-br from-[#C66E52]/20 to-[#C66E52]/10 border-2 border-[#C66E52]/25 rounded-lg p-4">
                        <p class="font-montserrat-36 font-bold text-[#A0523C]" id="count-inprogress">{{ $inProgress->count() }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#C66E52] to-[#A0523C] rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-7 h-7 text-white" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M13.41 3.596a.76.76 0 0 0-.35-.51l-2 2a1 1 0 0 1-1.44 0l-.76-.68a1 1 0 0 1 0-1.4l2-2a.76.76 0 0 0-.48-.43a3.8 3.8 0 0 0-4.2 5.309L.815 11.252a1 1 0 0 0 .014 1.428l.561.538a1 1 0 0 0 1.396-.01l5.428-5.37a3.81 3.81 0 0 0 5.196-4.242" stroke-width="1"/>
                        </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Selesai - Sage Green -->
            <div class="bg-gradient-to-br from-[#E7DEAF]/30 to-[#E7DEAF]/10 border-2 border-[#E7DEAF]/50 rounded-xl shadow-lg p-6 min-h-full flex flex-col hover:shadow-xl transition-all duration-200 hover:border-[#E7DEAF]/70">
                <p class="bigparafraf font-semibold text-[#7A8F5C] mb-4">Selesai Servis</p>
                <div class="flex items-center gap-4">
                    <div class="flex-1 bg-gradient-to-br from-[#E7DEAF]/40 to-[#E7DEAF]/15 border-2 border-[#E7DEAF]/35 rounded-lg p-4">
                        <p class="font-montserrat-36 font-bold text-[#7A8F5C]" id="count-completed">{{ $completed->count() }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#B8C999] to-[#A0B87E] rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-7 h-7 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="currentColor">
                                <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                                <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" clip-rule="evenodd"/>
                            </g>
                        </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Sections - 4 Kolom -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">
            <!-- BUTUH KONFIRMASI HARGA (Kolom 1) -->
            <div class="bg-white border-2 border-[#0F044C]/30 rounded-xl shadow-lg overflow-hidden flex flex-col">
                <div class="bg-gradient-to-r from-[#B8941F] to-[#9C7A14] border-b-2 border-[#B8941F] px-4 py-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
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
                            <h2 class="text-base sm:text-lg font-montserrat-48 font-bold text-white truncate">Butuh Konfirmasi</h2>
                            <p class="text-xs defparagraf text-white/80" id="count-need-head">{{ $needAdminPrice->count() }} item</p>
                        </div>
                    </div>
                </div>
                <div class="p-3 md:p-4 flex-1 overflow-y-auto max-h-[600px] two-card-scroll">
                    <div class="space-y-3" id="col-need">
                        @forelse($needAdminPrice as $booking)
                            @php
                                $servicesData = $booking->details ? $booking->details->map(function($detail) {
                                    return [
                                        "nama" => $detail->deskripsi,
                                        "harga_default" => optional($detail->layanan)->harga_default ?? 0,
                                        "permanen" => optional($detail->layanan)->permanen ?? false,
                                        "jumlah" => $detail->jumlah ?? 0,
                                        "harga_satuan" => $detail->harga_satuan ?? 0,
                                        "subtotal" => $detail->subtotal ?? 0
                                    ];
                                })->toArray() : [];
                            @endphp
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
                                                <span class="px-2 py-1 bg-[#FFDC7F]/20 text-[#B8941F] border border-[#FFDC7F]/40 text-xs font-semibold rounded-lg">MENUNGGU HARGA</span>
                                            @elseif ($status === \App\Models\AntriStruk::STATUS_HARGA_DARI_ADMIN)
                                                <span class="px-2 py-1 bg-[#FFDC7F]/20 text-[#B8941F] border border-[#FFDC7F]/40 text-xs font-semibold rounded-lg">HARGA DARI ADMIN</span>
                                            @else
                                                <span class="px-2 py-1 bg-[#FFDC7F]/20 text-[#B8941F] border border-[#FFDC7F]/40 text-xs font-semibold rounded-lg">KONFIRMASI</span>
                                            @endif
                                            <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->tanggal_pesan)->format('H:i') ?? '-' }} - {{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H:i') : '...' }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <h3 class="defparagraf font-bold text-[#0F044C] text-sm">{{ optional($booking->pelanggan)->nama ?? 'Pelanggan' }}</h3>
                                        </div>
                                        <p class="text-xs defparagraf text-[#787A91] mb-3">{{ optional($booking->tanggal_pesan)->format('d F Y') ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 pt-3 mb-3">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-sm defparagraf font-medium text-[#0F044C]">{{ getServiceNames($booking) }}</span>
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
                                            class="px-4 py-2 bg-[#1D2C90] text-white text-xs font-semibold rounded-lg hover:bg-[#0F044C] transition-colors"
                                            onclick="openAdminReceiptFromDataset(this)"
                                            data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                            data-antri-id="{{ $booking->id_antri_struk }}"
                                            data-date="{{ optional($booking->tanggal_pesan)->format('d/m/Y') }}"
                                            data-time="{{ optional($booking->tanggal_pesan)->format('H.i') }}"
                                            data-status="{{ strtolower($booking->status) }}"
                                            data-price-status="{{ strtolower($booking->price_status ?? '') }}"
                                            data-car="{{ optional($booking->mobil)->nama_mobil ? optional($booking->mobil)->nama_mobil.' ('.optional($booking->mobil)->plat_nomor.')' : '—' }}"
                                            data-services="{{ json_encode($servicesData) }}"
                                            data-is-pickup="{{ $booking->pengambilan ? '1' : '0' }}"
                                            data-is-delivery="{{ $booking->pengiriman ? '1' : '0' }}"
                                            data-pickup-address="{{ $booking->alamat_pengambilan ?? '' }}"
                                            data-delivery-address="{{ $booking->alamat_pengiriman ?? '' }}"
                                            data-address="{{ ($booking->pengambilan && $booking->alamat_pengambilan ? 'Jemput: '.$booking->alamat_pengambilan : '') . ($booking->pengiriman && $booking->alamat_pengiriman ? (($booking->pengambilan ? ' | ' : '').'Antar: '.$booking->alamat_pengiriman) : '') }}"
                                            data-notes="{{ $booking->catatan ?? '' }}"
                                            data-total-price="{{ $booking->harga_keseluruhan ?? 0 }}"
                                            data-mechanic="{{ optional($booking->montir)->nama ?? '' }}"
                                            data-start-service="{{ $booking->mulai_servis ? optional($booking->mulai_servis)->format('d/m/Y H:i') : '' }}"
                                            data-end-service="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('d/m/Y H:i') : '' }}"
                                            data-estimated-completion="{{ $booking->estimasi_selesai ? optional($booking->estimasi_selesai)->format('d/m/Y H:i') : '' }}"
                                            data-menginap="{{ $booking->menginap ? '1' : '0' }}"
                                            data-duration="{{ $booking->durasi_hari ?? 1 }}">
                                        Detail
                                    </button>

                                    @if ($status === \App\Models\AntriStruk::STATUS_PENDING)
                                        <button type="button"
                                                class="px-4 py-2 border border-[#0F044C] text-[#0F044C] text-xs font-semibold rounded-lg hover:bg-[#0F044C] hover:text-white transition-colors"
                                                class="px-4 py-2 bg-[#1D2C90] text-white text-xs font-semibold rounded-lg hover:bg-[#0F044C] transition-colors"
                                                onclick="openAdminReceiptFromDataset(this)"
                                                data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                                data-date="{{ optional($booking->tanggal_pesan)->format('d/m/Y') }}"
                                                data-time="{{ optional($booking->tanggal_pesan)->format('H.i') }} - {{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '...' }}"
                                                data-status="{{ strtolower($booking->status) }}"
                                                data-car="{{ optional($booking->mobil)->nama_mobil ? optional($booking->mobil)->nama_mobil.' ('.optional($booking->mobil)->plat_nomor.')' : '—' }}"
                                                data-services="{{ json_encode($servicesData) }}"
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

            <!-- MENUNGGU KONFIRMASI PELANGGAN (Kolom 2) -->
<div class="bg-white border-2 border-[#0F044C]/30 rounded-xl shadow-lg overflow-hidden flex flex-col">
    <div class="bg-gradient-to-r from-[#FFDC7F] to-[#FFCB47] border-b-2 border-yellow-500 px-4 py-3">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                <svg class="w-5 h-5 text-[#7A5E00]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="m16 11l2 2l4-4m-6 12v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></g></svg>
            </div>
            <div class="flex-1 min-w-0">
                <h2 class="text-base sm:text-lg font-montserrat-48 font-bold text-[#0F044C] truncate">Menunggu Konfirmasi Pelanggan</h2>
                <p class="text-xs defparagraf text-[#0F044C]/70">{{ $waitingConfirm->count() }} item</p>
            </div>
        </div>
    </div>
    <div class="p-3 md:p-4 flex-1 overflow-y-auto max-h-[600px] two-card-scroll">
        <div class="space-y-3" id="col-waiting-confirm">
            @forelse($waitingConfirm as $booking)
                @php
                    $servicesData = $booking->details ? $booking->details->map(function($detail) {
                        return [
                            "nama" => $detail->deskripsi,
                            "harga_default" => optional($detail->layanan)->harga_default ?? 0,
                            "permanen" => optional($detail->layanan)->permanen ?? false,
                            "jumlah" => $detail->jumlah ?? 0,
                            "harga_satuan" => $detail->harga_satuan ?? 0,
                            "subtotal" => $detail->subtotal ?? 0
                        ];
                    })->toArray() : [];
                @endphp
                <div class="bg-white border border-[#0F044C]/20 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow queue-card"
                     data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                     data-status="{{ strtolower($booking->status) }}"
                     data-service="{{ $booking->details->pluck('deskripsi')->join(', ') }}"
                     data-customer="{{ optional($booking->pelanggan)->nama ?? '-' }}"
                     data-plate="{{ optional($booking->mobil)->plat_nomor ?? '-' }}">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2 py-1 bg-yellow-100 text-[#7A5E00] border border-yellow-300 text-xs font-semibold rounded-lg">MENUNGGU KONFIRMASI</span>
                                <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->tanggal_pesan)->format('H:i') ?? '-' }} - {{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H:i') : '...' }}</span>
                            </div>
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <h3 class="defparagraf font-bold text-[#0F044C] text-sm">{{ optional($booking->pelanggan)->nama ?? 'Pelanggan' }}</h3>
                            </div>
                            <p class="text-xs defparagraf text-[#787A91] mb-3">{{ optional($booking->tanggal_pesan)->format('d F Y') ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-3 mb-3">
                        <div class="flex items-center gap-2 mb-2">
                            @php
                                $layananNames = $booking->details
                                    ->pluck('deskripsi')
                                    ->filter(function($desc) {
                                        return !empty($desc) && $desc !== '-';
                                    })
                                    ->join(', ');
                                if (empty($layananNames)) {
                                    $layananNames = $booking->details->count() . ' layanan (detail di struk)';
                                }
                            @endphp
                            <span class="text-sm defparagraf font-medium text-[#0F044C]">{{ $layananNames }}</span>
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
                                class="px-4 py-2 bg-[#1D2C90] text-white text-xs font-semibold rounded-lg hover:bg-[#0F044C] transition-colors"
                                onclick="openAdminReceiptFromDataset(this)"
                                data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                data-antri-id="{{ $booking->id_antri_struk }}"
                                data-date="{{ optional($booking->tanggal_pesan)->format('d/m/Y') }}"
                                data-time="{{ optional($booking->tanggal_pesan)->format('H.i') }}"
                                data-status="{{ strtolower($booking->status) }}"
                                data-price-status="{{ strtolower($booking->price_status ?? '') }}"
                                data-car="{{ optional($booking->mobil)->nama_mobil ? optional($booking->mobil)->nama_mobil.' ('.optional($booking->mobil)->plat_nomor.')' : '—' }}"
                                data-services="{{ json_encode($servicesData) }}"
                                data-is-pickup="{{ $booking->pengambilan ? '1' : '0' }}"
                                data-is-delivery="{{ $booking->pengiriman ? '1' : '0' }}"
                                data-pickup-address="{{ $booking->alamat_pengambilan ?? '' }}"
                                data-delivery-address="{{ $booking->alamat_pengiriman ?? '' }}"
                                data-address="{{ ($booking->pengambilan && $booking->alamat_pengambilan ? 'Jemput: '.$booking->alamat_pengambilan : '') . ($booking->pengiriman && $booking->alamat_pengiriman ? (($booking->pengambilan ? ' | ' : '').'Antar: '.$booking->alamat_pengiriman) : '') }}"
                                data-notes="{{ $booking->catatan ?? '' }}"
                                data-total-price="{{ $booking->harga_keseluruhan ?? 0 }}"
                                data-mechanic="{{ optional($booking->montir)->nama ?? '' }}"
                                data-start-service="{{ $booking->mulai_servis ? optional($booking->mulai_servis)->format('d/m/Y H:i') : '' }}"
                                data-end-service="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('d/m/Y H:i') : '' }}"
                                data-estimated-completion="{{ $booking->estimasi_selesai ? optional($booking->estimasi_selesai)->format('d/m/Y H:i') : '' }}"
                                data-menginap="{{ $booking->menginap ? '1' : '0' }}"
                                data-duration="{{ $booking->durasi_hari ?? 1 }}">
                            Detail
                        </button>
                        <form method="POST" action="{{ route('admin.antrian.cancel', $booking->nomor_booking ?? $booking->id_antri_struk) }}" class="inline">
                            @csrf
                            <button class="px-4 py-2 border border-red-600 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-600 hover:text-white transition-colors">Batal</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="defparagraf text-[#787A91] text-sm">Tidak ada item</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- SEDANG ANTRI (Kolom 3) -->
            <div class="bg-white border-2 border-[#141E61]/30 rounded-xl shadow-lg overflow-hidden flex flex-col">
                <div class="bg-gradient-to-r from-[#141E61] to-[#0F044C] border-b-2 border-[#141E61] px-4 py-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="none">
                                    <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                                    <path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 2a8 8 0 1 0 0 16a8 8 0 0 0 0-16m0 2a1 1 0 0 1 .993.883L13 7v4.586l2.707 2.707a1 1 0 0 1-1.32 1.497l-.094-.083l-3-3a1 1 0 0 1-.284-.576L11 12V7a1 1 0 0 1 1-1"/>
                                </g>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-base sm:text-lg font-montserrat-48 font-bold text-white truncate">Sedang Antri</h2>
                            <p class="text-xs defparagraf text-white/80">{{ $waiting->count() }} item</p>
                        </div>
                    </div>
                </div>
                <div class="p-3 md:p-4 flex-1 overflow-y-auto max-h-[600px]">
                    <div class="space-y-3" id="col-waiting">
                        @forelse($waiting as $booking)
                            @php
                                $servicesData = $booking->details ? $booking->details->map(function($detail) {
                                    return [
                                        "nama" => $detail->deskripsi,
                                        "harga_default" => optional($detail->layanan)->harga_default ?? 0,
                                        "permanen" => optional($detail->layanan)->permanen ?? false,
                                        "jumlah" => $detail->jumlah ?? 0,
                                        "harga_satuan" => $detail->harga_satuan ?? 0,
                                        "subtotal" => $detail->subtotal ?? 0
                                    ];
                                })->toArray() : [];
                            @endphp
                            <div class="bg-white border border-[#0F044C]/20 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow queue-card"
                                 data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                 data-status="waiting"
                                 data-service="{{ $booking->details->pluck('deskripsi')->join(', ') }}"
                                 data-customer="{{ optional($booking->pelanggan)->nama ?? '-' }}"
                                 data-plate="{{ optional($booking->mobil)->plat_nomor ?? '-' }}">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="px-2 py-1 bg-[#141E61]/10 text-[#141E61] border border-[#141E61]/20 text-xs font-semibold rounded-lg">ANTRI</span>
                                            <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->tanggal_pesan)->format('H:i') ?? '-' }} - {{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H:i') : '...' }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <h3 class="defparagraf font-bold text-[#0F044C] text-sm">{{ optional($booking->pelanggan)->nama ?? 'Pelanggan' }}</h3>
                                        </div>
                                        <p class="text-xs defparagraf text-[#787A91] mb-3">{{ optional($booking->tanggal_pesan)->format('d F Y') ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 pt-3 mb-3">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-sm defparagraf font-medium text-[#0F044C]">{{ getServiceNames($booking) }}</span>
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
                                                data-services="{{ json_encode($servicesData) }}"
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
            <div class="bg-white border-2 border border-[#C66E52]/30 rounded-xl shadow-lg overflow-hidden flex flex-col">
                <div class="bg-gradient-to-r from-[#C66E52] to-[#A0523C] border-b-2 border-[#C66E52] px-4 py-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M13.41 3.596a.76.76 0 0 0-.35-.51l-2 2a1 1 0 0 1-1.44 0l-.76-.68a1 1 0 0 1 0-1.4l2-2a.76.76 0 0 0-.48-.43a3.8 3.8 0 0 0-4.2 5.309L.815 11.252a1 1 0 0 0 .014 1.428l.561.538a1 1 0 0 0 1.396-.01l5.428-5.37a3.81 3.81 0 0 0 5.196-4.242" stroke-width="1"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-base sm:text-lg font-montserrat-48 font-bold text-white truncate">Sedang Dikerjakan</h2>
                            <p class="text-xs defparagraf text-white/80">{{ $inProgress->count() }} item</p>
                        </div>
                    </div>
                </div>
                <div class="p-3 md:p-4 flex-1 overflow-y-auto max-h-[600px]">
                    <div class="space-y-3" id="col-inprogress">
                        @forelse($inProgress as $booking)
                            @php
                                $servicesData = $booking->details ? $booking->details->map(function($detail) {
                                    return [
                                        "nama" => $detail->deskripsi,
                                        "harga_default" => optional($detail->layanan)->harga_default ?? 0,
                                        "permanen" => optional($detail->layanan)->permanen ?? false,
                                        "jumlah" => $detail->jumlah ?? 0,
                                        "harga_satuan" => $detail->harga_satuan ?? 0,
                                        "subtotal" => $detail->subtotal ?? 0
                                    ];
                                })->toArray() : [];
                            @endphp
                            <div class="bg-white border border-[#0F044C]/20 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow queue-card"
                                 data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                 data-status="in_progress"
                                 data-service="{{ $booking->details->pluck('deskripsi')->join(', ') }}"
                                 data-customer="{{ optional($booking->pelanggan)->nama ?? '-' }}"
                                 data-plate="{{ optional($booking->mobil)->plat_nomor ?? '-' }}">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="px-2 py-1 bg-[#C66E52]/15 text-[#A0523C] border border-[#C66E52]/30 text-xs font-semibold rounded-lg">DIKERJAKAN</span>
                                            <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->tanggal_pesan)->format('H:i') ?? '-' }} - {{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H:i') : '...' }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <h3 class="defparagraf font-bold text-[#A0523C] text-sm">{{ optional($booking->pelanggan)->nama ?? 'Pelanggan' }}</h3>
                                        </div>
                                        <p class="text-xs defparagraf text-[#787A91] mb-3">{{ optional($booking->tanggal_pesan)->format('d F Y') ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 pt-3 mb-3">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-sm defparagraf font-medium text-[#A0523C]">{{ getServiceNames($booking) }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->mobil)->nama_mobil ?? '-' }} • {{ optional($booking->mobil)->plat_nomor ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                    <div class="text-base defparagraf font-bold text-[#A0523C]">Rp {{ number_format($booking->harga_keseluruhan ?? 0, 0, ',', '.') }}</div>
                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('admin.antrian.finish', $booking->nomor_booking ?? $booking->id_antri_struk) }}">
                                            @csrf
                                            <button class="px-3 py-1.5 border-[#C66E52] text-[#A0523C] text-xs font-semibold rounded-lg hover:bg-[#A0523C] transition-colors">Selesai</button>
                                        </form>
                                        <button class="px-3 py-1.5 border border-[#0F044C] text-[#0F044C] text-xs font-semibold rounded-lg hover:bg-[#C66E52] hover:text-white transition-colors"
                                                onclick="openAdminReceiptFromDataset(this)"
                                                data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                                data-date="{{ optional($booking->tanggal_pesan)->format('d/m/Y') }}"
                                                data-time="{{ optional($booking->tanggal_pesan)->format('H.i') }} - {{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '...' }}"
                                                data-status="{{ strtolower($booking->status) }}"
                                                data-car="{{ optional($booking->mobil)->nama_mobil ? optional($booking->mobil)->nama_mobil.' ('.optional($booking->mobil)->plat_nomor.')' : '—' }}"
                                                data-services="{{ json_encode($servicesData) }}"
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
        <div class="bg-white border-2 border-[#787A91]/30 rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-[#7A8F5C] to-[#5E7043] border-b-2 border-[#7A8F5C] px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center shadow-md">
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="currentColor">
                                    <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                                    <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" clip-rule="evenodd"/>
                                </g>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg sm:text-xl font-montserrat-48 font-bold text-white">Selesai Servis</h2>
                            <p class="text-xs defparagraf text-white/80">{{ $completed->count() }} servis telah selesai</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 md:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="col-completed">
                    @forelse($completed as $booking)
                        @php
                            $servicesData = $booking->details ? $booking->details->map(function($detail) {
                                return [
                                    "nama" => $detail->deskripsi,
                                    "harga_default" => optional($detail->layanan)->harga_default ?? 0,
                                    "permanen" => optional($detail->layanan)->permanen ?? false,
                                    "jumlah" => $detail->jumlah ?? 0,
                                    "harga_satuan" => $detail->harga_satuan ?? 0,
                                    "subtotal" => $detail->subtotal ?? 0
                                ];
                            })->toArray() : [];
                        @endphp
                        <div class="bg-white border border-[#0F044C]/20 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow queue-card"
                                 data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                                 data-status="completed"
                                 data-service="{{ $booking->details->pluck('deskripsi')->join(', ') }}"
                                 data-customer="{{ optional($booking->pelanggan)->nama ?? '-' }}"
                                 data-plate="{{ optional($booking->mobil)->plat_nomor ?? '-' }}">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="px-2 py-1 bg-[#E7DEAF]/20 text-[#7A8F5C] border border-[#E7DEAF]/40 text-xs font-semibold rounded-lg">SELESAI</span>
                                            <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->tanggal_pesan)->format('H:i') ?? '-' }} - {{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H:i') : '...' }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <svg class="w-4 h-4 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <h3 class="defparagraf font-bold text-[#0F044C] text-sm">{{ optional($booking->pelanggan)->nama ?? 'Pelanggan' }}</h3>
                                        </div>
                                        <p class="text-xs defparagraf text-[#787A91] mb-3">{{ optional($booking->tanggal_pesan)->format('d F Y') ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 pt-3 mb-3">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-sm defparagraf font-medium text-[#0F044C]">{{ getServiceNames($booking) }}</span>
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
                                            data-services="{{ json_encode($servicesData) }}"
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

        <!-- Komponen modal struk admin untuk direuse -->
        <x-admin.receipt-modal />

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

        <script>(function(){function c(e){try{var t=e.querySelectorAll('.queue-card');if(!t.length)return null;var n=t[0].offsetHeight;if(t.length>1){n+=t[1].offsetHeight;n+=12}var r=getComputedStyle(e),a=parseFloat(r.paddingTop||0),o=parseFloat(r.paddingBottom||0);n+=a+o;n+=4;return n}catch(i){return null}}function s(){document.querySelectorAll('.two-card-scroll').forEach(function(e){var t=c(e);if(t)e.style.maxHeight=t+'px';e.style.overflowY='auto'})}window.addEventListener('load',s);window.addEventListener('resize',s);document.addEventListener('DOMContentLoaded',s)})();</script>

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

        <!-- Include Admin Receipt Modal Component -->
        <x-admin.receipt-modal />

        <!-- Debug JavaScript for Modal Issues -->
        <script>
            // Debug function to test modal opening
            window.testModal = function() {
                console.log('Testing modal...');
                const modal = document.getElementById('adminBookingReceiptModal');
                if (!modal) {
                    console.error('Modal element not found!');
                    return;
                }
                console.log('Modal found, attempting to show...');
                modal.classList.remove('hidden');
                console.log('Modal should now be visible');
            };

            // Debug function to test openAdminReceiptFromDataset
            window.debugModalFunction = function() {
                if (typeof window.openAdminReceiptFromDataset === 'function') {
                    console.log('openAdminReceiptFromDataset function is available');
                } else {
                    console.error('openAdminReceiptFromDataset function is NOT available');
                }

                if (typeof window.closeAdminReceiptModal === 'function') {
                    console.log('closeAdminReceiptModal function is available');
                } else {
                    console.error('closeAdminReceiptModal function is NOT available');
                }
            };

            // Check when DOM is ready
            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOM loaded, checking modal functions...');
                setTimeout(function() {
                    debugModalFunction();
                }, 1000); // Wait 1 second for all scripts to load
            });

            // Add click event debugging
            document.addEventListener('click', function(e) {
                if (e.target.getAttribute('onclick') && e.target.getAttribute('onclick').includes('openAdminReceiptFromDataset')) {
                    console.log('Modal trigger button clicked:', e.target);
                    console.log('Button dataset:', e.target.dataset);
                }
            });
        </script>



        <!-- Essential Debug Scripts -->
        <script>
            // Simple debug functions for troubleshooting if needed
            window.debugModal = function() {
                const modal = document.getElementById('adminBookingReceiptModal');
                const buttons = document.querySelectorAll('[onclick*="openAdminReceiptFromDataset"]');
                console.log('Modal element:', modal ? '✅ Found' : '❌ Not found');
                console.log('Modal buttons:', buttons.length);
                console.log('Functions available:', {
                    openModal: typeof window.openAdminReceiptFromDataset === 'function',
                    closeModal: typeof window.closeAdminReceiptModal === 'function'
                });
            };
        </script>
    </div>
</x-admin.dashboard-layout>

