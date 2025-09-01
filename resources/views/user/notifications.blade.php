<x-user.dashboard-layout>
    <!-- Notifications Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
            <!-- Header -->
            <div class="mb-2 sm:mb-4">
                <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-alt-48 text-gray-900">NOTIFIKASI</h1>
                <p class="text-gray-600 defparagraf">Semua pemberitahuan dan update layanan Anda.</p>
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
            <div class="space-y-6">
                <h2 class="text-2xl font-montserrat-alt-48 text-gray-900 tracking-wide">TERBARU</h2>
                
                @foreach($notifikasi['terbaru'] as $item)
                <div class="bg-white border border-gray-800 shadow-sm">
                    <div class="px-4 sm:px-5 py-4">
                        <div class="flex items-stretch justify-between gap-6">
                            <!-- Left Content -->
                            <div class="flex-1">
                                <p class="font-bold bigparagraf text-gray-900 mb-1">{{ $item['judul'] }}</p>
                                <p class="bigparagraf text-gray-700">{{ $item['tanggal'] }} · {{ $item['mobil'] }}</p>
                            </div>
                            
                            <!-- Right Content -->
                            <div class="flex flex-col items-center justify-between w-36 sm:w-40">
                                <p class="bigparagraf text-gray-900 text-center">{{ $item['waktu'] }}</p>
                                <div class="w-full h-px bg-gray-800 my-2"></div>
                                <button onclick="showNotificationDetail('{{ $item['type'] }}', '{{ $loop->index }}')" class="px-4 py-1.5 bg-white border border-gray-800 defparagraf text-gray-700 hover:bg-gray-50 transition-colors w-full">
                                    Detail Struk
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


            <!-- LAMPAU Section -->
            <div class="space-y-6 mt-10">
                <h2 class="text-2xl font-montserrat-alt-48 text-gray-900 tracking-wide">LAMPAU</h2>
                
                @foreach($notifikasi['lampau'] as $item)
                <div class="bg-white border border-gray-800 shadow-sm">
                    <div class="px-4 sm:px-5 py-4">
                        <div class="flex items-stretch justify-between gap-6">
                            <!-- Left Content -->
                            <div class="flex-1">
                                <p class="font-bold bigparagraf text-gray-900 mb-1">{{ $item['judul'] }}</p>
                                <p class="bigparagraf text-gray-700">{{ $item['tanggal'] }} · {{ $item['mobil'] }}</p>
                            </div>
                            
                            <!-- Right Content -->
                            <div class="flex flex-col items-center justify-between w-36 sm:w-40">
                                <p class="bigparagraf text-gray-900 text-center">{{ $item['waktu'] }}</p>
                                <div class="w-full h-px bg-gray-800 my-2"></div>
                                <button onclick="showNotificationDetail('{{ $item['type'] }}', '{{ $loop->index }}')" class="px-4 py-1.5 bg-white border border-gray-800 defparagraf text-gray-700 hover:bg-gray-50 transition-colors w-full">
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
