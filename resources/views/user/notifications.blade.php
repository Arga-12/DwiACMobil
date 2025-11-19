<x-user.dashboard-layout>
    <!-- Notifications Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
            <!-- Header -->
            <div class="mb-4 sm:mb-6 md:mb-8">
                <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 uppercase text-gray-900 font-bold tracking-tight">
                    NOTIFIKASI
                </h1>
                <p class="mt-1 text-gray-600 defparagraf text-sm sm:text-base">
                    Semua pemberitahuan dan update layanan Anda.
                </p>
            </div>

            @php
            $notifikasi = [
                'terbaru' => [
                    [
                        'judul' => 'Penerimaan harga servis - CUCI EVAPORATOR',
                        'tanggal' => '14 Juni 2025',
                        'mobil' => 'Mazda MX-5 Miata NA',
                        'waktu' => '09:30',
                        'type' => 'terbaru'
                    ]
                ],
                'lampau' => [
                    [
                        'judul' => 'Telah Selesai Servis - ISI FREON',
                        'tanggal' => '10 Juni 2025',
                        'mobil' => 'Mazda MX-5 Miata NA',
                        'waktu' => '09:00 - 10:00',
                        'type' => 'lampau'
                    ]
                ]
            ];
            @endphp

            <!-- TERBARU Section -->
            <div class="space-y-4 sm:space-y-5">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#1D2C90] to-[#0F044C] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-lg sm:text-xl md:text-2xl font-montserrat-48 text-gray-900 font-bold tracking-wide">TERBARU</h2>
                </div>
                
                @foreach($notifikasi['terbaru'] as $item)
                <div class="bg-white border border-[#0F044C]/20 shadow-md rounded-2xl overflow-hidden">
                    <div class="px-4 sm:px-5 py-4 sm:py-5">
                        <div class="flex flex-col md:flex-row items-stretch justify-between gap-4 sm:gap-6">
                            <!-- Left Content -->
                            <div class="flex-1 min-w-0">
                                <p class="font-bold bigparagraf text-gray-900 text-sm sm:text-base md:text-lg mb-1">
                                    {{ $item['judul'] }}
                                </p>
                                <p class="bigparagraf text-gray-700 text-xs sm:text-sm">
                                    {{ $item['tanggal'] }} · {{ $item['mobil'] }}
                                </p>
                            </div>
                            
                            <!-- Right Content -->
                            <div class="flex flex-col items-stretch justify-between w-full md:w-40 lg:w-48">
                                <div class="flex items-center justify-between md:block md:text-center mb-2 md:mb-3">
                                    <span class="bigparagraf text-gray-900 text-sm sm:text-base font-semibold">
                                        {{ $item['waktu'] }}
                                    </span>
                                </div>
                                <button 
                                    onclick="showNotificationDetail('{{ $item['type'] }}', '{{ $loop->index }}')" 
                                    class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-[#1D2C90] to-[#0F044C] hover:from-[#0F044C] hover:to-[#1D2C90] text-white defparagraf text-xs sm:text-sm font-semibold rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Detail Struk
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


            <!-- LAMPAU Section -->
            <div class="space-y-4 sm:space-y-5 mt-8 sm:mt-10">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gray-300 to-gray-500 flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                <h2 class="text-lg sm:text-xl md:text-2xl font-montserrat-48 text-gray-900 font-bold tracking-wide">LAMPAU</h2>
                </div>
                
                @foreach($notifikasi['lampau'] as $item)
                <div class="bg-white border border-[#0F044C]/15 shadow-md rounded-2xl overflow-hidden">
                    <div class="px-4 sm:px-5 py-4 sm:py-5">
                        <div class="flex flex-col md:flex-row items-stretch justify-between gap-4 sm:gap-6">
                            <!-- Left Content -->
                            <div class="flex-1 min-w-0">
                                <p class="font-bold bigparagraf text-gray-900 text-sm sm:text-base md:text-lg mb-1">
                                    {{ $item['judul'] }}
                                </p>
                                <p class="bigparagraf text-gray-700 text-xs sm:text-sm">
                                    {{ $item['tanggal'] }} · {{ $item['mobil'] }}
                                </p>
                            </div>
                            
                            <!-- Right Content -->
                            <div class="flex flex-col items-stretch justify-between w-full md:w-40 lg:w-48">
                                <div class="flex items-center justify-between md:block md:text-center mb-2 md:mb-3">
                                    <span class="bigparagraf text-gray-900 text-sm sm:text-base font-semibold">
                                        {{ $item['waktu'] }}
                                    </span>
                                </div>
                                <button 
                                    onclick="showNotificationDetail('{{ $item['type'] }}', '{{ $loop->index }}')" 
                                    class="inline-flex items-center justify-center px-4 py-2 bg-white border border-[#0F044C]/40 text-[#0F044C] hover:bg-[#1D2C90] hover:text-white defparagraf text-xs sm:text-sm font-semibold rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Detail Struk
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
        <!-- Include Booking Receipt Modal Component -->
        <x-user.booking-receipt-modal />

        <script>
            // Data untuk notifikasi (biasanya dari backend)
            const notificationData = {
                'terbaru': [
                    {
                        id: 'BWK-2024-002',
                        date: '14/06/2025',
                        time: '09:30',
                        car: 'Mazda MX-5 Miata NA (2020)',
                        services: ['Cuci Evaporator'],
                        address: 'Jl. Sudirman No. 123, Jakarta',
                        notes: 'Evaporator kotor, perlu pembersihan menyeluruh',
                        status: 'waiting', // Menunggu konfirmasi harga
                        pricing: null // Belum ada harga
                    }
                ],
                'lampau': [
                    {
                        id: 'BWK-2024-001',
                        date: '10/06/2025',
                        time: '09:00 - 10:00',
                        car: 'Mazda MX-5 Miata NA (2020)',
                        services: ['Isi Freon'],
                        address: '',
                        notes: 'AC tidak dingin, sudah diperbaiki',
                        status: 'completed', // Selesai
                        pricing: {
                            serviceCost: 'Rp 100.000',
                            sparepartCost: 'Rp 50.000',
                            deliveryCost: 'Rp 0',
                            totalCost: 'Rp 150.000'
                        }
                    }
                ]
            };

            // METODE 1: Function dengan parameter type dan index
            function showNotificationDetail(type, index) {
                const data = notificationData[type][index];
                if (data) {
                    showReceiptModal(data);
                }
            }

            // METODE 2: Function terpisah untuk setiap jenis notifikasi
            function showTerbaruDetail(index) {
                const bookingData = {
                    id: 'BWK-2024-002',
                    date: '14/06/2025',
                    time: '09:30',
                    car: 'Mazda MX-5 Miata NA (2020)',
                    services: ['Cuci Evaporator'],
                    address: 'Jl. Sudirman No. 123, Jakarta',
                    notes: 'Evaporator kotor, perlu pembersihan menyeluruh',
                    status: 'waiting' // Masih menunggu konfirmasi harga
                };
                showReceiptModal(bookingData);
            }

            function showLampauDetail(index) {
                const bookingData = {
                    id: 'BWK-2024-001',
                    date: '10/06/2025',
                    time: '09:00 - 10:00',
                    car: 'Mazda MX-5 Miata NA (2020)',
                    services: ['Isi Freon'],
                    address: '',
                    notes: 'AC tidak dingin, sudah diperbaiki',
                    status: 'completed',
                    pricing: {
                        serviceCost: 'Rp 100.000',
                        sparepartCost: 'Rp 50.000',
                        deliveryCost: 'Rp 0',
                        totalCost: 'Rp 150.000'
                    }
                };
                showReceiptModal(bookingData);
            }

            // METODE 3: Function dengan ID booking spesifik
            function showBookingById(bookingId) {
                let bookingData = null;
                
                // Cari data berdasarkan ID
                switch(bookingId) {
                    case 'BWK-2024-001':
                        bookingData = {
                            id: 'BWK-2024-001',
                            date: '10/06/2025',
                            time: '09:00 - 10:00',
                            car: 'Mazda MX-5 Miata NA (2020)',
                            services: ['Isi Freon'],
                            status: 'completed',
                            pricing: {
                                serviceCost: 'Rp 100.000',
                                sparepartCost: 'Rp 50.000',
                                totalCost: 'Rp 150.000'
                            }
                        };
                        break;
                    case 'BWK-2024-002':
                        bookingData = {
                            id: 'BWK-2024-002',
                            date: '14/06/2025',
                            time: '09:30',
                            car: 'Mazda MX-5 Miata NA (2020)',
                            services: ['Cuci Evaporator'],
                            status: 'waiting'
                        };
                        break;
                }
                
                if (bookingData) {
                    showReceiptModal(bookingData);
                }
            }

            // METODE 4: Function dengan object data langsung
            function showCustomBookingDetail(customData) {
                const bookingData = {
                    id: customData.id || 'BWK-XXXX',
                    date: customData.date || '-',
                    time: customData.time || '-',
                    car: customData.car || '-',
                    services: customData.services || [],
                    address: customData.address || '',
                    notes: customData.notes || '',
                    status: customData.status || 'waiting',
                    pricing: customData.pricing || null
                };
                showReceiptModal(bookingData);
            }
        </script>
</x-user.dashboard-layout>