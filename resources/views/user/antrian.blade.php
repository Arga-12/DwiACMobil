<x-user.dashboard-layout>
    <!-- Manajemen Antrian -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Header Section (compact for Antrian) -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 uppercase text-gray-900 font-bold tracking-tight">Manajemen Antrian</h1>
            <p class="text-gray-600 defparagraf text-sm sm:text-base">Kelola antrian aktif, riwayat, dan detail booking Anda.</p>
        </div>

        @php
            // Normalize current bookings to an array list and keep only non-finished statuses
            $currentBookings = [];
            if (isset($currentBooking)) {
                if ($currentBooking instanceof \Illuminate\Support\Collection) {
                    $currentBookings = $currentBooking->values()->all();
                } elseif (is_array($currentBooking)) {
                    $arr = isset($currentBooking['data']) && is_array($currentBooking['data'])
                        ? $currentBooking['data']
                        : $currentBooking;
                    $isList = function_exists('array_is_list')
                        ? array_is_list($arr)
                        : (array_keys($arr) === range(0, count($arr) - 1));
                    $currentBookings = $isList ? $arr : array_values($arr);
                } else {
                    $currentBookings = [$currentBooking];
                }
                $currentBookings = array_values(array_filter($currentBookings, function($item) {
                    $status = is_array($item) ? ($item['status'] ?? null) : ($item->status ?? null);
                    $status = strtolower((string)$status);
                    return !in_array($status, ['selesai']);
                }));
            }

            // Normalize history entries for quick overview
            $historyEntries = [];
            if (isset($riwayat)) {
                if ($riwayat instanceof \Illuminate\Support\Collection) {
                    $historyEntries = $riwayat->values()->all();
                } elseif (is_array($riwayat)) {
                    $historyEntries = $riwayat;
                }
            }

            $activeCount = count($currentBookings);
            $totalHistory = count($historyEntries);
            $completedHistory = 0;
            $cancelledHistory = 0;
            $waitingCount = 0;
            $queueCount = 0;
            $inProgressCount = 0;

            foreach ($historyEntries as $entry) {
                $status = is_array($entry) ? ($entry['status'] ?? null) : ($entry->status ?? null);
                $statusNormalized = strtolower((string)$status);
                if (in_array($statusNormalized, ['selesai', 'completed'])) {
                    $completedHistory++;
                }
                if (in_array($statusNormalized, ['cancelled', 'dibatalkan'])) {
                    $cancelledHistory++;
                }
            }

            foreach ($currentBookings as $entry) {
                $status = is_array($entry) ? ($entry['status'] ?? null) : ($entry->status ?? null);
                $statusNormalized = strtolower((string)$status);
                if (in_array($statusNormalized, ['pending', 'harga_dari_admin'])) {
                    $waitingCount++;
                }
                if ($statusNormalized === 'dalam_antrian') {
                    $queueCount++;
                }
                if ($statusNormalized === 'dalam_servisan') {
                    $inProgressCount++;
                }
            }
        @endphp
        <!-- Quick Insights -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-white border-2 border-[#FFDC7F]/70 rounded-2xl px-5 py-6 shadow-sm hover:shadow-xl transition-all duration-200 hover:border-[#FFDC7F]/80">
                <p class="montserrat-regular-10 uppercase bg-gradient-to-r from-[#e2b500f6] to-[#c09000ea] bg-clip-text text-transparent">Butuh Konfirmasi</p>
                <p class="text-3xl font-bold mt-2 bg-gradient-to-r from-[#e2b500f6] to-[#c09000ea] bg-clip-text text-transparent">{{ $waitingCount }}</p>
                <p class="defparagraf mt-3 bg-gradient-to-r from-[#e2b500f6] to-[#c09000ea] bg-clip-text text-transparent">Pending / Konfirmasi harga.</p>
            </div>
            <div class="bg-white border-2 border-[#141E61]/70 rounded-2xl px-5 py-6 shadow-sm hover:shadow-xl transition-all duration-200 hover:border-[#141E61]/80">
                <p class="montserrat-regular-10 uppercase bg-gradient-to-r from-[#141E61] to-[#0F044C] bg-clip-text text-transparent">Sedang Antri</p>
                <p class="text-3xl font-bold mt-2 bg-gradient-to-r from-[#141E61] to-[#0F044C] bg-clip-text text-transparent">{{ $queueCount }}</p>
                <p class="defparagraf mt-3 bg-gradient-to-r from-[#141E61] to-[#0F044C] bg-clip-text text-transparent">Antrian yang menunggu giliran.</p>
            </div>
            <div class="bg-white border-2 border-[#C66E52]/70 rounded-2xl px-5 py-6 shadow-sm hover:shadow-xl transition-all duration-200 hover:border-[#C66E52]/80">
                <p class="montserrat-regular-10 uppercase bg-gradient-to-r from-[#A0523C] to-[#7A3E2B] bg-clip-text text-transparent">Sedang Dikerjakan</p>
                <p class="text-3xl font-bold mt-2 bg-gradient-to-r from-[#A0523C] to-[#7A3E2B] bg-clip-text text-transparent">{{ $inProgressCount }}</p>
                <p class="defparagraf mt-3 bg-gradient-to-r from-[#A0523C] to-[#7A3E2B] bg-clip-text text-transparent">Unit dalam pengerjaan.</p>
            </div>
            <div class="bg-white border-2 border-[#B8C999]/70 rounded-2xl px-5 py-6 shadow-sm hover:shadow-xl transition-all duration-200 hover:border-[#B8C999]/80">
                <p class="montserrat-regular-10 uppercase bg-gradient-to-r from-[#7A8F5C] to-[#5E7346] bg-clip-text text-transparent">Selesai Servis</p>
                <p class="text-3xl font-bold mt-2 bg-gradient-to-r from-[#7A8F5C] to-[#5E7346] bg-clip-text text-transparent">{{ $completedHistory }}</p>
                <p class="defparagraf mt-3 bg-gradient-to-r from-[#7A8F5C] to-[#5E7346] bg-clip-text text-transparent">Pesanan selesai.</p>
            </div>
        </div>
        <!-- Antrian Saat Ini -->
        <div class="space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h2 class="sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 uppercase">Antrian Saat Ini</h2>
                </div>
                @if(!empty($currentBookings))
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#0F044C]/5 border border-[#0F044C]/10 defparagraf text-[#0F044C] uppercase font-semibold">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                        {{ count($currentBookings) }} Booking aktif
                    </span>
                @endif
            </div>
            @if(!empty($currentBookings) && count($currentBookings) > 0)
                <div class="bg-white border border-[#0F044C]/10 rounded-3xl shadow-sm px-4 sm:px-6 py-6 sm:py-8 relative overflow-hidden">
                    <div class="absolute left-5 sm:left-8 top-10 bottom-10 w-px bg-gradient-to-b from-[#0F044C]/30 via-[#0F044C]/15 to-transparent pointer-events-none"></div>
                    <div class="space-y-12 sm:space-y-10 relative">
                        @foreach($currentBookings as $booking)
                        @php
                            $statusTextCb = is_array($booking) ? ($booking['status'] ?? 'pending') : ($booking->status ?? 'pending');
                            $statusDisplayCb = match(strtolower(trim((string)$statusTextCb))) {
                                'pending' => 'Menunggu Konfirmasi harga',
                                'harga_dari_admin' => 'Konfirmasi harga dari Montir',
                                'dalam_antrian' => 'Dalam Antrian',
                                'dalam_servisan' => 'Dalam Servisan',
                                'selesai', 'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                                default => ucwords(str_replace('_', ' ', strtolower((string)$statusTextCb)))
                            };
                            $statusColor = match(strtolower(trim((string)$statusTextCb))) {
                                'pending', 'harga_dari_admin' => 'bg-[#FFDC7F]/20 text-[#B8941F] border-[#FFDC7F]/40',
                                'dalam_antrian' => 'bg-[#141E61]/10 text-[#141E61] border-[#141E61]/30',
                                'dalam_servisan' => 'bg-[#C66E52]/15 text-[#A0523C] border-[#C66E52]/35',
                                'selesai', 'completed' => 'bg-[#B8C999]/20 text-[#7A8F5C] border-[#B8C999]/40',
                                'cancelled' => 'bg-gray-100 text-gray-700 border-gray-300',
                                default => 'bg-gray-50 text-gray-700 border-gray-200'
                            };
                            $accentDot = match(strtolower(trim((string)$statusTextCb))) {
                                'pending', 'harga_dari_admin' => 'bg-[#B8941F]',
                                'dalam_antrian' => 'bg-[#141E61]',
                                'dalam_servisan' => 'bg-[#A0523C]',
                                'selesai', 'completed' => 'bg-[#7A8F5C]',
                                'cancelled' => 'bg-gray-500',
                                default => 'bg-gray-400'
                            };
                            $hasTime = is_array($booking)
                                ? !empty($booking['time_slot'])
                                : !empty($booking->tanggal_pesan);
                            $startTime = is_array($booking)
                                ? ($booking['time_slot'] ?? '')
                                : (optional($booking->tanggal_pesan)->setTimezone('Asia/Jakarta')->format('H.i'));
                            $endTime = is_array($booking)
                                ? ''
                                : ($booking->tanggal_selesai ? optional($booking->tanggal_selesai)->setTimezone('Asia/Jakarta')->format('H.i') : '...');
                            $bookingNumber = is_array($booking) ? ($booking['id'] ?? ($booking['nomor_booking'] ?? '—')) : ($booking->nomor_booking ?? '—');
                            $serviceDate = is_array($booking)
                                ? ($booking['service_date'] ?? '—')
                                : (optional($booking->jam_booking ?? $booking->tanggal_pesan)->format('d F Y') ?? '—');
                            if (!is_array($booking) && optional($booking->mobil)->nama_mobil) {
                                $carDisplay = $booking->mobil->nama_mobil . ' (' . ($booking->mobil->plat_nomor ?? '—') . ')';
                            } elseif (is_array($booking)) {
                                if (!empty($booking['mobil']) && is_array($booking['mobil'])) {
                                    $nm = $booking['mobil']['nama_mobil'] ?? ($booking['mobil']['nama'] ?? null);
                                    $pl = $booking['mobil']['plat_nomor'] ?? ($booking['mobil']['plat'] ?? null);
                                    $carDisplay = $nm ? ($nm . ' (' . ($pl ?? '—') . ')') : ($booking['car_name'] ?? '—');
                                } else {
                                    $carDisplay = $booking['car_name'] ?? '—';
                                }
                            } else {
                                $carDisplay = '—';
                            }
                            $qtyLayanan = null;
                            if (is_array($booking)) {
                                $qtyLayanan = !empty($booking['services']) ? count($booking['services']) : null;
                            } else {
                                if (isset($booking->detailStruks)) {
                                    $qtyLayanan = $booking->detailStruks->count();
                                } elseif (isset($booking->details)) {
                                    $qtyLayanan = $booking->details->count();
                                }
                            }
                        @endphp
                        <div class="relative pl-10 sm:pl-14">
                            <div class="absolute left-1 sm:left-3 top-1.5 w-6 h-6 rounded-full border-[6px] border-white {{ $accentDot }} shadow-lg"></div>
                            <div class="bg-[#F9FAFF] border border-[#0F044C]/10 rounded-2xl p-5 sm:p-6 space-y-5">
                                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                    <div>
                                        <p class="montserrat-regular-10 uppercase text-[#787A91]">Nomor Booking</p>
                                        <p class="text-xl font-bold text-[#0F044C]">#{{ $bookingNumber }}</p>
                                        <p class="defparagraf text-gray-500 mt-1">Tanggal booking: {{ $serviceDate }}</p>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        @if($hasTime)
                                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white border border-[#0F044C]/10 defparagraf font-semibold text-[#0F044C]">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                                                {{ is_array($booking) ? $startTime : ($startTime . ' - ' . $endTime) }}
                                            </span>
                                        @endif
                                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full defparagraf font-semibold border {{ $statusColor }}">
                                            <span class="w-2 h-2 rounded-full bg-current"></span>
                                            {{ $statusDisplayCb }}
                                        </span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-white rounded-xl border border-[#0F044C]/10 p-4">
                                        <p class="montserrat-regular-10 uppercase text-[#787A91] mb-1">Kendaraan</p>
                                        <p class="font-semibold text-gray-900 defparagraf">{{ $carDisplay }}</p>
                                    </div>
                                    <div class="bg-white rounded-xl border border-[#0F044C]/10 p-4">
                                        <p class="montserrat-regular-10 uppercase text-[#787A91] mb-1">Jenis Layanan</p>
                                        @if(!is_null($qtyLayanan))
                                            <p class="font-semibold text-gray-900 defparagraf">Terdapat {{ $qtyLayanan }} layanan</p>
                                        @else
                                            <p class="font-semibold text-gray-900 defparagraf">Belum ada detail layanan</p>
                                        @endif
                                    </div>
                                    <div class="bg-white rounded-xl border border-[#0F044C]/10 p-4">
                                        <p class="montserrat-regular-10 uppercase text-[#787A91] mb-1">Aksi</p>
                                        <a href="{{ route('antrian', ['show_receipt' => is_array($booking) ? ($booking['id'] ?? ($booking['nomor_booking'] ?? '')) : ($booking->nomor_booking ?? $booking->id_antri_struk)]) }}"
                                            class="inline-flex items-center justify-center px-4 py-2.5 w-full border border-[#0F044C] text-[#0F044C] rounded-lg font-semibold defparagraf hover:bg-[#0F044C] hover:text-white transition-all duration-200">
                                            Detail Struk
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="bg-white border border-dashed border-[#0F044C]/20 rounded-2xl px-6 py-10 text-center shadow-sm">
                    <div class="w-16 h-16 mx-auto bg-[#0F044C]/5 text-[#0F044C] rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 5h6a2 2 0 0 1 2 2v12l-5-3l-5 3V7a2 2 0 0 1 2-2z"/><path d="M9 5V3h6v2"/></svg>
                    </div>
                    <p class="defparagraf text-gray-600">Belum ada antrian aktif saat ini.</p>
                    <div class="mt-4 flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="{{ route('booking') }}" class="inline-block px-5 py-3 bg-[#141E61] text-white hover:bg-[#0F044C] defparagraf rounded-xl font-semibold">Buat Booking Baru</a>
                        <a href="{{ route('user.mobil.create') }}" class="inline-block px-5 py-3 border border-[#0F044C]/30 text-[#0F044C] defparagraf rounded-xl font-semibold hover:bg-[#0F044C]/5">Tambah Data Mobil</a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Riwayat Antrian -->
        <div class="space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h2 class="sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 uppercase">Riwayat Antrian</h2>
                </div>
                @if(isset($riwayat) && ((is_array($riwayat) && count($riwayat) > 0) || ($riwayat instanceof \Illuminate\Support\Collection && $riwayat->isNotEmpty())))
                    <div class="flex items-center gap-2 defparagraf text-[#0F044C] font-semibold">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 17 21 12 16 7"/><line x1="4" y1="12" x2="21" y2="12"/></svg>
                        {{ is_array($riwayat) ? count($riwayat) : $riwayat->count() }} catatan
                    </div>
                @endif
            </div>
            @if(isset($riwayat) && ((is_array($riwayat) && count($riwayat) > 0) || ($riwayat instanceof \Illuminate\Support\Collection && $riwayat->isNotEmpty())))
                <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-[#0F044C]/5 to-[#1D2C90]/5 border-b border-[#0F044C]/20">
                                    <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Booking</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Kendaraan</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Jadwal</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-right text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($riwayat as $item)
                                @php
                                    $bookingNumber = is_array($item) 
                                        ? ($item['nomor_booking'] ?? ($item['id'] ?? 'N/A'))
                                        : ($item->nomor_booking ?? $item->id_antri_struk ?? 'N/A');
                                    $displayDate = is_array($item) 
                                        ? ($item['tanggal'] ?? ($item['created_at'] ?? '—'))
                                        : ($item->tanggal_pesan ? $item->tanggal_pesan->format('d F Y') : ($item->created_at ? $item->created_at->format('d F Y') : '—'));
                                    $hasTimeH = is_array($item)
                                        ? !empty($item['waktu'])
                                        : (!empty($item->tanggal_pesan));
                                    $startTimeH = is_array($item)
                                        ? ($item['waktu'] ?? '')
                                        : (optional($item->tanggal_pesan)->setTimezone('Asia/Jakarta')->format('H.i'));
                                    $endTimeH = is_array($item)
                                        ? ''
                                        : ($item->tanggal_selesai ? optional($item->tanggal_selesai)->setTimezone('Asia/Jakarta')->format('H.i') : '...');
                                    $statusText = is_array($item) ? ($item['status'] ?? 'Selesai') : ($item->status ?? 'Selesai');
                                    $statusDisplay = match(strtolower(trim($statusText))) {
                                        'pending' => 'Menunggu Konfirmasi',
                                        'harga_dari_admin' => 'Harga dari Admin',
                                        'dalam_antrian' => 'Dalam Antrian',
                                        'dalam_servisan' => 'Dalam Servisan',
                                        'selesai', 'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                        default => ucwords(str_replace('_', ' ', strtolower($statusText)))
                                    };
                                    $historyStatusColor = match(strtolower(trim($statusText))) {
                                        'pending', 'harga_dari_admin' => 'bg-[#FFDC7F]/20 text-[#B8941F] border-[#FFDC7F]/40',
                                        'dalam_antrian' => 'bg-[#141E61]/10 text-[#141E61] border-[#141E61]/30',
                                        'dalam_servisan' => 'bg-[#C66E52]/15 text-[#A0523C] border-[#C66E52]/35',
                                        'selesai', 'completed' => 'bg-[#B8C999]/20 text-[#7A8F5C] border-[#B8C999]/40',
                                        'cancelled' => 'bg-gray-100 text-gray-700 border-gray-300',
                                        default => 'bg-gray-50 text-gray-700 border-gray-200'
                                    };
                                    $carInfo = is_array($item) 
                                        ? ($item['mobil'] ?? '—')
                                        : (($item->mobil->nama_mobil ?? '') . ' (' . ($item->mobil->plat_nomor ?? '') . ')');
                                    $qtyRiwayat = null;
                                    if (is_array($item) && !empty($item['services'])) {
                                        $qtyRiwayat = count($item['services']);
                                    } else {
                                        if (isset($item->detailStruks)) {
                                            $qtyRiwayat = $item->detailStruks->count();
                                        } elseif (isset($item->details)) {
                                            $qtyRiwayat = $item->details->count();
                                        }
                                    }
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-sm font-semibold text-[#0F044C]">#{{ $bookingNumber }}</p>
                                        <p class="text-xs text-gray-500">{{ $displayDate }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="font-semibold text-gray-900 defparagraf">{{ $carInfo ?: '—' }}</p>
                                        @if(!is_null($qtyRiwayat))
                                            <p class="text-xs text-[#787A91] mt-1">Terdapat {{ $qtyRiwayat }} layanan</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($hasTimeH)
                                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#0F044C]/5 border border-[#0F044C]/10 defparagraf font-semibold text-[#0F044C]">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                                                {{ is_array($item) ? $startTimeH : ($startTimeH . ' - ' . $endTimeH) }}
                                            </span>
                                        @else
                                            <span class="defparagraf text-gray-500">–</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full defparagraf font-semibold border {{ $historyStatusColor }}">
                                            <span class="w-2 h-2 rounded-full bg-current"></span>
                                            {{ $statusDisplay }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <a href="{{ route('antrian', ['show_receipt' => is_array($item) ? ($item['id'] ?? ($item['nomor_booking'] ?? '')) : ($item->nomor_booking ?? $item->id_antri_struk)]) }}"
                                           class="px-4 py-2 bg-white border border-[#0F044C] text-[#0F044C] defparagraf text-xs font-semibold rounded-lg hover:bg-[#0F044C] hover:text-white transition-all duration-200">
                                           Detail Struk
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="bg-white border border-dashed border-[#0F044C]/20 rounded-2xl px-6 py-10 text-center shadow-sm">
                    <div class="w-16 h-16 mx-auto bg-[#0F044C]/5 text-[#0F044C] rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M3 5h18"/><path d="M8 5V3h8v2"/><path d="M19 5v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5"/><path d="M8 11h8"/><path d="M8 15h5"/></svg>
                    </div>
                    <p class="defparagraf text-gray-600">Belum ada riwayat antrian.</p>
                    <p class="defparagraf text-gray-400 text-sm mt-1">Booking yang selesai akan otomatis muncul di sini.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Include Booking Receipt Modal Component -->
    @include('components.user.booking-receipt-modal', ['selectedBooking' => $selectedBooking ?? null])

    @php
        // Susun data riwayat untuk modal berdasarkan data nyata dari controller
        $historyData = [];
        if (isset($riwayat)) {
            foreach ($riwayat as $it) {
                $isArray = is_array($it);
                $servicesArr = [];
                if ($isArray && !empty($it['services'])) {
                    $servicesArr = $it['services'];
                } elseif (!$isArray && isset($it->detailStruks)) {
                    $servicesArr = $it->detailStruks->pluck('deskripsi')->toArray();
                }

                $historyData[] = [
                    'id' => $isArray ? ($it['id'] ?? ($it['nomor_booking'] ?? null)) : ($it->id ?? ($it->nomor_booking ?? null)),
                    'date' => $isArray
                        ? ($it['tanggal'] ?? '')
                        : ($it->tanggal ?? ($it->created_at ? $it->created_at->format('d/m/Y') : '')),
                    'time' => $isArray ? ($it['waktu'] ?? '') : ($it->waktu ?? ''),
                    'car' => $isArray ? ($it['mobil'] ?? '') : ($it->mobil ?? ''),
                    'services' => $servicesArr,
                    'address' => $isArray ? ($it['alamat'] ?? '') : (($it->pengambilan && $it->alamat_pengambilan ? ('Jemput: '.$it->alamat_pengambilan) : '') . ($it->pengiriman && $it->alamat_pengiriman ? ( ($it->pengambilan ? ' | ' : '') . 'Antar: '.$it->alamat_pengiriman) : '')),
                    'notes' => $isArray ? ($it['catatan'] ?? '') : ($it->catatan ?? ''),
                    'status' => $isArray ? ($it['status'] ?? null) : ($it->status ?? null),
                    'pricing' => null,
                ];
            }
        }
    @endphp
    <script>
        const historyData = @json($historyData);

        function showHistoryDetail(index) {
            const data = historyData[index];
            if (data) {
                showReceiptModal(data);
            }
        }

        function showHistoryById(bookingId) {
            const data = historyData.find(item => item.id === bookingId);
            if (data) {
                showReceiptModal(data);
            }
        }

        function showHistoryCustom(serviceType, date, car, price) {
            const bookingData = {
                id: 'BWK-HISTORY-' + Date.now(),
                date: date,
                time: '',
                car: car,
                services: [serviceType],
                address: '',
                notes: '',
                status: null,
                pricing: { serviceCost: price, sparepartCost: 'Rp 0', deliveryCost: 'Rp 0', totalCost: price }
            };
            showReceiptModal(bookingData);
        }
    </script>
</x-user.dashboard-layout>
