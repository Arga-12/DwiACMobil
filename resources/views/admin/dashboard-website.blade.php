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
                    Kelola konten, artikel, galeri, dan operasional website dari satu tempat yang terpusat.
                </p>
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.artikel.index') }}" class="px-5 py-3 bg-white text-[#0F044C] rounded-xl font-semibold defparagraf text-center shadow-lg hover:shadow-xl transition-all duration-200">Kelola Artikel</a>
                    <a href="{{ route('admin.galeri.index') }}" class="px-5 py-3 border border-white/30 text-white rounded-xl font-semibold defparagraf text-center hover:bg-white/10 transition-all duration-200">Kelola Galeri</a>
                    <a href="{{ route('admin.ratings.index') }}" class="px-5 py-3 border border-white/30 text-white rounded-xl font-semibold defparagraf text-center hover:bg-white/10 transition-all duration-200">Kelola Rating</a>
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
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">{{ $websiteStats['articles']['total'] ?? 0 }}</p>
                    <p class="text-xs text-gray-600 mt-1">{{ $websiteStats['articles']['published'] ?? 0 }} published</p>
                </div>
                <!-- SVG Icon -->
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-[#1D2C90]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M3 10c0-3.771 0-5.657 1.172-6.828S7.229 2 11 2h2c3.771 0 5.657 0 6.828 1.172S21 6.229 21 10v4c0 3.771 0 5.657-1.172 6.828S16.771 22 13 22h-2c-3.771 0-5.657 0-6.828-1.172S3 17.771 3 14z"/>
                            <path d="M6 12c0-1.414 0-2.121.44-2.56C6.878 9 7.585 9 9 9h6c1.414 0 2.121 0 2.56.44c.44.439.44 1.146.44 2.56v4c0 1.414 0 2.121-.44 2.56c-.439.44-1.146.44-2.56.44H9c-1.414 0-2.121 0-2.56-.44C6 18.122 6 17.415 6 16z"/>
                            <path stroke-linecap="round" d="M7 6h5"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Gallery Images -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
            <p class="bigparafraf font-semibold text-black mb-4">Galeri Foto</p>
            <div class="flex items-center gap-4">
                <!-- Inner Box untuk Value -->
                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">{{ $websiteStats['gallery']['total'] ?? 0 }}</p>
                    <p class="text-xs text-gray-600 mt-1">{{ $websiteStats['gallery']['recent_count'] ?? 0 }} bulan ini</p>
                </div>
                <!-- SVG Icon -->
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-[#1D2C90]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M2 14c0-3.771 0-5.657 1.172-6.828S6.229 6 10 6h4c3.771 0 5.657 0 6.828 1.172S22 10.229 22 14s0 5.657-1.172 6.828S17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.172S2 17.771 2 14Z"/>
                            <path d="m4 7l-.012-1c.112-.931.347-1.574.837-2.063C5.765 3 7.279 3 10.307 3h3.211c3.028 0 4.541 0 5.482.937c.49.489.725 1.132.837 2.063v1"/>
                            <circle cx="17.5" cy="10.5" r="1.5"/>
                            <path stroke-linecap="round" d="m2 14.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 20.5"/>
                        </g>
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
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">{{ $websiteStats['team']['total'] ?? 0 }}</p>
                    <p class="text-xs text-gray-600 mt-1">{{ $websiteStats['team']['active'] ?? 0 }} aktif</p>
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

        <!-- Website Ratings -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
            <p class="bigparafraf font-semibold text-black mb-4">Rating Website</p>
            <div class="flex items-center gap-4">
                <!-- Inner Box untuk Value -->
                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">{{ $websiteStats['ratings']['average_rating'] ?? '0' }}/5</p>
                    <p class="text-xs text-gray-600 mt-1">{{ $websiteStats['ratings']['total_ratings'] ?? 0 }} rating</p>
                </div>
                <!-- SVG Icon -->
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-[#1D2C90]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m12 18.26l-7.053 3.948l1.575-7.928L.588 8.792l8.027-.952L12 .5l3.385 7.34l8.027.952l-5.934 5.488l1.575 7.928z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles & Gallery Row -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 lg:gap-6">
        <!-- Recent Articles -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg sm:text-xl font-montserrat-48 text-gray-900 font-bold">ARTIKEL TERBARU</h3>
                <a href="{{ route('admin.artikel.index') }}" class="text-sm text-[#0F044C] hover:underline">kelola artikel</a>
            </div>
            <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-4 md:p-5 min-h-[400px] flex flex-col">
                @if($websiteStats['articles']['recent']->count() > 0)
                    <div class="space-y-4">
                        @foreach($websiteStats['articles']['recent'] as $article)
                        <div class="flex items-start gap-4 p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                            <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-[#0F044C] to-[#1D2C90] rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M3 10c0-3.771 0-5.657 1.172-6.828S7.229 2 11 2h2c3.771 0 5.657 0 6.828 1.172S21 6.229 21 10v4c0 3.771 0 5.657-1.172 6.828S16.771 22 13 22h-2c-3.771 0-5.657 0-6.828-1.172S3 17.771 3 14z"/>
                                        <path d="M6 12c0-1.414 0-2.121.44-2.56C6.878 9 7.585 9 9 9h6c1.414 0 2.121 0 2.56.44c.44.439.44 1.146.44 2.56v4c0 1.414 0 2.121-.44 2.56c-.439.44-1.146.44-2.56.44H9c-1.414 0-2.121 0-2.56-.44C6 18.122 6 17.415 6 16z"/>
                                        <path stroke-linecap="round" d="M7 6h5"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm defparagraf font-semibold text-[#0F044C] mb-1">{{ $article['judul'] }}</h4>
                                <p class="text-xs defparagraf text-[#787A91] mb-2">{{ $article['updated_at']->diffForHumans() }}</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs px-2 py-0.5 rounded {{ $article['status'] === 'Published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ $article['status'] }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex-1 flex items-center justify-center">
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M3 10c0-3.771 0-5.657 1.172-6.828S7.229 2 11 2h2c3.771 0 5.657 0 6.828 1.172S21 6.229 21 10v4c0 3.771 0 5.657-1.172 6.828S16.771 22 13 22h-2c-3.771 0-5.657 0-6.828-1.172S3 17.771 3 14z"/>
                                    <path d="M6 12c0-1.414 0-2.121.44-2.56C6.878 9 7.585 9 9 9h6c1.414 0 2.121 0 2.56.44c.44.439.44 1.146.44 2.56v4c0 1.414 0 2.121-.44 2.56c-.439.44-1.146.44-2.56.44H9c-1.414 0-2.121 0-2.56-.44C6 18.122 6 17.415 6 16z"/>
                                    <path stroke-linecap="round" d="M7 6h5"/>
                                </g>
                            </svg>
                            <h5 class="text-gray-600 font-semibold mb-2">Belum Ada Artikel</h5>
                            <p class="text-gray-500 text-sm mb-4">Mulai buat artikel pertama Anda untuk berbagi informasi berguna.</p>
                            <a href="{{ route('admin.artikel.create') }}" class="inline-flex items-center px-4 py-2 bg-[#0F044C] text-white rounded-lg hover:bg-[#1D2C90] transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                                </svg>
                                Buat Artikel
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Gallery Preview -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg sm:text-xl font-montserrat-48 text-gray-900 font-bold">GALERI TERBARU</h3>
                <a href="{{ route('admin.galeri.index') }}" class="text-sm text-[#0F044C] hover:underline">kelola galeri</a>
            </div>
            <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-4 md:p-5 min-h-[400px] flex flex-col">
                @if($websiteStats['gallery']['recent_images']->count() > 0)
                    <div class="grid grid-cols-2 gap-3 overflow-y-auto max-h-[360px]">
                        @foreach($websiteStats['gallery']['recent_images'] as $image)
                        <div class="group relative aspect-square rounded-lg overflow-hidden border border-gray-100 hover:border-[#1D2C90]/30 transition-all hover:shadow-md">
                            @if($image['image'])
                                <img src="{{ asset('storage/' . $image['image']) }}" alt="{{ $image['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200" onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-gray-200 flex items-center justify-center\'><svg class=\'w-8 h-8 text-gray-400\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\'><g fill=\'none\' stroke=\'currentColor\' stroke-width=\'1.5\'><path d=\'M2 14c0-3.771 0-5.657 1.172-6.828S6.229 6 10 6h4c3.771 0 5.657 0 6.828 1.172S22 10.229 22 14s0 5.657-1.172 6.828S17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.172S2 17.771 2 14Z\'/><circle cx=\'17.5\' cy=\'10.5\' r=\'1.5\'/><path stroke-linecap=\'round\' d=\'m2 14.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 20.5\'/></g></svg></div>';">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M2 14c0-3.771 0-5.657 1.172-6.828S6.229 6 10 6h4c3.771 0 5.657 0 6.828 1.172S22 10.229 22 14s0 5.657-1.172 6.828S17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.172S2 17.771 2 14Z"/>
                                            <circle cx="17.5" cy="10.5" r="1.5"/>
                                            <path stroke-linecap="round" d="m2 14.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 20.5"/>
                                        </g>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-end p-2">
                                <p class="text-white text-xs font-medium truncate w-full">{{ $image['name'] ?: 'Foto Galeri' }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex-1 flex items-center justify-center">
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M2 14c0-3.771 0-5.657 1.172-6.828S6.229 6 10 6h4c3.771 0 5.657 0 6.828 1.172S22 10.229 22 14s0 5.657-1.172 6.828S17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.172S2 17.771 2 14Z"/>
                                    <circle cx="17.5" cy="10.5" r="1.5"/>
                                    <path stroke-linecap="round" d="m2 14.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 20.5"/>
                                </g>
                            </svg>
                            <p class="text-gray-500 text-sm mb-3">Belum ada foto di galeri</p>
                            <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center px-3 py-1.5 text-sm bg-[#0F044C] text-white rounded-lg hover:bg-[#1D2C90] transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                                </svg>
                                Upload Foto
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Customer Ratings Section -->
    <div>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg sm:text-xl font-montserrat-48 text-gray-900 font-bold">RATING PARA PELANGGAN</h2>
        </div>
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-4 md:p-5">
            @if(!empty($customerReviews) && count($customerReviews) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                    @foreach($customerReviews as $review)
                    <div class="group bg-gradient-to-br from-white to-gray-50 rounded-lg border border-[#0F044C]/10 p-4 hover:shadow-md hover:border-[#1D2C90]/30 transition-all relative" id="review-{{ $review['id'] ?? 'unknown' }}">
                        <!-- Delete Button -->
                        <button onclick="deleteReview({{ $review['id'] ?? 0 }}, '{{ $review['name'] }}')"
                                class="absolute top-2 right-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-full p-1 transition-colors duration-200">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9zM4 5a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM6 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        <!-- Customer Info -->
                        <div class="flex items-center gap-2 mb-3">
                            <img src="{{ $review['image'] }}" alt="{{ $review['name'] }}" class="w-10 h-10 rounded-full object-cover border-2 border-[#1D2C90]/20">
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm defparagraf font-bold text-[#0F044C] truncate">{{ $review['name'] }}</h4>
                                <div class="flex items-center gap-0.5">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-3 h-3 {{ $i <= $review['rating'] ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                    <span class="text-xs font-semibold text-[#1D2C90] ml-1">{{ $review['rating'] }}/5</span>
                                </div>
                            </div>
                        </div>

                        <!-- Review Text -->
                        <p class="text-xs defparagraf text-[#787A91] mb-2 leading-relaxed line-clamp-3">{{ $review['text'] }}</p>

                        <!-- Date -->
                        <div class="pt-2 border-t border-gray-200">
                            <span class="text-xs text-gray-500">{{ $review['date'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m12 18.26l-7.053 3.948l1.575-7.928L.588 8.792l8.027-.952L12 .5l3.385 7.34l8.027.952l-5.934 5.488l1.575 7.928z"/>
                    </svg>
                    <h5 class="text-gray-600 font-semibold mb-2">Belum Ada Rating</h5>
                    <p class="text-gray-500 text-sm mb-3">Rating dari pelanggan akan ditampilkan di sini.</p>
                    <a href="{{ route('beranda') }}" class="inline-flex items-center px-3 py-1.5 text-sm bg-[#0F044C] text-white rounded-lg hover:bg-[#1D2C90] transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                        </svg>
                        Lihat Website
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<scr
ipt>
function deleteReview(reviewId, reviewName) {
    if (!reviewId || reviewId === 0) {
        alert('ID review tidak valid');
        return;
    }
    
    if (confirm('Apakah Anda yakin ingin menghapus review dari ' + reviewName + '?')) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/ratings/' + reviewId;
        
        // CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);
        
        // Method spoofing for DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
