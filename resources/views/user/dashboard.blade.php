<x-user.dashboard-layout>
    <!-- Dashboard Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
            <!-- Hero / Header -->
            <div class="bg-gradient-to-br from-[#0F044C] via-[#1D2C90] to-[#192BC2] text-white rounded-2xl px-6 py-8 sm:px-8 sm:py-10 shadow-xl relative overflow-hidden">
                <div class="absolute inset-0 opacity-20 pointer-events-none">
                    <div class="w-56 h-56 bg-white/10 rounded-full blur-3xl absolute -right-16 top-4"></div>
                    <div class="w-40 h-40 bg-white/5 rounded-full blur-3xl absolute -left-10 bottom-0"></div>
                </div>
                <div class="relative flex flex-col md:flex-row items-start md:items-center gap-6">
                    <div class="flex-1">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-montserrat-48 font-bold leading-tight">Dashboard Pengguna</h1>
                        <p class="mt-3 text-sm sm:text-base text-white/80 defparagraf max-w-3xl">
                            Kelola semua kebutuhan Anda: buat booking servis, pantau antrian, atur data mobil, dan kelola profil, semuanya dari satu tempat.
                        </p>
                        <div class="mt-6 flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('booking') }}" class="px-5 py-3 bg-white text-[#0F044C] rounded-xl font-semibold defparagraf text-center shadow-lg hover:shadow-xl transition-all duration-200">Buat Booking Baru</a>
                            <a href="{{ route('antrian') }}" class="px-5 py-3 border border-white/30 text-white rounded-xl font-semibold defparagraf text-center hover:bg-white/10 transition-all duration-200">Kelola Antrian</a>
                            <a href="{{ route('profile') }}" class="px-5 py-3 border border-white/30 text-white rounded-xl font-semibold defparagraf text-center hover:bg-white/10 transition-all duration-200">Profil</a>
                        </div>
                    </div>
                    <div class="w-full md:w-auto">
                        <div class="bg-white/15 border border-white/20 rounded-2xl px-6 py-5 backdrop-blur-sm shadow-lg min-w-[240px]">
                            <p class="text-xs uppercase tracking-[0.3em] text-white/70">Status Sistem</p>
                            <p class="text-3xl font-bold mt-2"><span id="status-time">{{ now()->locale('id')->translatedFormat('H:i:s') }}</span></p>
                            <p class="text-white/70 text-sm">Terakhir diakses • <span id="status-date">{{ now()->locale('id')->translatedFormat('d F Y') }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $dashBookingsNew = [];
                if (isset($currentBooking)) {
                    if ($currentBooking instanceof \Illuminate\Support\Collection) {
                        $dashBookingsNew = $currentBooking->values()->all();
                    } elseif (is_array($currentBooking)) {
                        $arr = isset($currentBooking['data']) && is_array($currentBooking['data']) ? $currentBooking['data'] : $currentBooking;
                        $isList = function_exists('array_is_list') ? array_is_list($arr) : (array_keys($arr) === range(0, count($arr) - 1));
                        $dashBookingsNew = $isList ? $arr : array_values($arr);
                    } else {
                        $dashBookingsNew = [$currentBooking];
                    }
                    $dashBookingsNew = array_values(array_filter($dashBookingsNew, function($b){
                        $status = is_array($b) ? ($b['status'] ?? null) : ($b->status ?? null);
                        return strtolower((string)$status) !== 'selesai';
                    }));
                }
                $nowDash = \Carbon\Carbon::now();
                $monthNameDash = $nowDash->locale('id')->translatedFormat('F Y');
                $daysInMonthDash = $nowDash->daysInMonth;
                $startDowDash = (int) $nowDash->copy()->startOfMonth()->dayOfWeekIso;
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-12 lg:grid-rows-2 gap-x-4 gap-y-3 lg:gap-x-6 lg:gap-y-4">
                <!-- Kolom 1: Kalender (span 2 baris) -->
                <div class="col-span-12 lg:col-span-5 lg:row-span-2">
                    <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-4 md:p-5 h-full">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-montserrat-48 font-bold text-[#0F044C]">Kalender Booking</h3>
                            <span class="text-sm text-[#787A91]">{{ $monthNameDash }}</span>
                        </div>
                        <div class="grid grid-cols-7 gap-2 text-xs select-none">
                            @foreach(['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $d)
                                <div class="text-center font-semibold text-[#0F044C]">{{ $d }}</div>
                            @endforeach
                            @for($i = 1; $i < $startDowDash; $i++)
                                <div class="h-8"></div>
                            @endfor                            @for($day = 1; $day <= $daysInMonthDash; $day++)
                                <div class="h-8 border border-gray-200 rounded-md flex items-center justify-center text-gray-700">{{ $day }}</div>
                            @endfor
                        </div>
                        <div class="mt-5 flex justify-between items-center">
                            <a href="{{ route('booking') }}" class="px-4 py-2 bg-gradient-to-r from-[#0F044C] to-[#1D2C90] text-white rounded-lg shadow hover:opacity-95 transition">Buat Booking Baru</a>
                            <a href="{{ route('antrian') }}" class="text-[#0F044C] text-sm font-semibold">Lihat Antrian</a>
                        </div>
                    </div>
                </div>

                <!-- Kolom 2, Baris 1: 3 Kartu Metrik -->
                <div class="col-span-12 lg:col-span-7">
                    <div class="grid grid-cols-1 sm:grid-cols-3 h-full gap-4">
                        <!-- Card 1: Jumlah Pengeluaran -->
                        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
                            <p class="bigparafraf font-semibold text-black mb-4">Jumlah Pengeluaran</p>
                            <div class="flex items-center gap-4">
                                <!-- Inner Box untuk Value -->
                                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">{{ $activitySummary['formatted_spent'] ?? 'Rp 0' }}</p>
                                </div>
                                <!-- SVG Icon -->
                                <div class="flex-shrink-0">
                                    <svg class="w-12 h-12 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Booking Telah Dilakukan -->
                        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
                            <p class="bigparafraf font-semibold text-black mb-4">Booking Telah Dilakukan</p>
                            <div class="flex items-center gap-4">
                                <!-- Inner Box untuk Value -->
                                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">{{ $activitySummary['total_services'] ?? 0 }}</p>
                                </div>
                                <!-- SVG Icon -->
                                <div class="flex-shrink-0">
                                    <svg class="w-12 h-12 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Uptime di Platform -->
                        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
                            <p class="bigparafraf font-semibold text-black mb-4">Uptime di Platform</p>
                            <div class="flex items-center gap-4">
                                <!-- Inner Box untuk Value -->
                                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">99.9%</p>
                                </div>
                                <!-- SVG Icon -->
                                <div class="flex-shrink-0">
                                    <svg class="w-12 h-12 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom 2, Baris 2: Daftar Antrian (scrollable) -->
                <div class="col-span-12 lg:col-span-7">
                    <div class="bg-white border border-[#0F044C]/20 rounded-xl h-full shadow-md p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-montserrat-48 font-bold text-[#0F044C]">Antrian Anda</h3>
                            <a href="{{ route('antrian') }}" class="text-sm text-[#0F044C] hover:underline">lihat semua</a>
                        </div>
                        <div class="space-y-3 max-h-[280px] overflow-y-auto pr-1">
                            @forelse($dashBookingsNew as $db)
                                @php
                                    $isArr = is_array($db);
                                    $isModel = is_object($db) && ($db instanceof \App\Models\AntriStruk);
                                    $status = $isArr ? ($db['status'] ?? '') : ($isModel ? ($db->status ?? '') : '');
                                    $s = strtolower((string)$status);
                                    $statusLabelNew = $s === 'pending' ? 'Menunggu Konfirmasi harga' : ($s === 'harga_dari_admin' ? 'Konfirmasi harga dari Montir' : ($s === 'dalam_antrian' ? 'Dalam Antrian' : ($s === 'dalam_servisan' ? 'Dalam Servisan' : ($s === 'selesai' ? 'Selesai' : ucfirst($s)))));
                                    if ($isArr) {
                                        $serviceNameNew = $db['service_name'] ?? 'Layanan';
                                        $serviceDateNew = $db['service_date'] ?? '—';
                                    } elseif ($isModel) {
                                        $serviceNameNew = optional($db->details->first())->deskripsi ?? 'Layanan';
                                        $serviceDateNew = optional($db->jam_booking ?? $db->tanggal_pesan)->format('d F Y') ?? '—';
                                    } else {
                                        $serviceNameNew = 'Layanan';
                                        $serviceDateNew = '—';
                                    }
                                    if ($isModel && optional($db->mobil)->nama_mobil) {
                                        $carNameNew = $db->mobil->nama_mobil . ' (' . ($db->mobil->plat_nomor ?? '—') . ')';
                                    } elseif ($isArr) {
                                        if (!empty($db['mobil']) && is_array($db['mobil'])) {
                                            $nm = $db['mobil']['nama_mobil'] ?? ($db['mobil']['nama'] ?? null);
                                            $pl = $db['mobil']['plat_nomor'] ?? ($db['mobil']['plat'] ?? null);
                                            $carNameNew = $nm ? ($nm . ' (' . ($pl ?? '—') . ')') : ($db['car_name'] ?? '—');
                                        } else {
                                            $carNameNew = $db['car_name'] ?? '—';
                                        }
                                    } else {
                                        $carNameNew = '—';
                                    }
                                    $priceTextNew = $isArr ? ($db['price'] ?? '') : '';
                                @endphp
                                <div class="flex items-center gap-3 border border-[#0F044C]/20 rounded-xl p-3">
                                    <div class="w-9 h-9 rounded-full bg-[#1D2C90]/10 flex items-center justify-center text-[#1D2C90]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"><path fill="currentColor" d="M19 20H5v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V11l2.48-5.788A2 2 0 0 1 6.32 4h11.36a2 2 0 0 1 1.838 1.212L22 11v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm1-7H4v5h16zM4.176 11h15.648l-2.143-5H6.32zM6.5 17a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m11 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3"/></svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-[#0F044C] truncate">{{ $carNameNew }}</p>
                                        <p class="text-xs text-gray-600 truncate">{{ $serviceNameNew }} • {{ $serviceDateNew }}</p>
                                        @if($priceTextNew)
                                            <p class="text-xs text-[#1D2C90] font-medium">{{ $priceTextNew }}</p>
                                        @endif
                                    </div>
                                    <div class="flex flex-col items-end gap-1">
                                        <span class="text-[10px] px-2 py-0.5 rounded-full border border-[#0F044C]/30 text-[#0F044C] whitespace-nowrap">{{ $statusLabelNew }}</span>
                                        <a href="{{ route('antrian') }}" class="text-xs text-[#0F044C] hover:underline">lihat detail →</a>
                                    </div>
                                </div>
                            @empty
                                <div class="border border-dashed border-[#0F044C]/30 rounded-xl p-6 text-center text-sm text-gray-600">Belum ada booking aktif</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- ANTRIAN ANDA SAAT INI Section -->
            <div class="space-y-4 hidden">
                <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-bold tracking-tight">ANTRIAN ANDA SAAT INI</h2>
                
                @php
                    // Normalize $currentBooking into a list and filter out 'selesai'
                    $dashBookings = [];
                    if (isset($currentBooking)) {
                        if ($currentBooking instanceof \Illuminate\Support\Collection) {
                            $dashBookings = $currentBooking->values()->all();
                        } elseif (is_array($currentBooking)) {
                            $arr = isset($currentBooking['data']) && is_array($currentBooking['data']) ? $currentBooking['data'] : $currentBooking;
                            $isList = function_exists('array_is_list') ? array_is_list($arr) : (array_keys($arr) === range(0, count($arr) - 1));
                            $dashBookings = $isList ? $arr : array_values($arr);
                        } else {
                            $dashBookings = [$currentBooking];
                        }
                        $dashBookings = array_values(array_filter($dashBookings, function($b){
                            $status = is_array($b) ? ($b['status'] ?? null) : ($b->status ?? null);
                            return strtolower((string)$status) !== 'selesai';
                        }));
                        // Limit to 3
                        $dashBookings = array_slice($dashBookings, 0, 3);
                    }

                    // Helper to map status to label
                    function mapStatusLabel($status) {
                        $s = strtolower((string)$status);
                        // Map status to human-friendly label
                        $label = match($s) {
                            'pending' => 'Menunggu Konfirmasi harga',
                            'harga_dari_admin' => 'Konfirmasi harga dari Montir',
                            'dalam_antrian' => 'Dalam Antrian',
                            'dalam_servisan' => 'Dalam Servisan',
                            'selesai' => 'Selesai',
                            default => ucfirst($s),
                        };
                        // Normalize whitespace to a single space so no unintended line breaks
                        return preg_replace('/\s+/', ' ', $label);
                    }
                @endphp

                @if(!empty($dashBookings))
                    <div class="space-y-3">
                        @foreach($dashBookings as $db)
                        @php
                            $isArr = is_array($db);
                            $isModel = is_object($db) && ($db instanceof \App\Models\AntriStruk);
                            $status = $isArr ? ($db['status'] ?? '') : ($isModel ? ($db->status ?? '') : '');
                            $statusLabel = mapStatusLabel($status);
                            // Service name
                            if ($isArr) {
                                $serviceName = $db['service_name'] ?? 'Layanan';
                            } elseif ($isModel) {
                                $serviceName = optional($db->details->first())->deskripsi ?? 'Layanan';
                            } else {
                                $serviceName = 'Layanan';
                            }
                            // Service date
                            if ($isArr) {
                                $serviceDate = $db['service_date'] ?? '—';
                            } elseif ($isModel) {
                                $serviceDate = optional($db->jam_booking ?? $db->tanggal_pesan)->format('d F Y') ?? '—';
                            } else {
                                $serviceDate = '—';
                            }
                            // Car name
                            if ($isModel && optional($db->mobil)->nama_mobil) {
                                // Utamakan data relasi langsung supaya selalu mengikuti update terbaru Mobil
                                $carName = $db->mobil->nama_mobil . ' (' . ($db->mobil->plat_nomor ?? '—') . ')';
                            } elseif ($isArr) {
                                // Jika yang diterima array, coba baca struktur mobil jika tersedia
                                if (!empty($db['mobil']) && is_array($db['mobil'])) {
                                    $nm = $db['mobil']['nama_mobil'] ?? ($db['mobil']['nama'] ?? null);
                                    $pl = $db['mobil']['plat_nomor'] ?? ($db['mobil']['plat'] ?? null);
                                    $carName = $nm ? ($nm . ' (' . ($pl ?? '—') . ')') : ($db['car_name'] ?? '—');
                                } else {
                                    // Fallback lama
                                    $carName = $db['car_name'] ?? '—';
                                }
                            } else {
                                $carName = '—';
                            }
                            // Optional fields for array-based entries
                            $timeSlot = $isArr ? ($db['time_slot'] ?? '') : '';
                            $priceText = $isArr ? ($db['price'] ?? '') : '';
                        @endphp
                        <!-- Queue Card and Status Container -->
                        <div class="flex rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-200">
                            <!-- Main Queue Card -->
                            <div class="bg-white border border-[#0F044C]/20 shadow-sm h-[100px] flex-1 rounded-l-lg">
                                <div class="flex items-center h-full px-4 sm:px-5">
                                    <!-- Left Section: Clock Icon + Service Name + Arrow + Car Icon + Vehicle Name -->
                                    <div class="flex items-center space-x-3 sm:space-x-4 flex-1 min-w-0">
                                        <!-- Clock Icon -->
                                        <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center flex-shrink-0 bg-[#1D2C90]/10 rounded-lg">
                                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#1D2C90]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"/>
                                                <polyline points="12,6 12,12 16,14"/>
                                            </svg>
                                        </div>
                                        
                                        <!-- Service Details -->
                                        <div class="flex flex-col min-w-0 flex-1">
                                            <span class="font-bold defparagraf text-gray-900 text-sm sm:text-base truncate">{{ $serviceName }}</span>
                                            <span class="text-xs defparagraf text-gray-600 mt-0.5">{{ $serviceDate }}</span>
                                        </div>
                                        
                                        <!-- Arrow -->
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#1D2C90] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="9,18 15,12 9,6"/>
                                        </svg>
                                        
                                        <!-- Car Icon -->
                                        <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center flex-shrink-0 bg-[#1D2C90]/10 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 sm:w-7 sm:h-7 text-[#1D2C90]" viewBox="0 0 24 24"><path fill="currentColor" d="M19 20H5v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V11l2.48-5.788A2 2 0 0 1 6.32 4h11.36a2 2 0 0 1 1.838 1.212L22 11v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm1-7H4v5h16zM4.176 11h15.648l-2.143-5H6.32zM6.5 17a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m11 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3"/></svg>
                                        </div>
                                        
                                        <!-- Vehicle Details -->
                                        <div class="flex flex-col min-w-0 flex-1">
                                            <span class="font-bold defparagraf text-gray-900 text-sm sm:text-base truncate">{{ $carName }}</span>
                                            @if($priceText)
                                            <span class="text-xs defparagraf text-[#1D2C90] font-medium mt-0.5">{{ $priceText }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Right Section: Time, Line, and Button -->
                                    <div class="flex flex-col items-center space-y-2 ml-4 min-w-[155px] flex-shrink-0">
                                        <!-- Time -->
                                        @if($timeSlot)
                                            <span class="text-sm font-medium defparagraf text-[#1D2C90]">{{ $timeSlot }}</span>
                                            <div class="w-full h-px bg-[#1D2C90]/30"></div>
                                        @endif
                                        
                                        <!-- Detail Struk Button -->
                                        <a href="{{ route('antrian') }}" class="w-full px-3 py-1.5 bg-white border border-[#0F044C] defparagraf text-xs text-[#0F044C] hover:bg-[#0F044C] hover:text-white transition-all duration-200 text-center rounded-md font-medium">
                                             Menuju Antrian
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Status Card - Attached to the right -->
                            <div class="bg-gradient-to-br from-[#1D2C90]/5 to-[#0F044C]/5 border border-l-0 border-[#0F044C]/20 shadow-sm h-[100px] w-[190px] flex-none flex items-center justify-center px-3 rounded-r-lg">
                                <div class="text-center w-full">
                                    <span class="text-sm font-semibold defparagraf text-[#0F044C] leading-tight text-center whitespace-normal break-words">
                                        {{ $statusLabel }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <!-- No Booking Card -->
                    <div class="bg-white border border-[#0F044C]/20 shadow-sm rounded-lg h-[100px] flex items-center justify-center hover:shadow-md transition-shadow duration-200">
                        <div class="text-center">
                            <div class="text-gray-400 mb-3">
                                <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm defparagraf text-gray-600 font-medium">Belum ada booking aktif</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- RINGKASAN AKTIVITAS Section -->
            <div class="space-y-4 hidden">
                <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-bold tracking-tight">RINGKASAN AKTIVITAS</h2>
                
                <!-- Summary Cards Layout -->
                <div class="space-y-4 sm:space-y-5">
                    <!-- Second Row: Total Service and Total Pengeluaran -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                        <!-- Total Services Card -->
                        <div class="bg-white border border-[#0F044C]/20 shadow-md rounded-lg h-[100px] hover:shadow-lg transition-all duration-200 hover:scale-[1.01]">
                            <div class="flex items-center h-full px-5">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1D2C90] to-[#0F044C] rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 15 15"><path fill="currentColor" d="M3 5a2 2 0 0 0 1.732-1H12a1 1 0 1 0 0-2H4.732a2 2 0 0 0-3.464 0H3v2H1.268A2 2 0 0 0 3 5m-.854 4.354A.5.5 0 0 0 2 9.707V13.5a.5.5 0 0 0 .5.5H4a.5.5 0 0 0 .5-.5V13h6v.5a.5.5 0 0 0 .5.5h1.5a.5.5 0 0 0 .5-.5V9.707a.5.5 0 0 0-.146-.353L12 8.5l-1.354-2.257a.5.5 0 0 0-.43-.243H4.784a.5.5 0 0 0-.429.243L3 8.5zM11.134 9H3.866l1.2-2h4.868zM5.5 10.828v.372a.3.3 0 0 1-.3.3H3.3a.3.3 0 0 1-.3-.3v-.834a.3.3 0 0 1 .359-.294l1.82.364a.4.4 0 0 1 .321.392m6.5-.34v.712a.3.3 0 0 1-.3.3H9.8a.3.3 0 0 1-.3-.3v-.454a.3.3 0 0 1 .241-.294l1.78-.356a.4.4 0 0 1 .479.392"/></svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-3xl font-bold defparagraf text-[#0F044C] leading-none">{{ $activitySummary['total_services'] }}</p>
                                    <p class="text-xs defparagraf text-[#787A91] mt-1.5">Total servis yang dilakukan</p>
                                </div>
                            </div>
                        </div>

                        <!-- Money Spent Card -->
                        <div class="bg-white border border-[#0F044C]/20 shadow-md rounded-lg h-[100px] hover:shadow-lg transition-all duration-200 hover:scale-[1.01]">
                            <div class="flex items-center h-full px-5">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1D2C90] to-[#0F044C] rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="12" y1="1" x2="12" y2="23"/>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-3xl font-bold defparagraf text-[#0F044C] leading-none">{{ $activitySummary['formatted_spent'] }}</p>
                                    <p class="text-xs defparagraf text-[#787A91] mt-1.5">Total Pengeluaran</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- MOBIL YANG DIPUNYA Section -->
            <div class="space-y-4 hidden">
                <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-bold tracking-tight">MOBIL YANG DIPUNYA</h2>
                
                <!-- Cars Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 sm:gap-5">
                    @foreach($userCars as $car)
                    <!-- Car Card -->
                    <div class="bg-white border border-[#0F044C]/20 shadow-md rounded-lg h-[110px] hover:shadow-lg hover:scale-[1.02] transition-all duration-200">
                        <div class="flex items-center h-full px-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#1D2C90] to-[#0F044C] rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24"><path fill="currentColor" d="M19 20H5v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V11l2.48-5.788A2 2 0 0 1 6.32 4h11.36a2 2 0 0 1 1.838 1.212L22 11v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm1-7H4v5h16zM4.176 11h15.648l-2.143-5H6.32zM6.5 17a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m11 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3"/></svg>
                            </div>
                            <div class="flex-1 ml-3 min-w-0">
                                <h3 class="font-semibold defparagraf text-[#0F044C] text-sm truncate mb-0.5">{{ $car['nama'] }}</h3>
                                <p class="text-xs defparagraf text-[#787A91] leading-tight truncate">{{ $car['jenis_mobil'] }}</p>
                                <p class="text-xs defparagraf text-[#787A91] font-medium mt-0.5">{{ $car['plat_nomor'] }}</p>
                            </div>
                            <div class="flex flex-col gap-1.5 ml-2 flex-shrink-0">
                                <a href="{{ route('booking', ['car_id' => $car['id'] ?? null]) }}" class="px-2.5 py-1 bg-white border border-[#0F044C] defparagraf text-xs text-[#0F044C] hover:bg-[#0F044C] hover:text-white transition-all duration-200 rounded-md font-medium text-center">
                                    Book
                                </a>
                                @if(isset($car['id']))
                                    <a href="{{ route('user.mobil.edit', $car['id']) }}" class="px-2.5 py-1 bg-gradient-to-r from-[#0F044C] to-[#1D2C90] border border-[#0F044C] defparagraf text-xs text-white hover:from-[#1D2C90] hover:to-[#0F044C] transition-all duration-200 rounded-md text-center font-medium shadow-sm">
                                        Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Add New Car Card -->
                    <a href="{{ route('user.mobil.create') }}" class="bg-white border border-[#0F044C]/20 border-dashed shadow-md rounded-lg h-[110px] cursor-pointer hover:bg-gray-50 hover:shadow-lg hover:scale-[1.02] transition-all duration-200 block">
                        <div class="flex flex-col items-center justify-center h-full px-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#1D2C90] to-[#0F044C] rounded-xl flex items-center justify-center mb-2 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m-7-7h14"/></svg>
                            </div>
                            <span class="text-xs font-medium defparagraf text-[#0F044C] text-center">Tambah Mobil</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- LIST MOBIL YANG DIPUNYA Section -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-bold tracking-tight">Mobil yang Dipunya</h2>
                    <a href="{{ route('user.mobil.create') }}" class="px-4 py-2 bg-gradient-to-r from-[#1D2C90] to-[#0F044C] text-white rounded-lg font-semibold defparagraf text-sm hover:from-[#0F044C] hover:to-[#1D2C90] transition-all duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m-7-7h14"/></svg>
                        <span>Tambah Mobil</span>
                    </a>
                </div>
                
                @if(!empty($userCars))
                    <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gradient-to-r from-[#0F044C]/5 to-[#1D2C90]/5 border-b border-[#0F044C]/20">
                                        <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Mobil</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Jenis</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Plat Nomor</th>
                                        <th class="px-6 py-4 text-right text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($userCars as $car)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 bg-gradient-to-br from-[#1D2C90] to-[#0F044C] rounded-lg flex items-center justify-center flex-shrink-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24"><path fill="currentColor" d="M19 20H5v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V11l2.48-5.788A2 2 0 0 1 6.32 4h11.36a2 2 0 0 1 1.838 1.212L22 11v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm1-7H4v5h16zM4.176 11h15.648l-2.143-5H6.32zM6.5 17a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m11 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3"/></svg>
                                                    </div>
                                                    <span class="font-semibold defparagraf text-[#0F044C]">{{ $car['nama'] }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="defparagraf text-gray-700">{{ $car['jenis_mobil'] ?? '—' }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="defparagraf text-gray-700 font-medium">{{ $car['plat_nomor'] }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <a href="{{ route('booking', ['car_id' => $car['id'] ?? null]) }}" class="px-4 py-2 bg-white border border-[#0F044C] text-[#0F044C] defparagraf text-xs font-semibold rounded-lg hover:bg-[#0F044C] hover:text-white transition-all duration-200">
                                                        Booking
                                                    </a>
                                                    @if(isset($car['id']))
                                                        <a href="{{ route('user.mobil.edit', $car['id']) }}" class="px-4 py-2 bg-gradient-to-r from-[#1D2C90] to-[#0F044C] text-white defparagraf text-xs font-semibold rounded-lg hover:from-[#0F044C] hover:to-[#1D2C90] transition-all duration-200">
                                                            Edit
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="bg-white border border-[#0F044C]/20 border-dashed rounded-xl shadow-sm p-12 text-center">
                        <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" viewBox="0 0 24 24"><path fill="currentColor" d="M19 20H5v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V11l2.48-5.788A2 2 0 0 1 6.32 4h11.36a2 2 0 0 1 1.838 1.212L22 11v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm1-7H4v5h16zM4.176 11h15.648l-2.143-5H6.32zM6.5 17a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m11 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3"/></svg>
                        </div>
                        <p class="text-sm defparagraf text-gray-600 font-medium mb-4">Belum ada mobil terdaftar</p>
                        <a href="{{ route('user.mobil.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#1D2C90] to-[#0F044C] text-white rounded-lg font-semibold defparagraf hover:from-[#0F044C] hover:to-[#1D2C90] transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m-7-7h14"/></svg>
                            <span>Tambah Mobil Pertama</span>
                        </a>
                    </div>
                @endif
            </div>
    </div>

    <!-- Include Booking Receipt Modal Component -->
    <x-user.booking-receipt-modal />

    <script>
        // Function to show current booking detail
        // Dashboard now shows up to 3 active bookings. For details, navigate to the Antrian page.
        function showCurrentBookingDetail() {
            window.location.href = "{{ route('antrian') }}";
        }
    </script>
</x-user.dashboard-layout> 