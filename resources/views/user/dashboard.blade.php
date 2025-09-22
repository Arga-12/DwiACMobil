<x-user.dashboard-layout>
    <!-- Dashboard Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
            <!-- Header Section -->
            <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
                <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 uppercase text-gray-900 mb-2">Dashboard</h1>
                <p class="text-gray-600 defparagraf">Kelola layanan AC mobil Anda di sini.</p>
            </div>

            <!-- ANTRIAN ANDA SAAT INI Section -->
            <div class="space-y-4">
                <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-semibold">ANTRIAN ANDA SAAT INI</h2>
                
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
                        <div class="flex">
                            <!-- Main Queue Card -->
                            <div class="bg-white border-2 border-gray-800 shadow-sm h-[100px] flex-1">
                                <div class="flex items-center h-full px-4">
                                    <!-- Left Section: Clock Icon + Service Name + Arrow + Car Icon + Vehicle Name -->
                                    <div class="flex items-center space-x-3 flex-1">
                                        <!-- Clock Icon -->
                                        <div class="w-10 h-10 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-10 h-10 text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"/>
                                                <polyline points="12,6 12,12 16,14"/>
                                            </svg>
                                        </div>
                                        
                                        <!-- Service Details -->
                                        <div class="flex flex-col">
                                            <span class="font-bold defparagraf text-gray-800 text-sm">{{ $serviceName }}</span>
                                            <span class="text-xs defparagraf text-gray-600">{{ $serviceDate }}</span>
                                        </div>
                                        
                                        <!-- Arrow -->
                                        <svg class="w-4 h-4 text-gray-800 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="9,18 15,12 9,6"/>
                                        </svg>
                                        
                                        <!-- Car Icon -->
                                        <div class="w-10 h-10 flex items-center justify-center flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-800" viewBox="0 0 24 24"><path fill="currentColor" d="M19 20H5v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V11l2.48-5.788A2 2 0 0 1 6.32 4h11.36a2 2 0 0 1 1.838 1.212L22 11v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm1-7H4v5h16zM4.176 11h15.648l-2.143-5H6.32zM6.5 17a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m11 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3"/></svg>
                                        </div>
                                        
                                        <!-- Vehicle Details -->
                                        <div class="flex flex-col">
                                            <span class="font-bold defparagraf text-gray-800 text-sm">{{ $carName }}</span>
                                            @if($priceText)
                                            <span class="text-xs defparagraf text-gray-800 mt-1">{{ $priceText }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Right Section: Time, Line, and Button -->
                                    <div class="flex flex-col items-center space-y-2 ml-4 min-w-[155px]">
                                        <!-- Time -->
                                        @if($timeSlot)
                                            <span class="text-sm font-medium defparagraf">{{ $timeSlot }}</span>
                                            <div class="w-full h-px bg-black"></div>
                                        @endif
                                        
                                        <!-- Detail Struk Button -->
                                        <a href="{{ route('antrian') }}" class="w-full px-3 py-1.5 bg-white border border-black defparagraf text-xs text-gray-700 hover:bg-gray-50 transition-colors text-center">
                                             Menuju Antrian
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Status Card - Attached to the right -->
                            <div class="bg-[#EEEEEE] border-2 border-l-0 border-gray-800 shadow-sm h-[100px] w-[190px] flex-none flex items-center justify-center px-3">
                                <div class="text-center w-full">
                                    <span class="text-sm font-medium defparagraf text-gray-800 leading-tight text-center whitespace-normal break-words">
                                        {{ $statusLabel }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <!-- No Booking Card -->
                    <div class="bg-gray-50 h-[100px] flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-gray-500 mb-2">
                                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <p class="text-sm defparagraf text-gray-600 mb-2">Belum ada booking aktif</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- RINGKASAN AKTIVITAS Section -->
            <div class="space-y-4">
                <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-semibold">RINGKASAN AKTIVITAS</h2>
                
                <!-- Summary Cards Layout -->
                <div class="space-y-4 sm:space-y-5">
                    <!-- Second Row: Total Service and Total Pengeluaran -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                        <!-- Total Services Card -->
                        <div class="bg-white border-2 border-[#0F044C] shadow-sm h-[100px]">
                            <div class="flex items-center h-full px-4">
                                <div class="w-10 h-10 bg-[#141E61] rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 15 15"><path fill="currentColor" d="M3 5a2 2 0 0 0 1.732-1H12a1 1 0 1 0 0-2H4.732a2 2 0 0 0-3.464 0H3v2H1.268A2 2 0 0 0 3 5m-.854 4.354A.5.5 0 0 0 2 9.707V13.5a.5.5 0 0 0 .5.5H4a.5.5 0 0 0 .5-.5V13h6v.5a.5.5 0 0 0 .5.5h1.5a.5.5 0 0 0 .5-.5V9.707a.5.5 0 0 0-.146-.353L12 8.5l-1.354-2.257a.5.5 0 0 0-.43-.243H4.784a.5.5 0 0 0-.429.243L3 8.5zM11.134 9H3.866l1.2-2h4.868zM5.5 10.828v.372a.3.3 0 0 1-.3.3H3.3a.3.3 0 0 1-.3-.3v-.834a.3.3 0 0 1 .359-.294l1.82.364a.4.4 0 0 1 .321.392m6.5-.34v.712a.3.3 0 0 1-.3.3H9.8a.3.3 0 0 1-.3-.3v-.454a.3.3 0 0 1 .241-.294l1.78-.356a.4.4 0 0 1 .479.392"/></svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-2xl font-bold defparagraf text-[#0F044C]">{{ $activitySummary['total_services'] }}</p>
                                    <p class="text-xs defparagraf text-[#787A91]">Total servis yang dilakukan</p>
                                </div>
                            </div>
                        </div>

                        <!-- Money Spent Card -->
                        <div class="bg-white border-2 border-[#0F044C] shadow-sm h-[100px]">
                            <div class="flex items-center h-full px-4">
                                <div class="w-10 h-10 bg-[#141E61] rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="12" y1="1" x2="12" y2="23"/>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-2xl font-bold defparagraf text-[#0F044C]">{{ $activitySummary['formatted_spent'] }}</p>
                                    <p class="text-xs defparagraf text-[#787A91]">Total Pengeluaran</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- MOBIL YANG DIPUNYA Section -->
            <div class="space-y-4">
                <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900">MOBIL YANG DIPUNYA</h2>
                
                <!-- Cars Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 sm:gap-5">
                    @foreach($userCars as $car)
                    <!-- Car Card -->
                    <div class="bg-white border-2 border-[#0F044C] shadow-sm h-[110px] rounded-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center h-full px-4">
                            <div class="w-10 h-10 bg-[#141E61] rounded-full flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24"><path fill="currentColor" d="M19 20H5v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V11l2.48-5.788A2 2 0 0 1 6.32 4h11.36a2 2 0 0 1 1.838 1.212L22 11v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm1-7H4v5h16zM4.176 11h15.648l-2.143-5H6.32zM6.5 17a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m11 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3"/></svg>
                            </div>
                            <div class="flex-1 ml-3 min-w-0">
                                <h3 class="font-semibold defparagraf text-[#0F044C] text-sm truncate">{{ $car['nama'] }}</h3>
                                <p class="text-xs defparagraf text-[#787A91] leading-relaxed">{{ $car['jenis_mobil'] }}</p>
                                <p class="text-xs defparagraf text-[#787A91]">{{ $car['plat_nomor'] }}</p>
                            </div>
                            <div class="flex flex-col gap-1 ml-2">
                                <a href="{{ route('booking', ['car_id' => $car['id'] ?? null]) }}" class="px-2 py-1 bg-white border border-[#0F044C] defparagraf text-xs text-[#0F044C] hover:bg-[#EEEEEE] transition-colors rounded-sm">
                                    Book
                                </a>
                                @if(isset($car['id']))
                                    <a href="{{ route('user.mobil.edit', $car['id']) }}" class="px-2 py-1 bg-[#0F044C] border border-[#0F044C] defparagraf text-xs text-white hover:bg-[#0F044C]-700 transition-colors rounded-sm text-center">
                                        Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Add New Car Card -->
                    <a href="{{ route('user.mobil.create') }}" class="bg-[#EEEEEE] border-2 border-[#0F044C] border-dashed shadow-sm h-[110px] rounded-sm cursor-pointer hover:bg-white hover:shadow-md transition-all block">
                        <div class="flex flex-col items-center justify-center h-full px-4">
                            <div class="w-10 h-10 bg-[#141E61] rounded-full flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m-7-7h14"/></svg>
                            </div>
                            <span class="text-xs font-medium defparagraf text-[#0F044C] text-center">Tambah Mobil</span>
                        </div>
                    </a>
                </div>
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