<x-layout :showHeader="true" :showHero="true" title="Beranda - Dwi AC Mobil">
    <!-- Section Layanan -->
    <section class="py-16 md:py-20 bg-white">
        <div class="mx-auto px-16 sm:px-20 lg:px-24 w-full">
            <!-- Title with Underline -->
            <div class="flex flex-col items-center mb-12">
                <h2 class="font-montserrat-48 text-black mb-2">LAYANAN KAMI</h2>
                <p class="defparagraf text-black/70 text-center max-w-lg mb-4">Solusi lengkap perawatan AC mobil dengan teknisi berpengalaman dan peralatan modern untuk kenyamanan berkendara Anda</p>
                <div class="w-[128px] h-1 bg-[#0F044C]"></div>
            </div>

            @php
                $services = [
                    ['title' => 'Isi Freon', 'desc' => 'Mengisi ulang freon pada sistem AC mobil yang kurang atau habis agar AC kembali dingin dan bekerja optimal.', 'img' => asset('images/layanan/isi-freon.png')],
                    ['title' => 'Cuci Evaporator', 'desc' => 'Membersihkan evaporator dari kotoran dan jamur agar udara lebih bersih dan dingin.', 'img' => asset('images/layanan/cuci-evap.png')],
                    ['title' => 'Flushing Sistem AC', 'desc' => 'Pembersihan menyeluruh sistem AC mobil untuk menghilangkan kotoran dan endapan yang mengganggu kinerja pendinginan.', 'img' => asset('images/layanan/flushing-ac.png')],
                    ['title' => 'Ganti Oli Kompresor', 'desc' => 'Penggantian oli kompresor AC mobil untuk menjaga pelumasan dan kinerja optimal kompresor sistem pendingin.', 'img' => asset('images/layanan/ganti-oli.png')],
                    ['title' => 'Ganti Dryer', 'desc' => 'Penggantian filter dryer/receiver untuk menyaring kelembaban dan kotoran dalam sistem AC mobil.', 'img' => asset('images/layanan/ganti-dryer.png')],
                ];
            @endphp

            <!-- Carousel Container -->
            <div class="relative mx-auto">
                <!-- Cards Wrapper with Strict Clipping -->
                <div class="overflow-hidden relative" id="service-scroller" style="width: 100%;">
                    <div class="flex transition-transform duration-500 ease-in-out" id="service-track" style="width: 100%;">
                        @foreach($services as $index => $service)
                        <!-- Service Card -->
                        <div class="w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                            <article class="group bg-white rounded-3xl border-2 border-[#0F044C] overflow-hidden h-full flex flex-col hover:duration-300">
                                <!-- Image Container with Hover Overlay -->
                                <div class="relative overflow-hidden">
                                    <img src="{{ $service['img'] }}" alt="{{ $service['title'] }}" class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105" />
                                    
                                    <!-- Hover Overlay with Button -->
                                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <a href="{{ route('layanan.detail') }}" class="bg-white text-black px-6 py-3 rounded-xl font-semibold inline-flex items-center gap-2 hover:bg-gray-100 transition transform translate-y-4 group-hover:translate-y-0 duration-300">
                                            <span class="defparagraf">Selengkapnya</span>
                                            <span aria-hidden="true">→</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Divider Line -->
                                <div class="h-0.5 bg-[#0F044C]"></div>

                                <!-- Likes & Comments Section -->
                                <div class="grid grid-cols-1 px-6 py-3 border-b border-[#0F044C]/10">
                                    <!-- Likes -->
                                    <div class="flex items-center gap-2">
                                        @if(!($service['liked'] ?? false))
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48" class="text-[#0F044C]">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M15 8C8.925 8 4 12.925 4 19c0 11 13 21 20 23.326C31 40 44 30 44 19c0-6.075-4.925-11-11-11c-3.72 0-7.01 1.847-9 4.674A10.99 10.99 0 0 0 15 8"/>
                                        </svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48" class="text-[#0F044C]">
                                            <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M15 8C8.925 8 4 12.925 4 19c0 11 13 21 20 23.326C31 40 44 30 44 19c0-6.075-4.925-11-11-11c-3.72 0-7.01 1.847-9 4.674A10.99 10.99 0 0 0 15 8"/>
                                        </svg>
                                        @endif
                                        <span class="defparagraf text-[#0F044C]">likes</span>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-6 flex flex-col flex-grow">
                                    <h3 class="bigparagraf mb-3">{{ $service['title'] }}</h3>
                                    <p class="defparagraf text-black/70 line-clamp-3">{{ $service['desc'] }}</p>
                                </div>
                            </article>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Carousel Navigation Buttons -->
                <div class="flex items-center justify-center gap-4 mt-8">
                    <button id="carousel-prev" type="button" aria-label="Sebelumnya" class="inline-flex items-center justify-center transition-all duration-300 disabled:opacity-30 disabled:cursor-not-allowed hover:scale-110">
                        <img src="/images/arrows_button/panahkiri.svg" alt="Sebelumnya" class="w-8 h-8" />
                    </button>
                    
                    <!-- Horizontal Line -->
                    <div class="w-full h-[2.3px] bg-[#0F044C]"></div>
                    
                    <button id="carousel-next" type="button" aria-label="Selanjutnya" class="inline-flex items-center justify-center transition-all duration-300 disabled:opacity-30 disabled:cursor-not-allowed hover:scale-110">
                        <img src="/images/arrows_button/panahkanan.svg" alt="Selanjutnya" class="w-8 h-8" />
                    </button>
                </div>
            </div>


                <script>
                    (function(){
                        var track = document.getElementById('service-track');
                        var scroller = document.getElementById('service-scroller');
                        var prev = document.getElementById('carousel-prev');
                        var next = document.getElementById('carousel-next');
                        if(!track || !prev || !next) return;

                        var currentIndex = 0;
                        var totalCards = {{ count($services) }};
                        var cardsPerView = 3; // Max 3 cards per slide

                        // Get cards per view based on screen size (max 3)
                        function getCardsPerView() {
                            var width = window.innerWidth;
                            if (width < 768) return 1; // Mobile: 1 card
                            if (width < 1024) return 2; // Tablet: 2 cards
                            return 3; // Desktop: 3 cards (max)
                        }

                        // Calculate max slides
                        function getMaxSlides() {
                            cardsPerView = getCardsPerView();
                            return Math.ceil(totalCards / cardsPerView);
                        }

                        // Calculate how many cards to show on current slide
                        function getCardsOnCurrentSlide() {
                            cardsPerView = getCardsPerView();
                            var remainingCards = totalCards - (currentIndex * cardsPerView);
                            return Math.min(cardsPerView, remainingCards);
                        }

                        function updateCarousel(){
                            cardsPerView = getCardsPerView();
                            var maxSlides = getMaxSlides();
                            var cardsOnSlide = getCardsOnCurrentSlide();
                            
                            // Calculate base offset
                            var cardWidth = 100 / cardsPerView; // Width of each card in percentage
                            var offset = -currentIndex * cardsPerView * cardWidth;
                            
                            // If on last slide with fewer cards, adjust offset to center them
                            if (cardsOnSlide < cardsPerView && currentIndex === maxSlides - 1) {
                                // Calculate centering offset
                                var emptySpace = (cardsPerView - cardsOnSlide) * cardWidth;
                                offset += emptySpace / 2; // Add half of empty space to center
                            }
                            
                            track.style.transform = 'translateX(' + offset + '%)';
                            
                            // Update button states
                            prev.disabled = currentIndex === 0;
                            next.disabled = currentIndex >= maxSlides - 1;
                        }

                        function nextSlide(){
                            var maxSlides = getMaxSlides();
                            if(currentIndex < maxSlides - 1) {
                                currentIndex++;
                                updateCarousel();
                            }
                        }

                        function prevSlide(){
                            if(currentIndex > 0) {
                                currentIndex--;
                                updateCarousel();
                            }
                        }

                        // Manual navigation
                        prev.addEventListener('click', function(){
                            prevSlide();
                        });

                        next.addEventListener('click', function(){
                            nextSlide();
                        });

                        // Handle window resize
                        var resizeTimeout;
                        window.addEventListener('resize', function(){
                            clearTimeout(resizeTimeout);
                            resizeTimeout = setTimeout(function(){
                                // Reset to first slide on resize
                                currentIndex = 0;
                                updateCarousel();
                            }, 250);
                        });

                        // Initialize
                        updateCarousel();
                    })();
                </script>
            </div>
        </div>
    </section>

    <!-- Section Testimonial & Kalender -->
    <section id="antrian" class="py-12 md:py-16 bg-[#0F044C] flex items-center justify-center">
        <div class="mx-auto px-16 sm:px-20 lg:px-24 w-full">
            @php
                $reviews = [
                    [
                        'name' => 'Hirasawa Yui',
                        'rating' => 5,
                        'image' => asset('images/review/example.jpg'),
                        'text' => 'AC mobil saya yang tadinya tidak dingin, sekarang sudah dingin kembali. Pelayanan cepat, hanya 2 jam selesai!'
                    ],
                    [
                        'name' => 'Tainaka Ritsu',
                        'rating' => 5,
                        'image' => asset('images/review/example1.jpg'),
                        'text' => 'Bau tidak sedap di AC mobil hilang setelah cuci evaporator. Sekarang udara di mobil segar seperti baru!'
                    ],
                    [
                        'name' => 'Akiyama Mio',
                        'rating' => 4,
                        'image' => asset('images/review/example2.jpg'),
                        'text' => 'Freon bocor sudah diperbaiki dengan baik. Proses pengerjaan sekitar 3 jam. Recommended!'
                    ],
                    [
                        'name' => 'Kotobuki Tsumugi',
                        'rating' => 5,
                        'image' => asset('images/review/example3.jpg'),
                        'text' => 'Evaporator kotor sudah dibersihkan, sekarang udara AC segar dan tidak bau lagi. Teknisinya ramah dan profesional!'
                    ],
                    [
                        'name' => 'Nakano Azusa',
                        'rating' => 4,
                        'image' => asset('images/review/example4.jpg'),
                        'text' => 'AC yang berisik sudah diperbaiki, sekarang lebih dingin dan tenang. Harga juga terjangkau, puas dengan hasilnya!'
                    ],
                ];
            @endphp
            
            <!-- 2 Column Layout: Testimonial Left, Calendar Right -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 w-full mx-auto">
                
                <!-- LEFT: Testimonial Section -->
                <div class="flex flex-col">
                    <!-- Header with Skewed Background -->
                    <div class="relative mb-8">
                        <h3 class="font-montserrat-48 tracking-wide text-white mb-2">TESTIMONIAL</h3>
                        <div class="w-[128px] h-1 bg-white"></div>
                    </div>
                    
                    <!-- Subtitle -->
                    <p class="defparagraf text-white/80 mb-8">Kepercayaan pelanggan adalah prioritas kami</p>
                    
                    <!-- Profile Images Row -->
                    <div class="flex items-center gap-4 mb-8" id="review-profiles">
                        @foreach($reviews as $index => $review)
                        <img src="{{ $review['image'] }}" alt="{{ $review['name'] }}" class="w-16 h-16 rounded-full object-cover border-2 transition-all duration-300 {{ $index === 0 ? 'border-white scale-110' : 'border-white/40' }}" data-review-index="{{ $index }}" />
                        @endforeach
                    </div>
                    
                    <!-- Review Card -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                        <!-- Quote Icon -->
                        <div class="text-white/40 text-6xl font-serif mb-4">&ldquo;</div>
                        
                        <!-- Review Content -->
                        <div class="mb-6">
                            <h4 class="bigparagraf font-bold text-white mb-2" id="review-name">{{ $reviews[0]['name'] }}</h4>
                            <p class="defparagraf text-white/90 italic mb-1">Happy Client</p>
                            <p class="defparagraf text-white/80 leading-relaxed" id="review-text">{{ $reviews[0]['text'] }}</p>
                        </div>
                        
                        <!-- Star Rating -->
                        <div class="flex items-center gap-1 mb-4" id="review-stars">
                            @for($i = 1; $i <= 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="{{ $i <= $reviews[0]['rating'] ? '#fff042' : '#ffffff40' }}" fill-rule="evenodd" d="M12.908 1.581a1 1 0 0 0-1.816 0l-2.87 6.22l-6.801.807a1 1 0 0 0-.562 1.727l5.03 4.65l-1.335 6.72a1 1 0 0 0 1.469 1.067L12 19.426l5.977 3.346a1 1 0 0 0 1.47-1.068l-1.335-6.718l5.029-4.651a1 1 0 0 0-.562-1.727L15.777 7.8z" clip-rule="evenodd"/>
                            </svg>
                            @endfor
                        </div>
                        
                        <!-- Carousel Dots -->
                        <div class="flex items-center gap-2" id="review-dots">
                            @foreach($reviews as $index => $review)
                            <div class="w-2 h-2 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-white/40' }}"></div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Carousel Navigation -->
                    <div class="bg-white rounded-xl p-3 mt-2">
                        <div class="flex items-center gap-4">
                            <button id="review-prev" type="button" aria-label="Review Sebelumnya" class="inline-flex items-center justify-center transition-all duration-300 disabled:opacity-30 disabled:cursor-not-allowed hover:scale-110">
                                <img src="/images/arrows_button/panahkiri.svg" alt="Sebelumnya" class="w-8 h-8" />
                            </button>
                            
                            <!-- Horizontal Line -->
                            <div class="w-full h-[2.3px] bg-[#0F044C]"></div>
                            
                            <button id="review-next" type="button" aria-label="Review Selanjutnya" class="inline-flex items-center justify-center transition-all duration-300 disabled:opacity-30 disabled:cursor-not-allowed hover:scale-110">
                                <img src="/images/arrows_button/panahkanan.svg" alt="Selanjutnya" class="w-8 h-8" />
                            </button>
                        </div>
                    </div>
                    
                    <script>
                        (function(){
                            var reviews = @json($reviews);
                            var currentReviewIndex = 0;
                            var prevBtn = document.getElementById('review-prev');
                            var nextBtn = document.getElementById('review-next');
                            
                            if(!prevBtn || !nextBtn || !reviews || reviews.length === 0) return;
                            
                            function updateReview() {
                                var review = reviews[currentReviewIndex];
                                
                                // Update review content
                                var nameEl = document.getElementById('review-name');
                                var textEl = document.getElementById('review-text');
                                if(nameEl) nameEl.textContent = review.name;
                                if(textEl) textEl.textContent = review.text;
                                
                                // Update star rating
                                var starsEl = document.getElementById('review-stars');
                                if(starsEl) {
                                    var stars = starsEl.querySelectorAll('svg path');
                                    stars.forEach(function(star, i) {
                                        star.setAttribute('fill', (i + 1) <= review.rating ? '#fff042' : '#ffffff40');
                                    });
                                }
                                
                                // Update dots
                                var dotsEl = document.getElementById('review-dots');
                                if(dotsEl) {
                                    var dots = dotsEl.querySelectorAll('div');
                                    dots.forEach(function(dot, i) {
                                        if(i === currentReviewIndex) {
                                            dot.className = 'w-2 h-2 rounded-full bg-white';
                                        } else {
                                            dot.className = 'w-2 h-2 rounded-full bg-white/40';
                                        }
                                    });
                                }
                                
                                // Update profile images
                                var profilesEl = document.getElementById('review-profiles');
                                if(profilesEl) {
                                    var images = profilesEl.querySelectorAll('img');
                                    images.forEach(function(img, i) {
                                        if(i === currentReviewIndex) {
                                            img.className = 'w-16 h-16 rounded-full object-cover border-2 transition-all duration-300 border-white scale-110';
                                        } else {
                                            img.className = 'w-16 h-16 rounded-full object-cover border-2 transition-all duration-300 border-white/40';
                                        }
                                    });
                                }
                                
                                // Update button states
                                prevBtn.disabled = currentReviewIndex === 0;
                                nextBtn.disabled = currentReviewIndex === reviews.length - 1;
                            }
                            
                            function nextReview() {
                                if(currentReviewIndex < reviews.length - 1) {
                                    currentReviewIndex++;
                                    updateReview();
                                }
                            }
                            
                            function prevReview() {
                                if(currentReviewIndex > 0) {
                                    currentReviewIndex--;
                                    updateReview();
                                }
                            }
                            
                            // Event listeners
                            prevBtn.addEventListener('click', prevReview);
                            nextBtn.addEventListener('click', nextReview);
                            
                            // Initialize
                            updateReview();
                        })();
                    </script>
                </div>
                
                <!-- RIGHT: Kalender Antrian Section -->
                <div class="flex flex-col">
                    <!-- Header with Skewed Background -->
                    <div class="relative mb-8">
                        <h3 class="font-montserrat-48 tracking-wide text-white">KALENDER ANTRIAN</h3>
                        <div class="w-[128px] h-1 bg-white"></div>
                    </div>
                    
                    <!-- Subtitle -->
                    <p class="defparagraf text-white/80 mb-8">Berikut adalah tanggal antrian pada booking servis Dwi AC mobil</p>
                    
                    <!-- Calendar Container -->
                    <div class="bg-white border border-gray-300 rounded-xl overflow-hidden">
                    <!-- Calendar Header with Days -->
                    <div class="w-full px-6 py-4">
                        @php
                            $monthParam = request('month');
                            $current = $monthParam ? \Carbon\Carbon::createFromFormat('Y-m', $monthParam)->startOfMonth() : \Carbon\Carbon::now()->startOfMonth();
                            $prev = $current->copy()->subMonth();
                            $next = $current->copy()->addMonth();
                            $monthNames = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                            $monthLabel = strtoupper($monthNames[$current->month]).' '.$current->year;

                            // Konfigurasi status tanggal
                            $holidays = [1, 17]; // contoh: tanggal 1 dan 17 sebagai hari libur
                            $booked = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 18, 19, 20, 21, 22, 23, 24];   // contoh: tanggal 12 dan 20 sudah terbooking

                            $firstDay = $current->copy();
                            $lastDay = $current->copy()->endOfMonth();
                            // 1=Senin .. 7=Minggu; kita skip Minggu, jadi leading blanks hitung dari Senin
                            $leadingBlanks = $firstDay->isSunday() ? 0 : ($firstDay->dayOfWeekIso - 1);
                        @endphp
                        <!-- Month and Navigation -->
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-montserrat-36 text-black">{{ $monthLabel }}</h3>
                            <div class="flex items-center gap-4">
                                <a href="{{ route('beranda', ['month' => $prev->format('Y-m')]) }}#antrian" class="w-10 h-10 rounded-full bg-gray-300 hover:bg-gray-400 transition flex items-center justify-center" aria-label="Sebelumnya">
                                    <img src="/images/arrows_button/panahkiri.svg" alt="Sebelumnya" class="w-5 h-5" />
                                </a>
                                <a href="{{ route('beranda', ['month' => $next->format('Y-m')]) }}#antrian" class="w-10 h-10 rounded-full bg-gray-300 hover:bg-gray-400 transition flex items-center justify-center" aria-label="Selanjutnya">
                                    <img src="/images/arrows_button/panahkanan.svg" alt="Selanjutnya" class="w-5 h-5" />
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Calendar Grid -->
                    <div class="">
                        <!-- Combined Header and Date Grid -->
                        <div class="grid grid-cols-6">
                            <!-- Days of Week Header -->
                            <div class="h-10 defparagraf flex items-center justify-center text-gray-700">Senin</div>
                            <div class="h-10 defparagraf flex items-center justify-center text-gray-700">Selasa</div>
                            <div class="h-10 defparagraf flex items-center justify-center text-gray-700">Rabu</div>
                            <div class="h-10 defparagraf flex items-center justify-center text-gray-700">Kamis</div>
                            <div class="h-10 defparagraf flex items-center justify-center text-gray-700">Jumat</div>
                            <div class="h-10 defparagraf flex items-center justify-center text-gray-700">Sabtu</div>
                            @php
                                // Sel kosong di awal bulan agar Senin rata kolom pertama (maks 5 karena grid 6 dan Minggu diskip)
                                $blankCount = min($leadingBlanks, 5);
                            @endphp
                            @for($i = 0; $i < $blankCount; $i++)
                                <div class="h-16 bg-transparent border border-transparent"></div>
                            @endfor
                            
                            @for($day = 1; $day <= $lastDay->day; $day++)
                                @php
                                    $dateObj = $current->copy()->day($day);
                                @endphp
                                @if($dateObj->isSunday())
                                    @continue
                                @endif
                                @php
                                    $status = in_array($day, $booked) ? 'booked' : (in_array($day, $holidays) ? 'holiday' : 'available');
                                    $bgColor = match($status) {
                                        'available' => 'bg-white border border-gray-300',
                                        'booked' => 'bg-gray-400 border border-gray-500',
                                        'holiday' => 'bg-red-200 border border-red-300',
                                        default => 'bg-white border border-gray-300'
                                    };
                                    $textColor = match($status) {
                                        'available' => 'text-black',
                                        'booked' => 'text-gray-700',
                                        'holiday' => 'text-red-800',
                                        default => 'text-black'
                                    };
                                @endphp
                                <div class="h-16 {{ $bgColor }} flex items-center justify-center cursor-pointer hover:opacity-80 transition">
                                    <span class="defparagraf {{ $textColor }}">{{ $day }}</span>
                                </div>
                            @endfor
                        </div>
                    </div>
                    </div>
                    
                    <!-- Legend -->
                    <div class="mt-6 grid grid-cols-3 gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 bg-white border border-gray-300 rounded shrink-0"></div>
                            <span class="defparagraf text-white text-sm">Tersedia</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 bg-gray-400 border border-gray-500 rounded shrink-0"></div>
                            <span class="defparagraf text-white text-sm">Telah ter-booking</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 bg-red-200 border border-red-300 rounded shrink-0"></div>
                            <span class="defparagraf text-white text-sm">Hari libur</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Merk AC Mobil -->
    <section class="py-12 bg-gray-50">
        <div class="mx-auto px-16 sm:px-20 lg:px-24 w-full max-w-7xl">
            <!-- Title -->
            <div class="text-center mb-8">
                <p class="bigparagraf text-[#0F044C]/90 font-bold">MERK AC MOBIL YANG KAMI GUNAKAN</p>
            </div>
        </div>
        
        <!-- Full Width Divider -->
        <div class="w-full h-[1px] bg-[#0F044C]/30 mb-12"></div>
        
        <div class="mx-auto px-16 sm:px-20 lg:px-24 w-full">
            
            <!-- Brand Logos Row -->
            <div class="flex items-center justify-center gap-8 md:gap-12 lg:gap-16 flex-wrap">
                @php
                    $brands = [
                        ['name' => 'Denso', 'logo' => 'denso.png'],
                        ['name' => 'Pokka', 'logo' => 'pokka.png'],
                        ['name' => 'Yaruki', 'logo' => 'yaruki.png'],
                        ['name' => 'Sanden', 'logo' => 'sanden.png'],
                        ['name' => 'Valeo', 'logo' => 'valeo.png'],
                        ['name' => 'Calsonic', 'logo' => 'calsonic.png'],
                    ];
                @endphp
                
                @foreach($brands as $brand)
                <div class="flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 opacity-60 hover:opacity-100">
                    <div class="flex items-center justify-center h-16 w-36">
                        <img src="{{ asset('images/merk/' . $brand['logo']) }}"
                            alt="{{ $brand['name'] }}"
                            class="max-h-full max-w-full object-contain" />
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section Galeri -->
    <section class="py-16 bg-white">
        <div class="mx-auto px-16 sm:px-20 lg:px-24 w-full max-w-8xl">
            <!-- Title with Underline -->
            <div class="flex flex-col items-center mb-12">
                <h2 class="font-montserrat-48 text-black mb-2">AKTIVITAS KAMI</h2>
                <div class="w-[128px] h-1 bg-[#0F044C]"></div>
            </div>

            @php
                $galleryImages = [
                    ['id' => 1, 'image' => '1.jpeg', 'alt' => 'Aktivitas Servis AC 1', 'date' => '1 September 2025'],
                    ['id' => 2, 'image' => '2.jpeg', 'alt' => 'Aktivitas Servis AC 2', 'date' => '5 September 2025'],
                    ['id' => 3, 'image' => '3.jpeg', 'alt' => 'Aktivitas Servis AC 3', 'date' => '10 September 2025'],
                    ['id' => 4, 'image' => '4.jpeg', 'alt' => 'Aktivitas Servis AC 4', 'date' => '15 September 2025'],
                    ['id' => 5, 'image' => '5.jpeg', 'alt' => 'Aktivitas Servis AC 5', 'date' => '20 September 2025'],
                ];
            @endphp

            <!-- Gallery Grid Layout: Center Tallest Pattern -->
            <div class="flex flex-wrap justify-center items-center gap-6">
                <!-- Image 1: Short -->
                <div class="w-full sm:w-[140px] md:w-[160px]">
                    <div class="relative w-full h-[250px] rounded-3xl overflow-hidden border-2 border-black group">
                        <img src="{{ asset('images/galeri/' . $galleryImages[0]['image']) }}" 
                             alt="{{ $galleryImages[0]['alt'] }}" 
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" />
                        
                        <!-- Hover Overlay with Calendar Icon and Date -->
                        <div class="absolute bottom-0 left-0 right-0 bg-white/95 backdrop-blur-sm px-3 py-2 rounded-b-3xl transform translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out">
                            <div class="flex items-center gap-2">
                                <!-- Calendar Icon SVG -->
                                <svg class="w-8 h-8 shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="6" width="18" height="15" rx="2" stroke="#0F044C" stroke-width="2"/>
                                    <path d="M3 10H21" stroke="#0F044C" stroke-width="2"/>
                                    <path d="M7 3V6" stroke="#0F044C" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M17 3V6" stroke="#0F044C" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                <!-- Date Text -->
                                <span class="text-sm font-semibold text-[#0F044C]">{{ $galleryImages[0]['date'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image 2: Medium -->
                <div class="w-full sm:w-[160px] md:w-[180px]">
                    <div class="relative w-full h-[320px] rounded-3xl overflow-hidden border-2 border-black group">
                        <img src="{{ asset('images/galeri/' . $galleryImages[1]['image']) }}" 
                             alt="{{ $galleryImages[1]['alt'] }}" 
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" />
                        
                        <!-- Hover Overlay with Calendar Icon and Date -->
                        <div class="absolute bottom-0 left-0 right-0 bg-white/95 backdrop-blur-sm px-3 py-2 rounded-b-3xl transform translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out">
                            <div class="flex items-center gap-2">
                                <!-- Calendar Icon SVG -->
                                <svg class="w-8 h-8 shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="6" width="18" height="15" rx="2" stroke="#0F044C" stroke-width="2"/>
                                    <path d="M3 10H21" stroke="#0F044C" stroke-width="2"/>
                                    <path d="M7 3V6" stroke="#0F044C" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M17 3V6" stroke="#0F044C" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                <!-- Date Text -->
                                <span class="text-sm font-semibold text-[#0F044C]">{{ $galleryImages[1]['date'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image 3: Tallest (Center) -->
                <div class="w-full sm:w-[180px] md:w-[200px]">
                    <div class="relative w-full h-[400px] rounded-3xl overflow-hidden border-2 border-black group">
                        <img src="{{ asset('images/galeri/' . $galleryImages[2]['image']) }}" 
                             alt="{{ $galleryImages[2]['alt'] }}" 
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" />
                        
                        <!-- Hover Overlay with Calendar Icon and Date -->
                        <div class="absolute bottom-0 left-0 right-0 bg-white/95 backdrop-blur-sm px-3 py-2 rounded-b-3xl transform translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out">
                            <div class="flex items-center gap-2">
                                <!-- Calendar Icon SVG -->
                                <svg class="w-8 h-8 shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="6" width="18" height="15" rx="2" stroke="#0F044C" stroke-width="2"/>
                                    <path d="M3 10H21" stroke="#0F044C" stroke-width="2"/>
                                    <path d="M7 3V6" stroke="#0F044C" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M17 3V6" stroke="#0F044C" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                <!-- Date Text -->
                                <span class="text-sm font-semibold text-[#0F044C]">{{ $galleryImages[2]['date'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image 4: Medium -->
                <div class="w-full sm:w-[160px] md:w-[180px]">
                    <div class="relative w-full h-[320px] rounded-3xl overflow-hidden border-2 border-black group">
                        <img src="{{ asset('images/galeri/' . $galleryImages[3]['image']) }}" 
                             alt="{{ $galleryImages[3]['alt'] }}" 
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" />
                        
                        <!-- Hover Overlay with Calendar Icon and Date -->
                        <div class="absolute bottom-0 left-0 right-0 bg-white/95 backdrop-blur-sm px-3 py-2 rounded-b-3xl transform translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out">
                            <div class="flex items-center gap-2">
                                <!-- Calendar Icon SVG -->
                                <svg class="w-8 h-8 shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="6" width="18" height="15" rx="2" stroke="#0F044C" stroke-width="2"/>
                                    <path d="M3 10H21" stroke="#0F044C" stroke-width="2"/>
                                    <path d="M7 3V6" stroke="#0F044C" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M17 3V6" stroke="#0F044C" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                <!-- Date Text -->
                                <span class="text-sm font-semibold text-[#0F044C]">{{ $galleryImages[3]['date'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image 5: Short -->
                <div class="w-full sm:w-[140px] md:w-[160px]">
                    <div class="relative w-full h-[250px] rounded-3xl overflow-hidden border-2 border-black group">
                        <img src="{{ asset('images/galeri/' . $galleryImages[4]['image']) }}" 
                             alt="{{ $galleryImages[4]['alt'] }}" 
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" />
                        
                        <!-- Hover Overlay with Calendar Icon and Date -->
                        <div class="absolute bottom-0 left-0 right-0 bg-white/95 backdrop-blur-sm px-3 py-2 rounded-b-3xl transform translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out">
                            <div class="flex items-center gap-2">
                                <!-- Calendar Icon SVG -->
                                <svg class="w-8 h-8 shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="6" width="18" height="15" rx="2" stroke="#0F044C" stroke-width="2"/>
                                    <path d="M3 10H21" stroke="#0F044C" stroke-width="2"/>
                                    <path d="M7 3V6" stroke="#0F044C" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M17 3V6" stroke="#0F044C" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                <!-- Date Text -->
                                <span class="text-sm font-semibold text-[#0F044C]">{{ $galleryImages[4]['date'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Montir & Review -->
    <section id="kontak" class="py-12 md:py-16 bg-gray-100 flex items-center justify-center">
        <div class="mx-auto px-16 sm:px-20 lg:px-24 w-full">
            <!-- 2 Column Layout: Montir Kami & Review Form -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                
                <!-- Left Column: MONTIR KAMI -->
                <div>
                    <div class="mb-8">
                        <h2 class="font-montserrat-48 text-black uppercase">MONTIR KAMI</h2>
                        <div class="w-32 h-1 bg-[#0F044C] mt-2"></div>
                    </div>

                    @php
                        $teamMembers = [
                            [
                                'name' => 'DWI MUJIONO',
                                'role' => 'Owner Teknisi',
                                'desc' => 'Dengan pengalaman lebih dari 15 tahun di bidang perbaikan dan perawatan sistem AC mobil.',
                                'image' => asset('images/team/team.jpg'),
                            ],
                            [
                                'name' => 'AGUS WIJAYA',
                                'role' => 'Karyawan Teknisi',
                                'desc' => 'Dengan pengalaman lebih dari 10 tahun di bidang perbaikan dan perawatan sistem AC mobil.',
                                'image' => asset('images/team/team1.jpg'),
                            ],
                        ];
                    @endphp

                    <div class="space-y-10">
                        @foreach($teamMembers as $member)
                            <div class="montir-card group relative flex items-start h-44">
                                <!-- Circular Photo with Name (Default State) -->
                                <div class="relative z-10 shrink-0 flex items-start gap-4">
                                    <div class="w-44 h-44 rounded-full overflow-hidden border-4 border-cyan-400 shadow-lg cursor-pointer">
                                        <img src="{{ $member['image'] }}" 
                                             alt="{{ $member['name'] }}" 
                                             class="w-full h-full object-cover" />
                                    </div>
                                    
                                    <!-- Name & Role (Slide out on Hover) -->
                                    <div class="name-role-box pt-4 transition-all duration-500 ease-in-out">
                                        <h3 class="font-montserrat-36 uppercase text-lg text-black mb-1 leading-tight">{{ $member['name'] }}</h3>
                                        <div class="defparagraf text-sm text-[#0F044C] font-semibold">{{ $member['role'] }}</div>
                                        <div class="defparagraf text-xs text-gray-500 mt-2 italic">Hover untuk detail →</div>
                                    </div>
                                </div>
                                
                                <!-- Profile Card (Slides from right on hover) -->
                                <div class="profile-card absolute left-24 top-0 h-44 flex items-center pointer-events-none transition-all duration-500 ease-in-out" style="transform: translateX(-50px); opacity: 0;">
                                    <div class="bg-[#0F044C] rounded-3xl pl-28 pr-8 py-4 shadow-2xl min-w-[520px] h-full flex items-center">
                                        <!-- Profile Info -->
                                        <div class="text-white flex-1">
                                            <h3 class="font-montserrat-36 uppercase text-xl mb-0.5 border-b-2 border-white pb-0.5 inline-block leading-tight">{{ $member['name'] }}</h3>
                                            <div class="defparagraf text-base font-semibold mb-3">{{ $member['role'] }}</div>
                                            
                                            <!-- Email -->
                                            <div class="flex items-center gap-2 mb-1.5">
                                                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M22 6l-10 7L2 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <span class="defparagraf text-xs">{{ strtolower(str_replace(' ', '', $member['name'])) }}@gmail.com</span>
                                            </div>
                                            
                                            <!-- Phone -->
                                            <div class="flex items-center gap-2 mb-3">
                                                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <span class="defparagraf text-xs">+62 812-3456-{{ $loop->index }}890</span>
                                            </div>
                                            
                                            <!-- Quote -->
                                            <div class="defparagraf text-xs italic text-white/90 leading-relaxed">
                                                "{{ $member['desc'] }}"
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right Column: TULIS REVIEW ANDA -->
                <div>
                    <div class="mb-8">
                        <h2 class="font-montserrat-48 text-black uppercase">TULIS REVIEW ANDA</h2>
                        <div class="w-32 h-1 bg-[#0F044C] mt-2"></div>
                    </div>

                    <!-- Review Form -->
                    <div class="rounded-3xl p-0">
                        @auth
                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Nama -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="review_name" class="block defparagraf text-black mb-2">Nama Lengkap</label>
                                    <input type="text"
                                           id="review_name" 
                                           name="name" 
                                           required
                                           class="w-full px-4 py-3 border-b-2 border-b-[#0F044C]/70 rounded-lg focus:border-b-[#0F044C] focus:outline-none defparagraf"
                                           placeholder="Masukkan nama Anda">
                                </div>
                                <div>
                                    <label for="review_email" class="block defparagraf text-black mb-2">Email</label>
                                    <input type="email" 
                                           id="review_email" 
                                           name="email" 
                                           class="w-full px-4 py-3 border-b-2 border-b-[#0F044C]/70 rounded-lg focus:border-b-[#0F044C] focus:outline-none defparagraf"
                                           placeholder="nama@email.com">
                                </div>
                            </div>

                            <!-- Rating -->
                            <div class="text-center">
                                <label class="block defparagraf text-black mb-2">Rating</label>
                                <style>
                                    .star-rating label svg { fill: #d1d5db; transition: fill .2s ease; }
                                    .star-rating input:checked ~ label svg { fill: #fff042; }
                                    .star-rating label:hover svg, .star-rating label:hover ~ label svg { fill: #fff042; }
                                </style>
                                <div class="star-rating flex gap-2 justify-center flex-row-reverse">
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="rating-{{ $i }}" name="rating" value="{{ $i }}" class="hidden" required>
                                        <label for="rating-{{ $i }}" class="cursor-pointer">
                                            <svg class="w-8 h-8" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <!-- Review Text -->
                            <div>
                                <label for="review_text" class="block defparagraf text-black mb-2">Review Anda</label>
                                <textarea id="review_text" 
                                          name="review" 
                                          rows="6" 
                                          required
                                          class="w-full px-4 py-3 border-b-2 border-b-[#0F044C]/70 rounded-lg focus:border-b-[#0F044C] focus:outline-none defparagraf resize-none"
                                          placeholder="Ceritakan pengalaman Anda dengan layanan kami..."></textarea>
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" 
                                    class="w-full bg-[#0F044C] hover:bg-[#141E61] text-white font-semibold py-3 px-6 rounded-xl transition-colors duration-300 defparagraf">
                                Kirim Review
                            </button>
                        </form>
                        @else
                        <div class="relative rounded-3xl p-0 overflow-hidden">
                            <form action="#" method="POST" class="space-y-6 pointer-events-none select-none">
                                @csrf
                                
                                <!-- Nama -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="review_name" class="block defparagraf text-black mb-2">Nama Lengkap</label>
                                        <input type="text"
                                               id="review_name" 
                                               name="name" 
                                               disabled
                                               class="w-full px-4 py-3 border-b-2 border-b-[#0F044C]/70 rounded-lg focus:border-b-[#0F044C] focus:outline-none defparagraf"
                                               placeholder="Masukkan nama Anda">
                                    </div>
                                    <div>
                                        <label for="review_email" class="block defparagraf text-black mb-2">Email</label>
                                        <input type="email" 
                                               id="review_email" 
                                               name="email" 
                                               disabled
                                               class="w-full px-4 py-3 border-b-2 border-b-[#0F044C]/70 rounded-lg focus:border-b-[#0F044C] focus:outline-none defparagraf"
                                               placeholder="nama@email.com">
                                    </div>
                                </div>

                                <!-- Rating -->
                                <div class="text-center">
                                    <label class="block defparagraf text-black mb-2">Rating</label>
                                    <style>
                                        .star-rating label svg { fill: #d1d5db; transition: fill .2s ease; }
                                        .star-rating input:checked ~ label svg { fill: #fff042; }
                                        .star-rating label:hover svg, .star-rating label:hover ~ label svg { fill: #fff042; }
                                    </style>
                                    <div class="star-rating flex gap-2 justify-center flex-row-reverse">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="rating-{{ $i }}" name="rating" value="{{ $i }}" class="hidden" disabled>
                                            <label for="rating-{{ $i }}" class="cursor-not-allowed">
                                                <svg class="w-8 h-8" viewBox="0 0 24 24">
                                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                </svg>
                                            </label>
                                        @endfor
                                    </div>
                                </div>

                                <!-- Review Text -->
                                <div>
                                    <label for="review_text" class="block defparagraf text-black mb-2">Review Anda</label>
                                    <textarea id="review_text" 
                                              name="review" 
                                              rows="6" 
                                              disabled
                                              class="w-full px-4 py-3 border-b-2 border-b-[#0F044C]/70 rounded-lg focus:border-b-[#0F044C] focus:outline-none defparagraf resize-none"
                                              placeholder="Ceritakan pengalaman Anda dengan layanan kami..."></textarea>
                                </div>
                                
                                <!-- Submit Button -->
                                <button type="button" 
                                        class="w-full bg-[#0F044C] text-white font-semibold py-3 px-6 rounded-xl opacity-70 cursor-not-allowed defparagraf">
                                    Kirim Review
                                </button>
                            </form>

                            <div class="absolute inset-0 z-10">
                                <div class="relative w-full h-full bg-white/25 backdrop-blur-sm rounded-3xl">
                                    <div class="absolute inset-0 pointer-events-none z-0">
                                        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,transparent_45%,rgba(255,255,255,0.65)_85%,rgba(255,255,255,0.75)_100%)]"></div>
                                    </div>
                                    <div class="relative z-10 flex flex-col items-center justify-center gap-4 h-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" class="text-[#0F044C]"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.16-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2a6 6 0 0 1 5.996 5.775L18 8h1a2 2 0 0 1 1.995 1.85L21 10v10a2 2 0 0 1-1.85 1.995L19 22H5a 2 2 0 0 1-1.995-1.85L3 20V10a2 2 0 0 1 1.85-1.995L5 8h1a6 6 0 0 1 6-6m7 8H5v10h14zm-7 2a2 2 0 0 1 1.134 3.647l-.134.085V17a1 1 0 0 1-1.993.117L11 17v-1.268A2 2 0 0 1 12 12m0-8a4 4 0 0 0-4 4h8a4 4 0 0 0-4-4"/></g></svg>
                                        <p class="defparagraf text-black/80 text-center">Silakan masuk terlebih dahulu untuk menulis review.</p>
                                        <a href="{{ url('/login') }}" class="inline-flex items-center justify-center bg-[#0F044C] hover:bg-[#141E61] text-white font-semibold py-2.5 px-5 rounded-xl transition-colors duration-300 defparagraf">Masuk</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- JavaScript for Montir Card Animation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const montirCards = document.querySelectorAll('.montir-card');
            
            montirCards.forEach(card => {
                const nameRoleBox = card.querySelector('.name-role-box');
                const profileCard = card.querySelector('.profile-card');
                
                // Mouse enter - slide animations
                card.addEventListener('mouseenter', function() {
                    // Slide name/role to far left and fade out
                    nameRoleBox.style.transform = 'translateX(-100px)';
                    nameRoleBox.style.opacity = '0';
                    
                    // Slide in profile card from right
                    profileCard.style.transform = 'translateX(0px)';
                    profileCard.style.opacity = '1';
                    profileCard.style.pointerEvents = 'auto';
                });
                
                // Mouse leave - reverse animations
                card.addEventListener('mouseleave', function() {
                    // Slide name/role back from left
                    nameRoleBox.style.transform = 'translateX(0)';
                    nameRoleBox.style.opacity = '1';
                    
                    // Slide profile card to right and hide
                    profileCard.style.transform = 'translateX(-50px)';
                    profileCard.style.opacity = '0';
                    profileCard.style.pointerEvents = 'none';
                });
            });
        });
    </script>
</x-layout>