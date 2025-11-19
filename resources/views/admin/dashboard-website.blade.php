<!-- WEBSITE DASHBOARD MODE -->
<div id="websiteDashboard" class="dashboard-mode" data-mode="website">
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
    <!-- Hero / Header -->
    <div class="bg-gradient-to-br from-[#0F044C] via-[#1D2C90] to-[#192BC2] text-white rounded-2xl px-6 py-8 sm:px-8 sm:py-10 shadow-xl relative overflow-hidden">
        <div class="absolute inset-0 opacity-20 pointer-events-none">
            <div class="w-56 h-56 bg-white/10 rounded-full blur-3xl absolute -right-16 top-4"></div>
            <div class="w-40 h-40 bg-white/5 rounded-full blur-3xl absolute -left-10 bottom-0"></div>
        </div>
        <div class="relative flex flex-col md:flex-row items-start md:items-center gap-6">
            <div class="flex-1">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-montserrat-48 font-bold leading-tight">Dashboard Website</h1>
                <p class="mt-3 text-sm sm:text-base text-white/80 defparagraf max-w-3xl">
                    Kelola konten, artikel, galeri, dan tim montir website dari satu tempat yang terpusat.
                </p>
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.artikel.index') }}" class="px-5 py-3 bg-white text-[#0F044C] rounded-xl font-semibold defparagraf text-center shadow-lg hover:shadow-xl transition-all duration-200">Kelola Artikel</a>
                    <a href="#" class="px-5 py-3 border border-white/30 text-white rounded-xl font-semibold defparagraf text-center hover:bg-white/10 transition-all duration-200">Kelola Galeri</a>
                    <a href="#" class="px-5 py-3 border border-white/30 text-white rounded-xl font-semibold defparagraf text-center hover:bg-white/10 transition-all duration-200">Kelola Montir</a>
                </div>
            </div>
            <div class="w-full md:w-auto">
                <div class="bg-white/15 border border-white/20 rounded-2xl px-6 py-5 backdrop-blur-sm shadow-lg min-w-[240px]">
                    <p class="text-xs uppercase tracking-[0.3em] text-white/70">Status Sistem</p>
                    <p class="text-3xl font-bold mt-2"><span id="status-time-web">{{ now()->locale('id')->translatedFormat('H:i:s') }}</span></p>
                    <p class="text-white/70 text-sm">Terakhir diakses • <span id="status-date-web">{{ now()->locale('id')->translatedFormat('d F Y') }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Website Statistics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <!-- Total Articles -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
            <p class="bigparafraf font-semibold text-black mb-4">Total Artikel</p>
            <div class="flex items-center gap-4">
                <!-- Inner Box untuk Value -->
                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">45</p>
                </div>
                <!-- SVG Icon -->
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-[#1D2C90]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14l4-4h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Gallery Photos -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
            <p class="bigparafraf font-semibold text-black mb-4">Foto Galeri</p>
            <div class="flex items-center gap-4">
                <!-- Inner Box untuk Value -->
                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">128</p>
                </div>
                <!-- SVG Icon -->
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-[#1D2C90]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4 3a2 2 0 0 0-2 2v14l4-4h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm12 12H4l4-8l3 6l2-4l3 6z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Team Members -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
            <p class="bigparafraf font-semibold text-black mb-4">Tim Montir</p>
            <div class="flex items-center gap-4">
                <!-- Inner Box untuk Value -->
                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">8</p>
                </div>
                <!-- SVG Icon -->
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-[#1D2C90]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <circle cx="12" cy="8" r="5"/>
                            <path d="M20 21a8 8 0 0 0-16 0"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Page Views -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
            <p class="bigparafraf font-semibold text-black mb-4">Visitor Bulan Ini</p>
            <div class="flex items-center gap-4">
                <!-- Inner Box untuk Value -->
                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">2.5K</p>
                </div>
                <!-- SVG Icon -->
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-[#1D2C90]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Website Content Management Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6">
        <!-- Recent Articles -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-4 md:p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-montserrat-48 font-bold text-[#0F044C]">Artikel Terbaru</h3>
                <a href="{{ route('admin.artikel.index') }}" class="text-sm text-[#0F044C] hover:underline">lihat semua</a>
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
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-4 md:p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-montserrat-48 font-bold text-[#0F044C]">Galeri Terbaru</h3>
                <a href="#" class="text-sm text-[#0F044C] hover:underline">lihat semua</a>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <!-- Gallery Thumbnails -->
                <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                    <img src="/api/placeholder/150/150" alt="Gallery" class="w-full h-full object-cover hover:scale-110 transition-transform"/>
                </div>
                <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                    <img src="/api/placeholder/150/150" alt="Gallery" class="w-full h-full object-cover hover:scale-110 transition-transform"/>
                </div>
                <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                    <img src="/api/placeholder/150/150" alt="Gallery" class="w-full h-full object-cover hover:scale-110 transition-transform"/>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Management -->
    <div>
        <h2 class="text-lg sm:text-xl font-montserrat-48 text-gray-900 font-bold mb-4">TIM MONTIR</h2>
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-4 md:p-5">
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

