<x-user.dashboard-layout>
    <!-- History Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
            <!-- Header -->
            <div class="mb-2 sm:mb-4">
                <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-alt-48 text-gray-900">RIWAYAT LAYANAN</h1>
                <p class="text-gray-600 defparagraf">Semua transaksi dan layanan Anda.</p>
            </div>

            @php
            $riwayat = [
                [
                    'judul' => 'CUCI EVAPORATOR',
                    'tanggal' => '15 Juni 2025',
                    'mobil' => 'Mazda MX-5 Miata NA',
                    'harga' => 'Rp. 100.000',
                    'waktu' => '09:30 - 12:16',
                    'status' => '1 Hari · Selesai'
                ],
                [
                    'judul' => 'SERVICE AC',
                    'tanggal' => '20 Juni 2025',
                    'mobil' => 'Toyota Avanza',
                    'harga' => 'Rp. 250.000',
                    'waktu' => '13:00 - 15:30',
                    'status' => 'Selesai'
                ],
                [
                    'judul' => 'GANTI FREON',
                    'tanggal' => '25 Juni 2025',
                    'mobil' => 'Honda Jazz',
                    'harga' => 'Rp. 180.000',
                    'waktu' => '10:00 - 11:20',
                    'status' => 'Selesai'
                ],
                [
                    'judul' => 'GANTI FREON',
                    'tanggal' => '25 Juni 2025',
                    'mobil' => 'Honda Jazz',
                    'harga' => 'Rp. 180.000',
                    'waktu' => '10:00 - 11:20',
                    'status' => 'Selesai'
                ]
            ];
            @endphp

            <!-- Cards -->
            <div class="grid grid-cols-2 gap-5 sm:gap-6">
                @foreach($riwayat as $item)
                    <div class="bg-white border-2 border-gray-800 shadow-sm">
                        <div class="px-6 sm:px-7 py-6">
                            <div class="flex items-stretch">
                                <!-- Left -->
                                <div class="flex-1 pr-4">
                                    <p class="font-extrabold defparagraf text-gray-900 text-lg tracking-wide">{{ $item['judul'] }}</p>
                                    <p class="defparagraf text-gray-800 mt-2">{{ $item['tanggal'] }}</p>
            
                                    <div class="flex items-center gap-3 mt-5">
                                        <div class="w-10 h-10 flex items-center justify-center flex-shrink-0">
                                            <!-- Car SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-800" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M19 20H5v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V11l2.48-5.788A2 2 0 0 1 6.32 4h11.36a2 2 0 0 1 1.838 1.212L22 11v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm1-7H4v5h16zM4.176 11h15.648l-2.143-5H6.32zM6.5 17a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m11 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3"/>
                                            </svg>
                                        </div>
                                        <svg class="w-4 h-4 text-gray-800 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="9,18 15,12 9,6"/>
                                        </svg>
                                        <p class="font-bold defparagraf text-gray-900">{{ $item['mobil'] }}</p>
                                    </div>
            
                                    <p class="defparagraf text-gray-900 mt-4">{{ $item['harga'] }}</p>
                                </div>
            
                                <!-- Right -->
                                <div class="flex flex-col justify-between w-full sm:w-[170px]">
                                    <div class="w-full flex flex-col items-center">
                                        <p class="defparagraf text-gray-900 font-medium">{{ $item['waktu'] }}</p>
                                        <div class="w-full h-px bg-black my-1.5"></div>
                                        <p class="text-[10px] defparagraf text-gray-600">{{ $item['status'] }}</p>
                                    </div>
                                    <button onclick="showHistoryDetail({{ $loop->index }})" class="mt-3 w-full px-3 py-1.5 bg-white border border-black defparagraf text-xs text-gray-700 hover:bg-gray-50 transition-colors">
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
        // Data riwayat untuk modal (sesuai dengan data PHP di atas)
        const historyData = [
            {
                id: 'BWK-2024-003',
                date: '15/06/2025',
                time: '09:30 - 12:16',
                car: 'Mazda MX-5 Miata NA (2020)',
                services: ['Cuci Evaporator'],
                address: 'Jl. Kemang Raya No. 45, Jakarta Selatan',
                notes: 'Evaporator sangat kotor, sudah dibersihkan menyeluruh',
                status: 'null',
                pricing: {
                    serviceCost: 'Rp 80.000',
                    sparepartCost: 'Rp 20.000',
                    deliveryCost: 'Rp 0',
                    totalCost: 'Rp 100.000'
                }
            },
            {
                id: 'BWK-2024-004',
                date: '20/06/2025',
                time: '13:00 - 15:30',
                car: 'Toyota Avanza (2018)',
                services: ['Service AC', 'Ganti Filter AC'],
                address: '',
                notes: 'Service rutin AC, filter AC sudah diganti dengan yang baru',
                status: 'null',
                pricing: {
                    serviceCost: 'Rp 150.000',
                    sparepartCost: 'Rp 100.000',
                    deliveryCost: 'Rp 0',
                    totalCost: 'Rp 250.000'
                }
            },
            {
                id: 'BWK-2024-005',
                date: '25/06/2025',
                time: '10:00 - 11:20',
                car: 'Honda Jazz (2019)',
                services: ['Ganti Freon'],
                address: 'Jl. Sudirman No. 88, Jakarta Pusat',
                notes: 'Freon habis, sudah diisi ulang dengan R134a',
                status: 'null',
                pricing: {
                    serviceCost: 'Rp 120.000',
                    sparepartCost: 'Rp 60.000',
                    deliveryCost: 'Rp 25.000',
                    totalCost: 'Rp 180.000'
                }
            },
            {
                id: 'BWK-2024-006',
                date: '25/06/2025',
                time: '10:00 - 11:20',
                car: 'Honda Jazz (2019)',
                services: ['Ganti Freon'],
                address: 'Jl. Sudirman No. 88, Jakarta Pusat',
                notes: 'Freon habis, sudah diisi ulang dengan R134a',
                status: 'null',
                pricing: {
                    serviceCost: 'Rp 120.000',
                    sparepartCost: 'Rp 60.000',
                    deliveryCost: 'Rp 25.000',
                    totalCost: 'Rp 180.000'
                }
            }
        ];

        // Function untuk menampilkan detail riwayat berdasarkan index
        function showHistoryDetail(index) {
            const data = historyData[index];
            if (data) {
                showReceiptModal(data);
            }
        }

        // Alternative: Function dengan ID spesifik untuk riwayat
        function showHistoryById(bookingId) {
            const data = historyData.find(item => item.id === bookingId);
            if (data) {
                showReceiptModal(data);
            }
        }

        // Alternative: Function dengan data custom untuk riwayat
        function showHistoryCustom(serviceType, date, car, price) {
            const bookingData = {
                id: 'BWK-HISTORY-' + Date.now(),
                date: date,
                time: '09:00 - 12:00',
                car: car,
                services: [serviceType],
                address: '',
                notes: 'Layanan telah selesai dikerjakan',
                status: 'null',
                pricing: {
                    serviceCost: price,
                    sparepartCost: 'Rp 0',
                    deliveryCost: 'Rp 0',
                    totalCost: price
                }
            };
            showReceiptModal(bookingData);
        }
    </script>
</x-user.dashboard-layout>
