<x-admin.dashboard-layout title="Manajemen Antrian - Dwi AC Mobil">
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Header -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 text-gray-900 uppercase mb-2">Manajemen Antrian</h1>
                    <p class="text-gray-600 defparagraf">Pantau antrian, konfirmasi harga, dan servis yang sudah selesai.</p>
                </div>
                <button onclick="openCreateModal()" class="bg-[#0F044C] hover:bg-[#141E61] text-white px-6 py-3 defparagraf font-medium flex items-center space-x-2 transition-colors">
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
                        <select id="f-category" class="w-full px-4 py-3 border-2 border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf">
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

        <!-- Ringkasan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 flex items-center justify-between">
                <div>
                    <div class="defparagraf text-[#787A91] text-xs">Sedang Antri</div>
                    <div class="text-2xl font-bold defparagraf text-[#0F044C]" id="count-waiting">{{ $waiting->count() }}</div>
                </div>
                <div class="w-10 h-10 bg-green-50 border border-green-300 flex items-center justify-center">
                    <!-- Icon: Booking Dikonfirmasi (green check) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700" viewBox="0 0 24 24">
                        <g fill="currentColor">
                            <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                            <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" clip-rule="evenodd"/>
                        </g>
                    </svg>
                </div>
            </div>
            <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 flex items-center justify-between">
                <div>
                    <div class="defparagraf text-[#787A91] text-xs">Sedang Dikerjakan</div>
                    <div class="text-2xl font-bold defparagraf text-[#0F044C]" id="count-inprogress">{{ $inProgress->count() }}</div>
                </div>
                <div class="w-10 h-10 bg-blue-50 border border-blue-300 flex items-center justify-center">
                    <!-- Icon: Pending clock/info (blue) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-700" viewBox="0 0 24 24">
                        <g fill="none">
                            <path d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12"/>
                            <path stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12Z"/>
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 7v6m0 4h.01"/>
                        </g>
                    </svg>
                </div>
            </div>
            <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 flex items-center justify-between">
                <div>
                    <div class="defparagraf text-[#787A91] text-xs">Butuh Konfirmasi</div>
                    <div class="text-2xl font-bold defparagraf text-[#0F044C]" id="count-need">{{ $needConfirmation->count() }}</div>
                </div>
                <div class="w-10 h-10 bg-yellow-50 border border-yellow-500 flex items-center justify-center">
                    <!-- Icon: Harga dari Admin (yellow badge) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-700" viewBox="0 0 24 24">
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
            <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 flex items-center justify-between">
                <div>
                    <div class="defparagraf text-[#787A91] text-xs">Selesai</div>
                    <div class="text-2xl font-bold defparagraf text-[#0F044C]" id="count-completed">{{ $completed->count() }}</div>
                </div>
                <div class="w-10 h-10 bg-blue-50 border border-blue-300 flex items-center justify-center">
                    <!-- Icon: Layanan Selesai (blue check circle) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-700" viewBox="0 0 24 24">
                        <g fill="currentColor">
                            <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                            <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" clip-rule="evenodd"/>
                        </g>
                    </svg>
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
                    @foreach($waiting as $booking)
                        <div class="border-2 border-gray-800 p-3 bg-white queue-card"
                             data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                             data-status="waiting"
                             data-service="{{ $booking->details->pluck('deskripsi')->join(', ') }}"
                             data-customer="{{ optional($booking->pelanggan)->nama ?? '-' }}"
                             data-plate="{{ optional($booking->mobil)->plat_nomor ?? '-' }}">
                            <div class="flex items-start justify-between mb-1">
                                <div class="defparagraf font-semibold text-[#0F044C] text-sm">{{ $booking->details->pluck('deskripsi')->join(', ') ?: 'Layanan' }}</div>
                                <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->tanggal_pesan)->format('H:i') ?? '-' }}</span>
                            </div>
                            <div class="text-xs defparagraf text-[#787A91] mb-1">{{ optional($booking->tanggal_pesan)->format('d/m/Y') ?? '-' }}</div>
                            <div class="mb-1">
                                <div class="text-xs defparagraf text-[#0F044C] font-medium">{{ optional($booking->pelanggan)->nama ?? '-' }}</div>
                                <div class="text-xs defparagraf text-[#787A91]">{{ optional($booking->mobil)->nama_mobil ?? '-' }} • {{ optional($booking->mobil)->plat_nomor ?? '-' }}</div>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-sm defparagraf text-[#0F044C] font-semibold">Rp {{ number_format($booking->harga_keseluruhan ?? 0, 0, ',', '.') }}</div>
                                <div class="flex gap-2">
                                    <form method="POST" action="{{ route('admin.antrian.start', $booking->nomor_booking ?? $booking->id_antri_struk) }}">
                                        @csrf
                                        <button class="px-3 py-1 border border-[#0F044C] text-[#0F044C] defparagraf text-xs hover:bg-[#EEEEEE]">Mulai</button>
                                    </form>
                                    <button class="px-3 py-1 bg-[#141E61] text-white defparagraf text-xs hover:bg-[#0F044C]" 
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
                                            data-endtime="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '' }}">Detail Struk</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @foreach($inProgress as $booking)
                        <div class="border-2 border-gray-800 p-3 bg-white queue-card"
                             data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                             data-status="in_progress"
                             data-service="{{ $booking->details->pluck('deskripsi')->join(', ') }}"
                             data-customer="{{ optional($booking->pelanggan)->nama ?? '-' }}"
                             data-plate="{{ optional($booking->mobil)->plat_nomor ?? '-' }}">
                            <div class="flex items-start justify-between mb-1">
                                <div class="defparagraf font-semibold text-[#0F044C] text-sm">{{ $booking->details->pluck('deskripsi')->join(', ') ?: 'Layanan' }}</div>
                                <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->tanggal_pesan)->format('H:i') ?? '-' }}</span>
                            </div>
                            <div class="text-xs defparagraf text-[#787A91] mb-1">{{ optional($booking->tanggal_pesan)->format('d/m/Y') ?? '-' }}</div>
                            <div class="mb-1">
                                <div class="text-xs defparagraf text-[#0F044C] font-medium">{{ optional($booking->pelanggan)->nama ?? '-' }}</div>
                                <div class="text-xs defparagraf text-[#787A91]">{{ optional($booking->mobil)->nama_mobil ?? '-' }} • {{ optional($booking->mobil)->plat_nomor ?? '-' }}</div>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-sm defparagraf text-[#0F044C] font-semibold">Rp {{ number_format($booking->harga_keseluruhan ?? 0, 0, ',', '.') }}</div>
                                <div class="flex gap-2">
                                    <form method="POST" action="{{ route('admin.antrian.finish', $booking->nomor_booking ?? $booking->id_antri_struk) }}">
                                        @csrf
                                        <button class="px-3 py-1 border border-[#0F044C] text-[#0F044C] defparagraf text-xs hover:bg-[#EEEEEE]">Selesai</button>
                                    </form>
                                    <button class="px-3 py-1 bg-[#141E61] text-white defparagraf text-xs hover:bg-[#0F044C]" 
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
                                            data-endtime="{{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->format('H.i') : '' }}">Detail Struk</button>
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
                    @foreach($needConfirmation as $booking)
                        <div class="border-2 border-gray-800 p-3 bg-white queue-card"
                             data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                             data-status="need_confirmation"
                             data-service="{{ $booking->details->pluck('deskripsi')->join(', ') }}"
                             data-customer="{{ optional($booking->pelanggan)->nama ?? '-' }}"
                             data-plate="{{ optional($booking->mobil)->plat_nomor ?? '-' }}">
                            <div class="flex items-start justify-between mb-1">
                                <div class="defparagraf font-semibold text-[#0F044C] text-sm">{{ $booking->details->pluck('deskripsi')->join(', ') ?: 'Layanan' }}</div>
                                <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->tanggal_pesan)->format('H:i') ?? '-' }}</span>
                            </div>
                            <div class="text-xs defparagraf text-[#787A91] mb-1">{{ optional($booking->tanggal_pesan)->format('d/m/Y') ?? '-' }}</div>
                            <div class="mb-1">
                                <div class="text-xs defparagraf text-[#0F044C] font-medium">{{ optional($booking->pelanggan)->nama ?? '-' }}</div>
                                <div class="text-xs defparagraf text-[#787A91]">{{ optional($booking->mobil)->nama_mobil ?? '-' }} • {{ optional($booking->mobil)->plat_nomor ?? '-' }}</div>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-sm defparagraf text-[#0F044C] font-semibold">Rp {{ number_format($booking->harga_keseluruhan ?? 0, 0, ',', '.') }}</div>
                                <div class="flex items-center gap-1 min-w-0">
                                    {{-- Detail Struk - Always available --}}
                                    <button type="button" 
                                            class="px-2 py-1 text-xs border border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white defparagraf whitespace-nowrap"
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
                                    
                                    @php $status = strtolower($booking->status ?? ''); @endphp
                                    {{-- Action buttons based on status --}}
                                    @if ($status === \App\Models\AntriStruk::STATUS_PENDING)
                                      <span class="inline-flex items-center gap-1 px-2 py-1 text-xs defparagraf bg-blue-50 border border-blue-500 text-blue-800 mr-2 whitespace-nowrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="inline-block">
                                            <g fill="none">
                                                <path d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12"/>
                                                <path stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12Z"/>
                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 7v6m0 4h.01"/>
                                            </g>
                                        </svg>
                                        Menunggu harga admin
                                      </span>
                                      <button type="button" 
                                              class="px-2 py-1 text-xs bg-[#141E61] text-white hover:bg-[#0F044C] defparagraf whitespace-nowrap"
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
                                        <button class="px-2 py-1 text-xs border border-red-600 text-red-600 hover:bg-red-600 hover:text-white defparagraf whitespace-nowrap">Batal</button>
                                      </form>
                                    @elseif ($status === \App\Models\AntriStruk::STATUS_HARGA_DARI_ADMIN)
                                      <span class="inline-flex items-center gap-1 px-2 py-1 text-xs defparagraf text-yellow-800 bg-yellow-50 border border-yellow-500 whitespace-nowrap" title="Menunggu konfirmasi pelanggan">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="inline-block">
                                            <defs><path id="admBadgeIcon" d="M21.5 11v10h-19V11z"/></defs>
                                            <g fill="none">
                                                <use href="#admBadgeIcon"/>
                                                <path d="M12 13.5a2.5 2.5 0 1 1 0 5a2.5 2.5 0 0 1 0-5m5.136-7.209L19 5.67l1.824 5.333H3.002L3 11.004L14.146 2.1z"/>
                                                <path stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M21 11.003h-.176L19.001 5.67L3.354 11.003L3 11m-.5.004H3L14.146 2.1l2.817 3.95"/>
                                                <g stroke="currentColor" stroke-linecap="square" stroke-width="2">
                                                    <path d="M14.5 16a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0Z"/>
                                                    <use href="#admBadgeIcon"/>
                                                    <path d="M2.5 11h2a2 2 0 0 1-2 2zm19 0h-2a2 2 0 0 0 2 2zm-19 10h2.002A2 2 0 0 0 2.5 18.998zm19 0h-2a2 2 0 0 1 2-2z"/>
                                                </g>
                                            </g>
                                        </svg>
                                        Harga dari Admin
                                      </span>
                                      <form method="POST" action="{{ route('admin.antrian.cancel', $booking->nomor_booking ?? $booking->id_antri_struk) }}" class="inline">
                                        @csrf
                                        <button class="px-2 py-1 text-xs border border-red-600 text-red-600 hover:bg-red-600 hover:text-white defparagraf whitespace-nowrap">Batal</button>
                                      </form>
                                    @else
                                      {{-- status lain: hanya tombol batal --}}
                                      <form method="POST" action="{{ route('admin.antrian.cancel', $booking->nomor_booking ?? $booking->id_antri_struk) }}" class="inline">
                                        @csrf
                                        <button class="px-2 py-1 text-xs border border-red-600 text-red-600 hover:bg-red-600 hover:text-white defparagraf whitespace-nowrap">Batal</button>
                                      </form>
                                    @endif
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
                    @foreach($completed as $booking)
                        <div class="border-2 border-gray-800 p-3 bg-white queue-card"
                             data-id="{{ $booking->nomor_booking ?? $booking->id_antri_struk }}"
                             data-status="completed"
                             data-service="{{ $booking->details->pluck('deskripsi')->join(', ') }}"
                             data-customer="{{ optional($booking->pelanggan)->nama ?? '-' }}"
                             data-plate="{{ optional($booking->mobil)->plat_nomor ?? '-' }}">
                            <div class="flex items-start justify-between mb-1">
                                <div class="defparagraf font-semibold text-[#0F044C] text-sm">{{ $booking->details->pluck('deskripsi')->join(', ') ?: 'Layanan' }}</div>
                                <span class="text-xs defparagraf text-[#787A91]">{{ optional($booking->tanggal_pesan)->format('H:i') ?? '-' }}</span>
                            </div>
                            <div class="text-xs defparagraf text-[#787A91] mb-1">{{ optional($booking->tanggal_pesan)->format('d/m/Y') ?? '-' }}</div>
                            <div class="mb-1">
                                <div class="text-xs defparagraf text-[#0F044C] font-medium">{{ optional($booking->pelanggan)->nama ?? '-' }}</div>
                                <div class="text-xs defparagraf text-[#787A91]">{{ optional($booking->mobil)->nama_mobil ?? '-' }} • {{ optional($booking->mobil)->plat_nomor ?? '-' }}</div>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-sm defparagraf text-[#0F044C] font-semibold">Rp {{ number_format($booking->harga_keseluruhan ?? 0, 0, ',', '.') }}</div>
                                <div class="flex gap-2">
                                    <button class="px-3 py-1 bg-[#141E61] text-white defparagraf text-xs hover:bg-[#0F044C]" 
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
