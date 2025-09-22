<x-user.dashboard-layout>
    <!-- Manajemen Antrian -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Header -->
        <div class="mb-2 sm:mb-4">
            <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 text-gray-900 uppercase">MANAJEMEN ANTRIAN</h1>
            <p class="text-gray-600 defparagraf">Kelola antrian Anda: lihat antrian saat ini dan riwayat antrian yang telah selesai.</p>
        </div>

        @php
            // Normalize current bookings to an array list and keep only non-finished statuses
            $currentBookings = [];
            if (isset($currentBooking)) {
                if ($currentBooking instanceof \Illuminate\Support\Collection) {
                    // Ensure reindexed list
                    $currentBookings = $currentBooking->values()->all();
                } elseif (is_array($currentBooking)) {
                    // Unwrap common wrapper shape: ['data' => [...]]
                    if (isset($currentBooking['data']) && is_array($currentBooking['data'])) {
                        $arr = $currentBooking['data'];
                    } else {
                        $arr = $currentBooking;
                    }
                    // Detect list vs associative; fallback to array_values to normalize
                    $isList = function_exists('array_is_list')
                        ? array_is_list($arr)
                        : (array_keys($arr) === range(0, count($arr) - 1));
                    $currentBookings = $isList ? $arr : array_values($arr);
                } else {
                    $currentBookings = [$currentBooking];
                }
                // Filter out finished statuses (only 'selesai' is considered finished)
                $currentBookings = array_values(array_filter($currentBookings, function($item) {
                    $status = is_array($item) ? ($item['status'] ?? null) : ($item->status ?? null);
                    $status = strtolower((string)$status);
                    return !in_array($status, ['selesai']);
                }));
            }
        @endphp

        <!-- Antrian Saat Ini -->
        <div class="space-y-3">
            <h2 class="sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 uppercase">Antrian Saat Ini</h2>
            @if(!empty($currentBookings) && count($currentBookings) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">
                    @foreach($currentBookings as $booking)
                    <div class="bg-white border-2 border-[#000000] shadow-sm">
                        <div class="px-6 sm:px-7 py-6">
                            <!-- Header Row -->
                            <div class="flex items-start justify-between">
                                <div class="flex-1 pr-4">
                                    <p class="font-extrabold defparagraf text-gray-900 text-lg tracking-wide">
                                        Nomor :
                                        {{ is_array($booking) ? ($booking['id'] ?? '—') : ($booking->nomor_booking ?? '—') }}
                                    </p>
                                </div>
                                <div class="flex flex-col items-end">
                                    <div class="w-44 sm:w-56 text-center">
                                        @php
                                            $hasTime = is_array($booking)
                                                ? !empty($booking['time_slot'])
                                                : !empty($booking->tanggal_pesan);
                                            $startTime = is_array($booking)
                                                ? ($booking['time_slot'] ?? '')
                                                : (optional($booking->tanggal_pesan)->setTimezone('Asia/Jakarta')->format('H.i'));
                                            $endTime = is_array($booking)
                                                ? ''
                                                : ($booking->tanggal_selesai ? optional($booking->tanggal_selesai)->setTimezone('Asia/Jakarta')->format('H.i') : '...');
                                        @endphp
                                        @if($hasTime)
                                            <p class="defparagraf text-gray-900 text-base sm:text-lg font-semibold border-b-2 border-[#000000] pb-1 w-full inline-block">
                                                {{ is_array($booking) ? $startTime : ($startTime . ' - ' . $endTime) }}
                                            </p>
                                        @endif
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
                                        @endphp
                                        <p class="defparagraf text-gray-600 text-xs mt-1">{{ $statusDisplayCb }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Middle Row -->
                            <div class="mt-2">
                                <p class="defparagraf text-gray-800">
                                    Tanggal booking:
                                    {{ is_array($booking) 
                                        ? ($booking['service_date'] ?? '—') 
                                        : (optional($booking->jam_booking ?? $booking->tanggal_pesan)->format('d F Y') ?? '—') }}
                                </p>
                            </div>

                            <!-- Footer Row -->
                            <div class="mt-6 flex flex-col gap-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-800" viewBox="0 0 24 24"><path fill="currentColor" d="M19 20H5v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V11l2.48-5.788A2 2 0 0 1 6.32 4h11.36a2 2 0 0 1 1.838 1.212L22 11v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm1-7H4v5h16zM4.176 11h15.648l-2.143-5H6.32zM6.5 17a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m11 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3"/></svg>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-800 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9,18 15,12 9,6"/></svg>
                                    @php
                                        // Selalu utamakan relasi mobil agar ikut update terbaru
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
                                    @endphp
                                    <p class="font-bold defparagraf text-gray-900">{{ $carDisplay }}</p>
                                </div>

                                <!-- Services Qty + Detail Button Row -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 text-center">
                                            @php
                                                $qtyLayanan = null;
                                                if (is_array($booking)) {
                                                    $qtyLayanan = !empty($booking['services']) ? count($booking['services']) : null;
                                                } else {
                                                    if (isset($booking->detailStruks)) {
                                                        $qtyLayanan = $booking->detailStruks->count();
                                                    } elseif (isset($booking->details)) {
                                                        $qtyLayanan = $booking->details->count();
                                                    } else {
                                                        $qtyLayanan = null;
                                                    }
                                                }
                                            @endphp
                                            @if(!is_null($qtyLayanan))
                                                <p class="defparagraf text-gray-900 text-xs whitespace-nowrap">Terdapat {{ $qtyLayanan }} jumlah layanan</p>
                                            @endif
                                        </div>
                                    </div>

                                    <a href="{{ route('antrian', ['show_receipt' => is_array($booking) ? ($booking['id'] ?? ($booking['nomor_booking'] ?? '')) : ($booking->nomor_booking ?? $booking->id_antri_struk)]) }}"
                                        class="px-4 py-2 border-2 border-[#000000] text-gray-900 hover:bg-gray-900 hover:text-white defparagraf w-44 sm:w-56 text-center inline-block">
                                        Detail Struk
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white border-2 border-gray-200 p-6">
                    <p class="defparagraf text-gray-700">Belum ada antrian aktif saat ini.</p>
                    <div class="mt-4">
                        <a href="{{ route('booking') }}" class="inline-block px-4 py-2 bg-[#141E61] text-white hover:bg-[#0F044C] defparagraf">Buat Booking Baru</a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Riwayat Antrian -->
        <div class="space-y-3">
            <h2 class="sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 uppercase">Riwayat Antrian</h2>
            @if(isset($riwayat) && ((is_array($riwayat) && count($riwayat) > 0) || ($riwayat instanceof \Illuminate\Support\Collection && $riwayat->isNotEmpty())))
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">
                    @foreach($riwayat as $item)
                        <div class="bg-white border-2 border-[#000000] shadow-sm">
                            <div class="px-6 sm:px-7 py-6">
                                <!-- Header Row -->
                                <div class="flex items-start justify-between">
                                    <div class="flex-1 pr-4">
                                        @php
                                            $bookingNumber = is_array($item) 
                                                ? ($item['nomor_booking'] ?? ($item['id'] ?? 'N/A'))
                                                : ($item->nomor_booking ?? $item->id_antri_struk ?? 'N/A');
                                        @endphp
                                        <p class="font-extrabold defparagraf text-gray-900 text-lg tracking-wide">
                                            Nomor : {{ $bookingNumber }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <div class="w-44 sm:w-56 text-center">
                                            @php
                                                $hasTimeH = is_array($item)
                                                    ? !empty($item['waktu'])
                                                    : (!empty($item->tanggal_pesan));
                                                $startTimeH = is_array($item)
                                                    ? ($item['waktu'] ?? '')
                                                    : (optional($item->tanggal_pesan)->setTimezone('Asia/Jakarta')->format('H.i'));
                                                $endTimeH = is_array($item)
                                                    ? ''
                                                    : ($item->tanggal_selesai ? optional($item->tanggal_selesai)->setTimezone('Asia/Jakarta')->format('H.i') : '...');
                                            @endphp
                                            @if($hasTimeH)
                                                <p class="defparagraf text-gray-900 text-base sm:text-lg font-semibold border-b-2 border-[#000000] pb-1 w-full inline-block">
                                                    {{ is_array($item) ? $startTimeH : ($startTimeH . ' - ' . $endTimeH) }}
                                                </p>
                                            @endif
                                            @php
                                                $statusText = is_array($item) ? ($item['status'] ?? 'Selesai') : ($item->status ?? 'Selesai');
                                                
                                                // Map all possible statuses from the system
                                                $statusDisplay = match(strtolower(trim($statusText))) {
                                                    'pending' => 'Menunggu Konfirmasi',
                                                    'harga_dari_admin' => 'Harga dari Admin',
                                                    'dalam_antrian' => 'Dalam Antrian',
                                                    'dalam_servisan' => 'Dalam Servisan',
                                                    'selesai', 'completed' => 'Selesai',
                                                    'cancelled' => 'Dibatalkan',
                                                    default => ucwords(str_replace('_', ' ', strtolower($statusText)))
                                                };
                                            @endphp
                                            <p class="defparagraf text-gray-600 text-xs mt-1">{{ $statusDisplay }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Middle Row -->
                                <div class="mt-2">
                                    @php
                                        $displayDate = is_array($item) 
                                            ? ($item['tanggal'] ?? ($item['created_at'] ?? '—'))
                                            : ($item->tanggal_pesan ? $item->tanggal_pesan->format('d F Y') : ($item->created_at ? $item->created_at->format('d F Y') : '—'));
                                    @endphp
                                    <p class="defparagraf text-gray-800">Tanggal booking: {{ $displayDate }}</p>
                                </div>

                                <!-- Footer Row -->
                                <div class="mt-6 flex flex-col gap-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 flex items-center justify-center flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-800" viewBox="0 0 24 24"><path fill="currentColor" d="M19 20H5v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V11l2.48-5.788A2 2 0 0 1 6.32 4h11.36a2 2 0 0 1 1.838 1.212L22 11v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm1-7H4v5h16zM4.176 11h15.648l-2.143-5H6.32zM6.5 17a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m11 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3"/></svg>
                                        </div>
                                        <svg class="w-4 h-4 text-gray-800 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9,18 15,12 9,6"/></svg>
                                        @php
                                            $carInfo = is_array($item) 
                                                ? ($item['mobil'] ?? '—')
                                                : (($item->mobil->nama_mobil ?? '') . ' (' . ($item->mobil->plat_nomor ?? '') . ')');
                                        @endphp
                                        <p class="font-bold defparagraf text-gray-900">{{ $carInfo }}</p>
                                    </div>
                                    <!-- Services Qty + Detail Button Row -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 text-center">
                                                @php
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
                                                @if(!is_null($qtyRiwayat))
                                                    <p class="defparagraf text-gray-900 text-xs whitespace-nowrap">Terdapat {{ $qtyRiwayat }} jumlah layanan</p>
                                                @endif
                                            </div>
                                        </div>

                                        <a href="{{ route('antrian', ['show_receipt' => is_array($item) ? ($item['id'] ?? ($item['nomor_booking'] ?? '')) : ($item->nomor_booking ?? $item->id_antri_struk)]) }}"
                                            class="px-4 py-2 border-2 border-[#000000] text-gray-900 hover:bg-gray-900 hover:text-white defparagraf w-44 sm:w-56 text-center inline-block">
                                            Detail Struk
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white border-2 border-gray-200 p-6">
                    <p class="defparagraf text-gray-700">Belum ada riwayat antrian.</p>
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
