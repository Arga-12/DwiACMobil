<x-admin.dashboard-layout title="Admin Dashboard - Dwi AC Mobil">
    <!-- Dashboard Content dengan Dual Mode -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        
        <!-- BENGKEL DASHBOARD MODE -->
        <div id="bengkelDashboard" class="transition-opacity duration-300">
            <!-- Header Section -->
            <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12 flex items-center justify-between">
                <div>
                    <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 uppercase text-gray-900 mb-2">Dashboard Bengkel</h1>
                    <p class="text-gray-600 defparagraf">Kelola antrian, layanan, dan operasional bengkel</p>
                </div>
                <!-- Mode Indicator Badge -->
                <div class="flex items-center space-x-2 bg-[#141E61] text-white px-4 py-2 rounded-full">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <path fill="currentColor" fill-rule="evenodd" d="M6 1a1.75 1.75 0 0 0-1.75 1.75V4H3a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.25V2.75A1.75 1.75 0 0 0 10 1zm4.25 3V2.75A.25.25 0 0 0 10 2.5H6a.25.25 0 0 0-.25.25V4zM3 5.5h10a.5.5 0 0 1 .5.5v1h-11V6a.5.5 0 0 1 .5-.5m-.5 3V13a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8.5H9V10H7V8.5z" clip-rule="evenodd"/>
                    </svg>
                    <span class="defparagraf text-sm">Mode Bengkel</span>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-8">
                <!-- Total Customers -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold defparagraf text-[#0F044C]">200</p>
                            <p class="text-xs defparagraf text-[#787A91] mt-1">Total Pelanggan</p>
                        </div>
                        <div class="w-12 h-12 bg-[#141E61] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2S7.5 4.019 7.5 6.5M20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Services Today -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold defparagraf text-[#0F044C]">15</p>
                            <p class="text-xs defparagraf text-[#787A91] mt-1">Servis Hari Ini</p>
                        </div>
                        <div class="w-12 h-12 bg-[#141E61] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 512 512">
                                <path d="M425.7 118.25A240 240 0 0 0 76.32 447l.18.2c.33.35.64.71 1 1.05c.74.84 1.58 1.79 2.57 2.78a41.17 41.17 0 0 0 60.36-.42a157.13 157.13 0 0 1 231.26 0a41.18 41.18 0 0 0 60.65.06l3.21-3.5l.18-.2a239.93 239.93 0 0 0-10-328.76ZM240 128a16 16 0 0 1 32 0v32a16 16 0 0 1-32 0ZM128 304H96a16 16 0 0 1 0-32h32a16 16 0 0 1 0 32m48.8-95.2a16 16 0 0 1-22.62 0l-22.63-22.62a16 16 0 0 1 22.63-22.63l22.62 22.63a16 16 0 0 1 0 22.62m149.3 23.1l-47.5 75.5a31 31 0 0 1-7 7a30.11 30.11 0 0 1-35-49l75.5-47.5a10.23 10.23 0 0 1 11.7 0a10.06 10.06 0 0 1 2.3 14m31.72-23.1a16 16 0 0 1-22.62-22.62l22.62-22.63a16 16 0 0 1 22.63 22.63ZM416 304h-32a16 16 0 0 1 0-32h32a16 16 0 0 1 0 32"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Queue Status -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold defparagraf text-[#0F044C]">8</p>
                            <p class="text-xs defparagraf text-[#787A91] mt-1">Antrian Aktif</p>
                        </div>
                        <div class="w-12 h-12 bg-[#141E61] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7L4 8v10h16V8zm0-2l8-5H4zM4 8V6v12z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Rating -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold defparagraf text-[#0F044C]">4.5/5</p>
                            <p class="text-xs defparagraf text-[#787A91] mt-1">Rating Bengkel</p>
                        </div>
                        <div class="w-12 h-12 bg-[#141E61] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="m12 18.26l-7.053 3.948l1.575-7.928L.588 8.792l8.027-.952L12 .5l3.385 7.34l8.027.952l-5.934 5.488l1.575 7.928z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid: Antrian & Calendar -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Queue Management (dari code asli Anda) -->
                <div>
                    <h3 class="text-lg sm:text-xl font-montserrat-48 text-gray-900 font-semibold mb-4 uppercase">Antrian Hari Ini</h3>
                    <div class="space-y-3">
                        <!-- Service Cards (gunakan code antrian asli Anda) -->
                    </div>
                </div>

                <!-- Calendar Widget (dari code asli Anda) -->
                <div class="bg-white border-2 border-[#0F044C] p-4">
                    <!-- Calendar content asli Anda -->
                </div>
            </div>

            <!-- Customer Data Table -->
            <div class="mt-8">
                <h2 class="text-lg sm:text-xl font-montserrat-48 text-gray-900 font-semibold mb-4">DATA PELANGGAN</h2>
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-6">
                    <!-- Table content asli Anda -->
                </div>
            </div>
        </div>

        <!-- WEBSITE DASHBOARD MODE -->
        <div id="websiteDashboard" class="hidden opacity-0 transition-opacity duration-300">
            <!-- Header Section -->
            <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12 flex items-center justify-between">
                <div>
                    <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 uppercase text-gray-900 mb-2">Dashboard Website</h1>
                    <p class="text-gray-600 defparagraf">Kelola konten, artikel, dan galeri website</p>
                </div>
                <!-- Mode Indicator Badge -->
                <div class="flex items-center space-x-2 bg-[#141E61] text-white px-4 py-2 rounded-full">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M22 12a10 10 0 1 1-20.001 0A10 10 0 0 1 22 12Z"/>
                            <path d="M16 12c0 1.313-.104 2.614-.305 3.827c-.2 1.213-.495 2.315-.867 3.244c-.371.929-.812 1.665-1.297 2.168c-.486.502-1.006.761-1.531.761s-1.045-.259-1.53-.761c-.486-.503-.927-1.24-1.298-2.168c-.372-.929-.667-2.03-.868-3.244A23.6 23.6 0 0 1 8 12c0-1.313.103-2.614.304-3.827s.496-2.315.868-3.244c.371-.929.812-1.665 1.297-2.168C10.955 2.26 11.475 2 12 2s1.045.259 1.53.761c.486.503.927 1.24 1.298 2.168c.372.929.667 2.03.867 3.244C15.897 9.386 16 10.687 16 12Z"/>
                            <path stroke-linecap="round" d="M2 12h20"/>
                        </g>
                    </svg>
                    <span class="defparagraf text-sm">Mode Website</span>
                </div>
            </div>

            <!-- Website Statistics -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-8">
                <!-- Total Articles -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold defparagraf text-[#0F044C]">45</p>
                            <p class="text-xs defparagraf text-[#787A91] mt-1">Total Artikel</p>
                        </div>
                        <div class="w-12 h-12 bg-[#141E61] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14l4-4h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Gallery Photos -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold defparagraf text-[#0F044C]">128</p>
                            <p class="text-xs defparagraf text-[#787A91] mt-1">Foto Galeri</p>
                        </div>
                        <div class="w-12 h-12 bg-[#141E61] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M4 3a2 2 0 0 0-2 2v14l4-4h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm12 12H4l4-8l3 6l2-4l3 6z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Team Members -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold defparagraf text-[#0F044C]">8</p>
                            <p class="text-xs defparagraf text-[#787A91] mt-1">Tim Montir</p>
                        </div>
                        <div class="w-12 h-12 bg-[#141E61] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <circle cx="12" cy="8" r="5"/>
                                    <path d="M20 21a8 8 0 0 0-16 0"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Page Views -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold defparagraf text-[#0F044C]">2.5K</p>
                            <p class="text-xs defparagraf text-[#787A91] mt-1">Visitor Bulan Ini</p>
                        </div>
                        <div class="w-12 h-12 bg-[#141E61] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Website Content Management Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Articles -->
                <div class="bg-white border-2 border-[#0F044C] p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-montserrat-48 text-gray-900 font-semibold uppercase">Artikel Terbaru</h3>
                        <a href="{{ route('admin.artikel.index') }}" class="text-xs defparagraf text-[#141E61] hover:underline">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
                        <!-- Article Items -->
                        <div class="border-b border-gray-200 pb-3">
                            <h4 class="text-sm defparagraf font-semibold text-[#0F044C] mb-1">Tips Merawat AC Mobil di Musim Hujan</h4>
                            <p class="text-xs defparagraf text-[#787A91]">Dipublikasi: 15 Nov 2025</p>
                            <div class="flex items-center space-x-2 mt-2">
                                <span class="text-xs defparagraf px-2 py-1 bg-green-100 text-green-700 rounded">Published</span>
                                <span class="text-xs defparagraf text-[#787A91]">150 views</span>
                            </div>
                        </div>
                        <div class="border-b border-gray-200 pb-3">
                            <h4 class="text-sm defparagraf font-semibold text-[#0F044C] mb-1">Tanda-tanda Freon AC Mobil Habis</h4>
                            <p class="text-xs defparagraf text-[#787A91]">Dipublikasi: 12 Nov 2025</p>
                            <div class="flex items-center space-x-2 mt-2">
                                <span class="text-xs defparagraf px-2 py-1 bg-green-100 text-green-700 rounded">Published</span>
                                <span class="text-xs defparagraf text-[#787A91]">203 views</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gallery Management -->
                <div class="bg-white border-2 border-[#0F044C] p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-montserrat-48 text-gray-900 font-semibold uppercase">Galeri Terbaru</h3>
                        <a href="#" class="text-xs defparagraf text-[#141E61] hover:underline">Kelola Galeri</a>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <!-- Gallery Thumbnails -->
                        <div class="aspect-square bg-gray-200 rounded overflow-hidden">
                            <img src="/api/placeholder/150/150" alt="Gallery" class="w-full h-full object-cover hover:scale-110 transition-transform"/>
                        </div>
                        <div class="aspect-square bg-gray-200 rounded overflow-hidden">
                            <img src="/api/placeholder/150/150" alt="Gallery" class="w-full h-full object-cover hover:scale-110 transition-transform"/>
                        </div>
                        <div class="aspect-square bg-gray-200 rounded overflow-hidden">
                            <img src="/api/placeholder/150/150" alt="Gallery" class="w-full h-full object-cover hover:scale-110 transition-transform"/>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Management -->
            <div class="mt-8">
                <h2 class="text-lg sm:text-xl font-montserrat-48 text-gray-900 font-semibold mb-4">TIM MONTIR</h2>
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Team Member Cards -->
                        <div class="text-center">
                            <div class="w-20 h-20 bg-gray-300 rounded-full mx-auto mb-2"></div>
                            <h4 class="text-sm defparagraf font-semibold text-[#0F044C]">Ahmad Montir</h4>
                            <p class="text-xs defparagraf text-[#787A91]">Senior Technician</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.dashboard-layout>