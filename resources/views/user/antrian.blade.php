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
            }
        @endphp

        <!-- Quick Insights -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-white border border-[#0F044C]/10 rounded-2xl px-5 py-6 shadow-sm hover:shadow-md transition-all duration-200">
                <p class="text-xs uppercase tracking-[0.3em] text-[#787A91]">Booking Aktif</p>
                <p class="text-3xl font-bold text-[#0F044C] mt-2">{{ $activeCount }}</p>
                <p class="text-xs text-[#787A91] mt-3">Booking yang sedang berjalan.</p>
            </div>
            <div class="bg-white border border-[#0F044C]/10 rounded-2xl px-5 py-6 shadow-sm hover:shadow-md transition-all duration-200">
                <p class="text-xs uppercase tracking-[0.3em] text-[#787A91]">Menunggu Konfirmasi</p>
                <p class="text-3xl font-bold text-[#0F044C] mt-2">{{ $waitingCount }}</p>
                <p class="text-xs text-[#787A91] mt-3">Pending / Konfirmasi harga.</p>
            </div>
            <div class="bg-white border border-[#0F044C]/10 rounded-2xl px-5 py-6 shadow-sm hover:shadow-md transition-all duration-200">
                <p class="text-xs uppercase tracking-[0.3em] text-[#787A91]">Selesai</p>
                <p class="text-3xl font-bold text-[#0F044C] mt-2">{{ $completedHistory }}</p>
                <p class="text-xs text-[#787A91] mt-3">Total riwayat selesai.</p>
            </div>
            <div class="bg-white border border-[#0F044C]/10 rounded-2xl px-5 py-6 shadow-sm hover:shadow-md transition-all duration-200">
                <p class="text-xs uppercase tracking-[0.3em] text-[#787A91]">Total Riwayat</p>
                <p class="text-3xl font-bold text-[#0F044C] mt-2">{{ $totalHistory }}</p>
                <p class="text-xs text-[#787A91] mt-3">{{ $cancelledHistory }} dibatalkan.</p>
            </div>
        </div>

        <!-- Antrian Saat Ini -->
        <div class="space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <p class="text-xs uppercase tracking-[0.4em] text-[#787A91]">Sedang Berjalan</p>
                    <h2 class="sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 uppercase">Antrian Saat Ini</h2>
                </div>
                @if(!empty($currentBookings))
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#0F044C]/5 border border-[#0F044C]/10 text-xs text-[#0F044C] uppercase font-semibold tracking-widest">
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
                                'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'harga_dari_admin' => 'bg-sky-50 text-sky-700 border-sky-200',
                                'dalam_antrian' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                'dalam_servisan' => 'bg-purple-50 text-purple-700 border-purple-200',
                                'selesai', 'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'cancelled' => 'bg-rose-50 text-rose-700 border-rose-200',
                                default => 'bg-gray-50 text-gray-700 border-gray-200'
                            };
                            $accentDot = match(strtolower(trim((string)$statusTextCb))) {
                                'pending' => 'bg-amber-400',
                                'harga_dari_admin' => 'bg-sky-400',
                                'dalam_antrian' => 'bg-indigo-500',
                                'dalam_servisan' => 'bg-purple-500',
                                'selesai', 'completed' => 'bg-emerald-500',
                                'cancelled' => 'bg-rose-500',
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
                                        <p class="text-xs uppercase tracking-[0.3em] text-[#787A91]">Nomor Booking</p>
                                        <p class="text-xl font-bold text-[#0F044C]">#{{ $bookingNumber }}</p>
                                        <p class="text-sm text-gray-500 mt-1">Tanggal booking: {{ $serviceDate }}</p>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        @if($hasTime)
                                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white border border-[#0F044C]/10 text-xs font-semibold text-[#0F044C]">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                                                {{ is_array($booking) ? $startTime : ($startTime . ' - ' . $endTime) }}
                                            </span>
                                        @endif
                                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold border {{ $statusColor }}">
                                            <span class="w-2 h-2 rounded-full bg-current"></span>
                                            {{ $statusDisplayCb }}
                                        </span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-white rounded-xl border border-[#0F044C]/10 p-4">
                                        <p class="text-xs uppercase tracking-[0.3em] text-[#787A91] mb-1">Kendaraan</p>
                                        <p class="font-semibold text-gray-900 defparagraf">{{ $carDisplay }}</p>
                                    </div>
                                    <div class="bg-white rounded-xl border border-[#0F044C]/10 p-4">
                                        <p class="text-xs uppercase tracking-[0.3em] text-[#787A91] mb-1">Jenis Layanan</p>
                                        @if(!is_null($qtyLayanan))
                                            <p class="font-semibold text-gray-900 defparagraf">Terdapat {{ $qtyLayanan }} layanan</p>
                                        @else
                                            <p class="font-semibold text-gray-900 defparagraf">Belum ada detail layanan</p>
                                        @endif
                                    </div>
                                    <div class="bg-white rounded-xl border border-[#0F044C]/10 p-4">
                                        <p class="text-xs uppercase tracking-[0.3em] text-[#787A91] mb-1">Aksi</p>
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
                    <p class="text-xs uppercase tracking-[0.4em] text-[#787A91]">Arsip Servis</p>
                    <h2 class="sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 uppercase">Riwayat Antrian</h2>
                </div>
                @if(isset($riwayat) && ((is_array($riwayat) && count($riwayat) > 0) || ($riwayat instanceof \Illuminate\Support\Collection && $riwayat->isNotEmpty())))
                    <div class="flex items-center gap-2 text-sm text-[#0F044C] font-semibold">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 17 21 12 16 7"/><line x1="4" y1="12" x2="21" y2="12"/></svg>
                        {{ is_array($riwayat) ? count($riwayat) : $riwayat->count() }} catatan
                    </div>
                @endif
            </div>
            @if(isset($riwayat) && ((is_array($riwayat) && count($riwayat) > 0) || ($riwayat instanceof \Illuminate\Support\Collection && $riwayat->isNotEmpty())))
                <div class="bg-white border border-[#0F044C]/10 rounded-3xl shadow-sm overflow-hidden">
                    <div class="hidden md:grid grid-cols-12 px-6 py-3 text-xs uppercase tracking-[0.3em] text-[#787A91] bg-[#F9FAFF] border-b border-[#0F044C]/10">
                        <p class="col-span-3">Booking</p>
                        <p class="col-span-3">Kendaraan</p>
                        <p class="col-span-2">Jadwal</p>
                        <p class="col-span-2">Status</p>
                        <p class="col-span-2 text-right">Aksi</p>
                    </div>
                    <div class="divide-y divide-gray-100">
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
                                'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'harga_dari_admin' => 'bg-sky-50 text-sky-700 border-sky-200',
                                'dalam_antrian' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                'dalam_servisan' => 'bg-purple-50 text-purple-700 border-purple-200',
                                'selesai', 'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'cancelled' => 'bg-rose-50 text-rose-700 border-rose-200',
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
                        <div class="px-4 sm:px-6 py-5 grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                            <div class="md:col-span-3">
                                <p class="text-sm font-semibold text-[#0F044C]">#{{ $bookingNumber }}</p>
                                <p class="text-xs text-gray-500">{{ $displayDate }}</p>
                            </div>
                            <div class="md:col-span-3">
                                <p class="font-semibold text-gray-900 defparagraf">{{ $carInfo ?: '—' }}</p>
                                @if(!is_null($qtyRiwayat))
                                    <p class="text-xs text-[#787A91] mt-1">Terdapat {{ $qtyRiwayat }} layanan</p>
                                @endif
                            </div>
                            <div class="md:col-span-2">
                                @if($hasTimeH)
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#0F044C]/5 border border-[#0F044C]/10 text-xs font-semibold text-[#0F044C]">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                                        {{ is_array($item) ? $startTimeH : ($startTimeH . ' - ' . $endTimeH) }}
                                    </span>
                                @else
                                    <span class="text-sm text-gray-500">–</span>
                                @endif
                            </div>
                            <div class="md:col-span-2">
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold border {{ $historyStatusColor }}">
                                    <span class="w-2 h-2 rounded-full bg-current"></span>
                                    {{ $statusDisplay }}
                                </span>
                            </div>
                            <div class="md:col-span-2 flex md:justify-end w-full">
                                <a href="{{ route('antrian', ['show_receipt' => is_array($item) ? ($item['id'] ?? ($item['nomor_booking'] ?? '')) : ($item->nomor_booking ?? $item->id_antri_struk)]) }}"
                                    class="w-full md:w-auto px-4 py-2.5 border border-[#0F044C] text-[#0F044C] rounded-lg font-semibold defparagraf text-center hover:bg-[#0F044C] hover:text-white transition-all duration-200">
                                    Detail Struk
                                </a>
                            </div>
                        </div>
                        @endforeach
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
