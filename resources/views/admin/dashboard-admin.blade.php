<x-admin.dashboard-layout title="Admin Dashboard - Dwi AC Mobil">
    <!-- Dashboard Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-alt-48 text-gray-900 mb-2">Admin Dashboard</h1>
            <p class="text-gray-600 defparagraf">Kelola sistem dan monitor aktivitas AC mobil.</p>
        </div>

        <!-- STATISTIK UTAMA Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-alt-48 text-gray-900 font-semibold">STATISTIK UTAMA</h2>
            
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                <!-- Total Customers -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm h-[100px]">
                    <div class="flex items-center h-full px-4">
                        <div class="w-10 h-10 bg-[#141E61] rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-2xl font-bold defparagraf text-[#0F044C]">200</p>
                            <p class="text-xs defparagraf text-[#787A91]">Jumlah Pelanggan</p>
                        </div>
                    </div>
                </div>

                <!-- Services Today -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm h-[100px]">
                    <div class="flex items-center h-full px-4">
                        <div class="w-10 h-10 bg-[#141E61] rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-2xl font-bold defparagraf text-[#0F044C]">15</p>
                            <p class="text-xs defparagraf text-[#787A91]">Servis Hari Ini</p>
                        </div>
                    </div>
                </div>

                <!-- Rating -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm h-[100px]">
                    <div class="flex items-center h-full px-4">
                        <div class="w-10 h-10 bg-[#141E61] rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-2xl font-bold defparagraf text-[#0F044C]">4.5/5</p>
                            <p class="text-xs defparagraf text-[#787A91]">Rating Pelanggan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MANAJEMEN ANTRIAN & KALENDER Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-alt-48 text-gray-900 font-semibold">MANAJEMEN ANTRIAN & KALENDER</h2>
            
            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-5">
                <!-- Queue Management -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4">
                    <h3 class="text-lg font-bold defparagraf text-[#0F044C] mb-4">Antrian Hari Ini</h3>
                        
                    <!-- Service Cards -->
                    <div class="space-y-3">
                        <!-- Isi Freon Card -->
                        <div class="bg-white border-2 border-gray-800 shadow-sm p-3">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-semibold defparagraf text-[#0F044C] text-sm">Isi Freon</h4>
                                <span class="text-xs defparagraf text-[#787A91]">09:00-10:00</span>
                            </div>
                            <p class="text-xs defparagraf text-[#787A91] mb-2">10 Juni 2025</p>
                            <div class="flex items-center space-x-2 mb-2">
                                <div class="w-4 h-4 bg-[#141E61] rounded-full"></div>
                                <span class="text-xs defparagraf text-[#787A91]">2 Mtr Antrean NA</span>
                            </div>
                            <div class="flex items-center space-x-2 mb-2">
                                <div class="w-4 h-4 bg-[#141E61] rounded-full"></div>
                                <span class="text-xs defparagraf text-[#787A91]">2 Mtr Akiyama</span>
                            </div>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 bg-white border border-[#0F044C] defparagraf text-xs text-[#0F044C] hover:bg-[#EEEEEE] transition-colors">Selesai</button>
                                <button class="px-3 py-1 bg-[#141E61] defparagraf text-xs text-white hover:bg-[#0F044C] transition-colors">Detail</button>
                            </div>
                        </div>

                        <!-- Second Service Card -->
                        <div class="bg-white border-2 border-gray-800 shadow-sm p-3">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-semibold defparagraf text-[#0F044C] text-sm">Ganti Evaporator</h4>
                                <span class="text-xs defparagraf text-[#787A91]">11:00-12:00</span>
                            </div>
                            <p class="text-xs defparagraf text-[#787A91] mb-2">10 Juni 2025</p>
                            <div class="flex items-center space-x-2 mb-2">
                                <div class="w-4 h-4 bg-[#141E61] rounded-full"></div>
                                <span class="text-xs defparagraf text-[#787A91]">Dodge Charge 1970</span>
                            </div>
                            <div class="flex items-center space-x-2 mb-2">
                                <div class="w-4 h-4 bg-[#141E61] rounded-full"></div>
                                <span class="text-xs defparagraf text-[#787A91]">Mio Akiyama</span>
                            </div>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 bg-white border border-[#0F044C] defparagraf text-xs text-[#0F044C] hover:bg-[#EEEEEE] transition-colors">Selesai</button>
                                <button class="px-3 py-1 bg-[#141E61] defparagraf text-xs text-white hover:bg-[#0F044C] transition-colors">Detail</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar Widget -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold defparagraf text-[#0F044C]">September 2025</h3>
                        <div class="flex space-x-2">
                            <button class="p-1 hover:bg-[#EEEEEE] rounded">
                                <svg class="w-4 h-4 text-[#0F044C]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button class="p-1 hover:bg-[#EEEEEE] rounded">
                                <svg class="w-4 h-4 text-[#0F044C]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                        
                    <!-- Calendar Grid -->
                    <div class="grid grid-cols-7 gap-0 border-2 border-[#0F044C]">
                        <!-- Headers -->
                        <div class="font-semibold defparagraf text-white p-2 bg-[#141E61] border-r border-[#0F044C] text-center text-xs">Sen</div>
                        <div class="font-semibold defparagraf text-white p-2 bg-[#141E61] border-r border-[#0F044C] text-center text-xs">Sel</div>
                        <div class="font-semibold defparagraf text-white p-2 bg-[#141E61] border-r border-[#0F044C] text-center text-xs">Rab</div>
                        <div class="font-semibold defparagraf text-white p-2 bg-[#141E61] border-r border-[#0F044C] text-center text-xs">Kam</div>
                        <div class="font-semibold defparagraf text-white p-2 bg-[#141E61] border-r border-[#0F044C] text-center text-xs">Jum</div>
                        <div class="font-semibold defparagraf text-white p-2 bg-[#141E61] border-r border-[#0F044C] text-center text-xs">Sab</div>
                        <div class="font-semibold defparagraf text-white p-2 bg-[#141E61] text-center text-xs">Min</div>
                            
                        <!-- Week 1 -->
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">1</div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">2</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-[#141E61] text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">
                                    Isi Freon
                                </span>
                            </div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">3</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-[#141E61] text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">
                                    Ganti E...
                                </span>
                            </div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">4</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-[#141E61] text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">
                                    Cek Fr...
                                </span>
                            </div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">5</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-red-500 text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">Libur</span>
                            </div>
                        </div>
                        <div class="h-12 p-1 border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">6</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-[#141E61] text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">
                                    Pasang
                                </span>
                            </div>
                        </div>
                        
                        <!-- Week 2 -->
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">8</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-[#141E61] text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">Bongkar Pasang</span>
                            </div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">9</div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">10</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-[#141E61] text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">
                                    Isi Fr...
                                </span>
                            </div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">11</div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">12</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-orange-500 text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">
                                    Ganti E...
                                </span>
                            </div>
                        </div>
                        <div class="h-12 p-1 border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">13</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-orange-500 text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">
                                    Pasang g...
                                </span>
                            </div>
                        </div>
                        
                        <!-- Week 3 -->
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">15</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-gray-500 text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">Tersedia</span>
                            </div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">16</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-gray-500 text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">Tersedia</span>
                            </div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">17</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-gray-500 text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">Tersedia</span>
                            </div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">18</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-gray-500 text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">Tersedia</span>
                            </div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white relative">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">19</div>
                            <div class="absolute bottom-0.5 left-0.5 right-0.5">
                                <span class="bg-gray-500 text-white text-xs px-1 py-0.5 defparagraf block text-center truncate">Tersedia</span>
                            </div>
                        </div>
                        <div class="h-12 p-1 border-b border-[#0F044C] bg-white">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">20</div>
                        </div>
                        
                        <!-- Week 4 -->
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">22</div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">23</div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">24</div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">25</div>
                        </div>
                        <div class="h-12 p-1 border-r border-b border-[#0F044C] bg-white">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">26</div>
                        </div>
                        <div class="h-12 p-1 border-b border-[#0F044C] bg-white">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">27</div>
                        </div>
                        
                        <!-- Week 5 -->
                        <div class="h-12 p-1 border-r border-[#0F044C] bg-white">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">29</div>
                        </div>
                        <div class="h-12 p-1 border-r border-[#0F044C] bg-white">
                            <div class="text-xs font-medium defparagraf text-[#0F044C]">30</div>
                        </div>
                        <div class="h-12 p-1 border-r border-[#0F044C] bg-white"></div>
                        <div class="h-12 p-1 border-r border-[#0F044C] bg-white"></div>
                        <div class="h-12 p-1 border-r border-[#0F044C] bg-white"></div>
                        <div class="h-12 p-1 bg-white"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DATA PELANGGAN Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-alt-48 text-gray-900 font-semibold">DATA PELANGGAN</h2>
            
            <!-- Customer Data Table -->
            <div class="bg-white border-2 border-[#0F044C] shadow-sm p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b-2 border-[#0F044C]">
                                <th class="text-left py-3 px-4 font-semibold defparagraf text-[#0F044C]">Nama</th>
                                <th class="text-left py-3 px-4 font-semibold defparagraf text-[#0F044C]">No HP</th>
                                <th class="text-left py-3 px-4 font-semibold defparagraf text-[#0F044C]">E-mail</th>
                                <th class="text-left py-3 px-4 font-semibold defparagraf text-[#0F044C]">Layanan</th>
                                <th class="text-left py-3 px-6 font-semibold defparagraf text-[#0F044C] w-48">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200 hover:bg-[#EEEEEE]">
                                <td class="py-3 px-4 defparagraf text-[#0F044C]">Ritsu Tainaka</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">0812345678</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">R***@gmail.com</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">Isi Freon</td>
                                <td class="py-3 px-6 font-medium defparagraf text-[#0F044C]">10 September 2025</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-[#EEEEEE]">
                                <td class="py-3 px-4 defparagraf text-[#0F044C]">Mio Akiyama</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">0814444359</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">M***@Gmail.com</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">Ganti evaporator</td>
                                <td class="py-3 px-6 font-medium defparagraf text-[#0F044C]">11 September 2025</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-[#EEEEEE]">
                                <td class="py-3 px-4 defparagraf text-[#0F044C]">Tsumugi Kotobuki</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">0854646677</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">S***@Gmail.com</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">Pasang AC Baru</td>
                                <td class="py-3 px-6 font-medium defparagraf text-[#0F044C]">12 September 2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin.dashboard-layout>