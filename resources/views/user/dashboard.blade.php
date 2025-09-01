<x-user.dashboard-layout>
    <!-- Dashboard Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
            <!-- Header Section -->
            <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
                <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-alt-48 text-gray-900 mb-2">Dashboard</h1>
                <p class="text-gray-600 defparagraf">Kelola layanan AC mobil Anda di sini.</p>
            </div>

            <!-- ANTRIAN ANDA SAAT INI Section -->
            <div class="space-y-4">
                <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-alt-48 text-gray-900 font-semibold">ANTRIAN ANDA SAAT INI</h2>
                
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
                                    <span class="font-bold defparagraf text-gray-800 text-sm">Isi Freon</span>
                                    <span class="text-xs defparagraf text-gray-600">11 September 2025</span>
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
                                    <span class="font-bold defparagraf text-gray-800 text-sm">Mazda MX-5 Miata Na</span>
                                    <span class="text-xs defparagraf text-gray-800 mt-1">Rp 150.000</span>
                                </div>
                            </div>
                            
                            <!-- Right Section: Time, Line, and Button -->
                            <div class="flex flex-col items-center space-y-2 ml-4 min-w-[155px]">
                                <!-- Time -->
                                <span class="text-sm font-medium defparagraf">09:15 - •••</span>
                                
                                <!-- Horizontal Line -->
                                <div class="w-full h-px bg-black"></div>
                                
                                <!-- Detail Struk Button -->
                                <button onclick="showCurrentBookingDetail()" class="w-full px-3 py-1.5 bg-white border border-black defparagraf text-xs text-gray-700 hover:bg-gray-50 transition-colors">
                                    Detail Struk
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Status Card - Attached to the right -->
                    <div class="bg-[#EEEEEE] border-2 border-l-0 border-gray-800  shadow-sm h-[100px] min-w-[190px] flex items-center justify-center">
                        <div class="text-center">
                            <span class="text-sm font-medium defparagraf text-gray-800 leading-tight">
                                Sedang<br>Berlangsung
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RINGKASAN AKTIVITAS Section -->
            <div class="space-y-4">
                <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-alt-48 text-gray-900 font-semibold">RINGKASAN AKTIVITAS</h2>
                
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
                                    <p class="text-2xl font-bold defparagraf text-[#0F044C]">12</p>
                                    <p class="text-xs defparagraf text-[#787A91]">Total Service</p>
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
                                    <p class="text-2xl font-bold defparagraf text-[#0F044C]">2.1M</p>
                                    <p class="text-xs defparagraf text-[#787A91]">Total Pengeluaran</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- MOBIL YANG DIPUNYA Section -->
            <div class="space-y-4">
                <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-alt-48 text-gray-900">MOBIL YANG DIPUNYA</h2>
                
                <!-- Cars Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                    <!-- Car Card 1 -->
                    <div class="bg-white border-2 border-[#0F044C] shadow-sm h-[100px]">
                        <div class="flex items-center h-full px-4">
                            <div class="w-10 h-10 bg-[#141E61] rounded-full flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24"><path fill="currentColor" d="M19 20H5v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V11l2.48-5.788A2 2 0 0 1 6.32 4h11.36a2 2 0 0 1 1.838 1.212L22 11v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm1-7H4v5h16zM4.176 11h15.648l-2.143-5H6.32zM6.5 17a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m11 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3"/></svg>
                            </div>
                            <div class="flex-1 ml-3">
                                <h3 class="font-semibold defparagraf text-[#0F044C] text-sm">Mazda MX-5 Miata Na</h3>
                                <p class="text-xs defparagraf text-[#787A91]">2020 • Bensin • Last Service: 2 bulan lalu</p>
                            </div>
                            <button class="px-3 py-1.5 bg-white border border-[#0F044C] defparagraf text-xs text-[#0F044C] hover:bg-[#EEEEEE] transition-colors">
                                Book Service
                            </button>
                        </div>
                    </div>

                    <!-- Car Card 2 -->
                    <div class="bg-white border-2 border-[#0F044C] shadow-sm h-[100px]">
                        <div class="flex items-center h-full px-4">
                            <div class="w-10 h-10 bg-[#141E61] rounded-full flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24"><path fill="currentColor" d="M19 20H5v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V11l2.48-5.788A2 2 0 0 1 6.32 4h11.36a2 2 0 0 1 1.838 1.212L22 11v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm1-7H4v5h16zM4.176 11h15.648l-2.143-5H6.32zM6.5 17a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m11 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3"/></svg>
                            </div>
                            <div class="flex-1 ml-3">
                                <h3 class="font-semibold defparagraf text-[#0F044C] text-sm">Toyota Avanza</h3>
                                <p class="text-xs defparagraf text-[#787A91]">2018 • Bensin • Last Service: 1 bulan lalu</p>
                            </div>
                            <button class="px-3 py-1.5 bg-white border border-[#0F044C] defparagraf text-xs text-[#0F044C] hover:bg-[#EEEEEE] transition-colors">
                                Book Service
                            </button>
                        </div>
                    </div>

                    <!-- Add New Car Card -->
                    <div class="bg-[#EEEEEE] border-2 border-[#0F044C] shadow-sm h-[100px] cursor-pointer hover:bg-white transition-colors">
                        <div class="flex items-center justify-center h-full px-4">
                            <div class="w-10 h-10 bg-[#141E61] rounded-full flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg"  class="w-5 h-5 text-white" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m-7-7h14"/></svg>
                            </div>
                            <span class="text-sm font-medium defparagraf text-[#0F044C] ml-3">Tambah Mobil Baru</span>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <!-- Include Booking Receipt Modal Component -->
    <x-user.booking-receipt-modal />

    <script>
        function showCurrentBookingDetail() {
            const bookingData = {
                id: 'BWK-2024-001',
                date: '11/09/2025',
                time: '09:15',
                car: 'Mazda MX-5 Miata Na (2020)',
                services: ['Isi Freon'],
                address: '',
                notes: 'AC tidak dingin, perlu pengecekan sistem pendingin',
                status: 'confirmed',
                pricing: {
                    serviceCost: 'Rp 100.000',
                    sparepartCost: 'Rp 50.000',
                    deliveryCost: 'Rp 0',
                    totalCost: 'Rp 150.000'
                }
            };
            
            showReceiptModal(bookingData);
        }
    </script>
</x-user.dashboard-layout> 