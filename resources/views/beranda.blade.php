<x-layout :showHeader="true" :showHero="true" title="Beranda - Dwi AC Mobil">
    <!-- Section Layanan -->
    <section class="py-12 md:py-16 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-left">
                <div class="montserrat-regular-10 mb-2">Layanan Kami</div>
                <h2 class="font-montserrat-alt-48 text-black mb-6 md:mb-8">KAMI HADIR DENGAN LAYANAN SERVIS AC MOBIL TERBAIK</h2>
                @php
                    $services = [
                        ['title' => 'Isi Freon', 'desc' => 'Mengisi ulang freon pada sistem AC mobil yang kurang atau habis agar AC kembali dingin dan bekerja optimal.', 'img' => asset('images/layanan-1.jpg')],
                        ['title' => 'Cuci Evaporator', 'desc' => 'Membersihkan evaporator dari kotoran dan jamur agar udara lebih bersih dan dingin.', 'img' => asset('images/layanan-2.jpg')],
                        ['title' => 'Ganti Filter', 'desc' => 'Penggantian filter kabin AC untuk menjaga kualitas sirkulasi udara dan kenyamanan.', 'img' => asset('images/layanan-3.jpg')],
                        ['title' => 'Cek Kebocoran', 'desc' => 'Pemeriksaan menyeluruh untuk mendeteksi kebocoran sistem AC mobil.', 'img' => asset('images/layanan-1.jpg')],
                        ['title' => 'Service Berkala', 'desc' => 'Perawatan rutin untuk menjaga performa AC tetap optimal.', 'img' => asset('images/layanan-2.jpg')],
                    ];
                @endphp

                <!-- Carousel container -->
                <div class="relative">
                    <!-- Scroller -->
                    <div id="service-scroller" class="overflow-x-auto scroll-smooth [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                        <div class="flex gap-8 w-max min-w-full">
                            @foreach($services as $service)
                            <article class="w-[500px] h-[300px] max-w-full bg-white overflow-hidden grid grid-cols-[232px_268px] shrink-0" style="outline: 1px solid rgba(0,0,0,0.15); outline-offset: -1px;">
                                <img src="{{ $service['img'] }}" alt="{{ $service['title'] }}" class="w-[232px] h-[300px] object-cover" />
                                <div class="w-[268px] h-[300px] p-6 flex flex-col">
                                    <h3 class="font-montserrat-alt-36 mb-3">{{ $service['title'] }}</h3>
                                    <p class="defparagraf text-black/80">{{ $service['desc'] }}</p>
                                    <div class="mt-auto">
                                        <a href="#" class="defparagraf uppercase font-bold inline-flex items-center gap-2">Selengkapnya <span aria-hidden="true">→</span></a>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                        </div>
                    </div>

                    <!-- Controls + CTAs aligned like the reference -->
                    <div class="mt-8 md:mt-10 flex items-center justify-between">
                        <button id="carousel-prev" type="button" aria-label="Sebelumnya" class="w-10 h-10 inline-flex items-center justify-center text-[#0F044C] hover:opacity-80">
                            <img src="/images/arrows_button/panahkiri.svg" alt="Sebelumnya" class="w-5 h-5" />
                        </button>

                        <div class="mx-auto flex flex-wrap items-center gap-3 sm:gap-4 md:gap-6">
                            <a href="#" class="w-full sm:w-[240px] md:w-[275px] h-12 sm:h-14 md:h-[70px] inline-flex items-center justify-center bg-[#0F044C] text-white font-semibold tracking-wide hover:bg-[#0F044C]/90 transition">
                                <span class="bigparagraf">Antri & Serviskan!</span>
                                <img src="/images/arrows_button/panah-miringkeatas.svg" alt="" aria-hidden="true" class="ml-3 h-5 w-5" />
                            </a>
                            <a href="#" class="w-full sm:w-[240px] md:w-[275px] h-12 sm:h-14 md:h-[70px] inline-flex items-center justify-center border bg-black/30 text-white font-semibold hover:bg-black/50 transition">
                                <span class="bigparagraf">Jelajahi layanan kami</span>
                            </a>
                        </div>

                        <button id="carousel-next" type="button" aria-label="Selanjutnya" class="w-10 h-10 inline-flex items-center justify-center text-[#0F044C] hover:opacity-80">
                            <img src="/images/arrows_button/panahkanan.svg" alt="Selanjutnya" class="w-5 h-5" />
                        </button>
                    </div>
                </div>

                <script>
                    (function(){
                        var scroller = document.getElementById('service-scroller');
                        if(!scroller) return;
                        var prev = document.getElementById('carousel-prev');
                        var next = document.getElementById('carousel-next');
                        var STEP = 532; // 500 card + 32 gap

                        function updateButtons(){
                            var maxScroll = scroller.scrollWidth - scroller.clientWidth - 1;
                            var atStart = scroller.scrollLeft <= 0;
                            var atEnd = scroller.scrollLeft >= maxScroll;
                            prev.style.opacity = atStart ? '0.4' : '1';
                            prev.style.pointerEvents = atStart ? 'none' : 'auto';
                            next.style.opacity = atEnd ? '0.4' : '1';
                            next.style.pointerEvents = atEnd ? 'none' : 'auto';
                        }

                        prev && prev.addEventListener('click', function(){
                            scroller.scrollBy({ left: -STEP, behavior: 'smooth' });
                            setTimeout(updateButtons, 300);
                        });
                        next && next.addEventListener('click', function(){
                            scroller.scrollBy({ left: STEP, behavior: 'smooth' });
                            setTimeout(updateButtons, 300);
                        });
                        scroller.addEventListener('scroll', function(){
                            // throttle-light via timeout
                            window.requestAnimationFrame(updateButtons);
                        });
                        updateButtons();
                    })();
                </script>
            </div>
        </div>
    </section>

    <!-- Section Kalender -->
    <section id="antrian" class="py-12 md:py-16 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-left">
                <div class="montserrat-regular-10 mb-2">Daftar Antrian</div>
                <h2 class="font-montserrat-alt-48 text-black mb-6 md:mb-8">BOOKING ANTRIAN</h2>
                
                <!-- Calendar Container -->
                <div class="w-[1187px] max-w-full bg-white border border-gray-300 overflow-hidden">
                    <!-- Calendar Header with Days -->
                    <div class="w-[1185px] max-w-full px-8 py-6">
                        <!-- Month and Navigation -->
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="font-montserrat-alt-36 text-black">SEPTEMBER 2025</h3>
                            <div class="flex items-center gap-4">
                                <button type="button" class="w-10 h-10 rounded-full bg-gray-300 hover:bg-gray-400 transition flex items-center justify-center">
                                    <img src="/images/arrows_button/panahkiri.svg" alt="Sebelumnya" class="w-5 h-5" />
                                </button>
                                <button type="button" class="w-10 h-10 rounded-full bg-gray-300 hover:bg-gray-400 transition flex items-center justify-center">
                                    <img src="/images/arrows_button/panahkanan.svg" alt="Selanjutnya" class="w-5 h-5" />
                                </button>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- Calendar Grid -->
                    <div class="">
                        <!-- Combined Header and Date Grid -->
                        <div class="grid grid-cols-6">
                            <!-- Days of Week Header -->
                            <div class="h-12 bigparagraf flex items-center justify-center text-gray-700">Senin</div>
                            <div class="h-12 bigparagraf flex items-center justify-center text-gray-700">Selasa</div>
                            <div class="h-12 bigparagraf flex items-center justify-center text-gray-700">Rabu</div>
                            <div class="h-12 bigparagraf flex items-center justify-center text-gray-700">Kamis</div>
                            <div class="h-12 bigparagraf flex items-center justify-center text-gray-700">Jumat</div>
                            <div class="h-12 bigparagraf flex items-center justify-center text-gray-700">Sabtu</div>
                            @php
                                $dates = [
                                    ['date' => 1, 'status' => 'available'],
                                    ['date' => 2, 'status' => 'available'],
                                    ['date' => 3, 'status' => 'available'],
                                    ['date' => 4, 'status' => 'available'],
                                    ['date' => 5, 'status' => 'holiday'],
                                    ['date' => 6, 'status' => 'available'],
                                    ['date' => 8, 'status' => 'available'],
                                    ['date' => 9, 'status' => 'available'],
                                    ['date' => 10, 'status' => 'available'],
                                    ['date' => 11, 'status' => 'available'],
                                    ['date' => 12, 'status' => 'booked'],
                                    ['date' => 13, 'status' => 'available'],
                                    ['date' => 15, 'status' => 'available'],
                                    ['date' => 16, 'status' => 'available'],
                                    ['date' => 17, 'status' => 'available'],
                                    ['date' => 18, 'status' => 'available'],
                                    ['date' => 19, 'status' => 'available'],
                                    ['date' => 20, 'status' => 'booked'],
                                    ['date' => 22, 'status' => 'available'],
                                    ['date' => 23, 'status' => 'available'],
                                    ['date' => 24, 'status' => 'available'],
                                    ['date' => 25, 'status' => 'available'],
                                    ['date' => 26, 'status' => 'available'],
                                    ['date' => 27, 'status' => 'available'],
                                    ['date' => 29, 'status' => 'holiday'],
                                    ['date' => 30, 'status' => 'holiday'],
                                ];
                            @endphp
                            
                            @foreach($dates as $dateInfo)
                                @php
                                    $bgColor = match($dateInfo['status']) {
                                        'available' => 'bg-white border border-gray-300',
                                        'booked' => 'bg-gray-400 border border-gray-500',
                                        'holiday' => 'bg-red-200 border border-red-300',
                                        default => 'bg-white border border-gray-300'
                                    };
                                    $textColor = match($dateInfo['status']) {
                                        'available' => 'text-black',
                                        'booked' => 'text-gray-700',
                                        'holiday' => 'text-red-800',
                                        default => 'text-black'
                                    };
                                @endphp
                                <div class="h-24 {{ $bgColor }} flex items-start pt-2 justify-center cursor-pointer hover:opacity-80 transition">
                                    <span class="text-lg bigparagraf {{ $textColor }}">{{ $dateInfo['date'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Legend -->
                <div class="mt-8 flex items-center gap-8">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-white border border-gray-300 rounded"></div>
                        <span class="defparagraf text-black">Tanggal yang bisa di booking</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-gray-400 border border-gray-500 rounded"></div>
                        <span class="defparagraf text-black">Sudah ada yang antri (tidak bisa booking)</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-red-200 border border-red-300 rounded"></div>
                        <span class="defparagraf text-black">Hari libur bengkel</span>
                    </div>
                </div>
                
                <!-- Bottom Content -->
                <div class="mt-10 flex items-center justify-between">
                    <div class="max-w-xl">
                        <p class="bigparagraf text-black">Antrikan mobil Anda dengan mengambil tanggal yang tersedia pada kalender di sebelah kanan.</p>
                    </div>
                    <div class="px-7">
                    <a href="#" class="w-[275px] h-[70px] inline-flex items-center justify-center bg-[#0F044C] text-white font-semibold tracking-wide hover:bg-[#0F044C]/90 transition">
                        <span class="bigparagraf">Antri & Serviskan!</span>
                        <img src="/images/arrows_button/panah-miringkeatas.svg" alt="" aria-hidden="true" class="ml-3 h-5 w-5" />
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Review --}}
    <section id="review" class="py-12 md:py-16 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-left">
                <div class="montserrat-regular-10 mb-2">Review Kami</div>
                <h2 class="font-montserrat-alt-48 text-black mb-6 md:mb-8">
                    APA KATA KLIEN KAMI TENTANG LAYANAN KAMI
                </h2>
                
                @php
                    $reviews = [
                        [
                            'name' => 'Hirasawa Yui',
                            'rating' => 5,
                            'text' => 'Pelayanan di sini benar-benar luar biasa! Prosesnya cepat, stafnya ramah dan sangat profesional. Saya datang dengan masalah AC mobil, dan hanya dalam waktu singkat semuanya sudah beres. Hasil servis rapi dan penjelasan teknisinya juga mudah dimengerti. Sangat direkomendasikan untuk siapa pun yang ingin servis dengan kualitas terbaik!',
                            'image' => asset('images/review/example.jpg')
                        ],
                        [
                            'name' => 'Tainaka Ritsu',
                            'rating' => 5,
                            'text' => 'Pelayanan di sini benar-benar luar biasa! Prosesnya cepat, stafnya ramah dan sangat profesional. Saya datang dengan masalah AC mobil, dan hanya dalam waktu singkat semuanya sudah beres. Hasil servis rapi dan penjelasan teknisinya juga mudah dimengerti. Sangat direkomendasikan untuk siapa pun yang ingin servis dengan kualitas terbaik!',
                            'image' => asset('images/review/example1.jpg')
                        ],
                        [
                            'name' => 'Akiyama Mio',
                            'rating' => 5,
                            'text' => 'Pelayanan di sini benar-benar luar biasa! Prosesnya cepat, stafnya ramah dan sangat profesional. Saya datang dengan masalah AC mobil, dan hanya dalam waktu singkat semuanya sudah beres. Hasil servis rapi dan penjelasan teknisinya juga mudah dimengerti. Sangat direkomendasikan untuk siapa pun yang ingin servis dengan kualitas terbaik!',
                            'image' => asset('images/review/example2.jpg')
                        ],
                        [
                            'name' => 'Kotobuki Tsumugi',
                            'rating' => 4,
                            'text' => 'Sangat puas! Pelayanan cepat dan hasilnya memuaskan. Suhu AC kembali dingin dan nyaman. Timnya ramah dan komunikatif, jadi prosesnya terasa menyenangkan.',
                            'image' => asset('images/review/example3.jpg')
                        ],
                        [
                            'name' => 'Nakano Azusa',
                            'rating' => 5,
                            'text' => 'Teknisi sangat teliti dan profesional. Penjelasannya jelas, dan pengerjaan rapi. Sekarang AC mobil jadi lebih sejuk dan tidak bau. Recommended!',
                            'image' => asset('images/review/example4.jpg')
                        ]
                    ];
                @endphp
                
                <!-- Review Carousel Container dengan overflow visible -->
                <div class="relative overflow-visible pt-4 md:pt-6 pb-0">
                    <!-- Scroller dengan padding top untuk profile images -->
                    <div
                        id="review-scroller"
                        class="overflow-x-auto overflow-y-visible scroll-smooth [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden"
                    >
                        <div class="flex gap-8 w-max min-w-full pb-4">
                            @foreach($reviews as $review)
                            <div class="relative w-[380px] shrink-0 flex flex-col items-center">
                                <!-- Profile Picture positioned outside the card -->
                                <div class="mb-4 relative z-20">
                                    <img
                                        src="{{ $review['image'] }}"
                                        alt="{{ $review['name'] }}"
                                        class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg mx-auto transform translate-y-[60px]"
                                    />
                                </div>
                                
                                <!-- Card positioned below profile -->
                                <article class="bg-white border border-gray-200 shadow-sm px-6 py-12 text-center w-full relative">
                                    <h3 class="bigparagraf text-black font-bold mb-1">
                                        {{ $review['name'] }}
                                    </h3>
                                
                                    <!-- Star Rating -->
                                    <div class="flex items-center justify-center gap-1 mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="#fff042" fill-rule="evenodd" d="M12.908 1.581a1 1 0 0 0-1.816 0l-2.87 6.22l-6.801.807a1 1 0 0 0-.562 1.727l5.03 4.65l-1.335 6.72a1 1 0 0 0 1.469 1.067L12 19.426l5.977 3.346a1 1 0 0 0 1.47-1.068l-1.335-6.718l5.029-4.651a1 1 0 0 0-.562-1.727L15.777 7.8z" clip-rule="evenodd"/>
                                        </svg>
                                        @endfor
                                    </div>
                                
                                    <!-- Separator Line -->
                                    <div class="w-full h-px bg-black mb-4"></div>
                                
                                    <!-- Review Text -->
                                    <p class="defparagraf text-black/80 leading-relaxed">
                                        {{ $review['text'] }}
                                    </p>
                                </article>                                
                            </div>
                            @endforeach
                        </div>
                    </div>
    
                    <!-- Navigation Arrows -->
                    <div class="mt-4 md:mt-6 flex items-center justify-center gap-4">
                        <button id="review-prev" type="button" aria-label="Sebelumnya" class="w-10 h-10 inline-flex items-center justify-center text-[#0F044C] hover:opacity-80 transition">
                            <img src="/images/arrows_button/panahkiri.svg" alt="Sebelumnya" class="w-5 h-5" />
                        </button>
                        <span aria-hidden="true" class="w-full h-px bg-gray-300"></span>
                        <button id="review-next" type="button" aria-label="Selanjutnya" class="w-10 h-10 inline-flex items-center justify-center text-[#0F044C] hover:opacity-80 transition">
                            <img src="/images/arrows_button/panahkanan.svg" alt="Selanjutnya" class="w-5 h-5" />
                        </button>
                    </div>
                </div>
    
                <script>
                    (function(){
                        var scroller = document.getElementById('review-scroller');
                        if(!scroller) return;
                        var prev = document.getElementById('review-prev');
                        var next = document.getElementById('review-next');
                        var STEP = 388; // 380 card + 8 gap
    
                        function updateButtons(){
                            var maxScroll = scroller.scrollWidth - scroller.clientWidth - 1;
                            var atStart = scroller.scrollLeft <= 0;
                            var atEnd = scroller.scrollLeft >= maxScroll;
                            prev.style.opacity = atStart ? '0.4' : '1';
                            prev.style.pointerEvents = atStart ? 'none' : 'auto';
                            next.style.opacity = atEnd ? '0.4' : '1';
                            next.style.pointerEvents = atEnd ? 'none' : 'auto';
                        }

                        // Equalize card heights to match the tallest one
                        function equalizeCardHeights(){
                            var cards = document.querySelectorAll('#review-scroller article');
                            if(!cards.length) return;
                            // Reset heights to auto first
                            cards.forEach(function(card){ card.style.height = 'auto'; });
                            var max = 0;
                            cards.forEach(function(card){
                                var h = card.offsetHeight;
                                if(h > max) max = h;
                            });
                            cards.forEach(function(card){ card.style.height = max + 'px'; });
                        }

                        // Run on load and resize (debounced)
                        equalizeCardHeights();
                        var resizeTimeout;
                        window.addEventListener('resize', function(){
                            clearTimeout(resizeTimeout);
                            resizeTimeout = setTimeout(equalizeCardHeights, 150);
                        });

                        prev && prev.addEventListener('click', function(){
                            scroller.scrollBy({ left: -STEP, behavior: 'smooth' });
                            setTimeout(updateButtons, 300);
                        });
                        next && next.addEventListener('click', function(){
                            scroller.scrollBy({ left: STEP, behavior: 'smooth' });
                            setTimeout(updateButtons, 300);
                        });
                        scroller.addEventListener('scroll', function(){
                            window.requestAnimationFrame(updateButtons);
                        });
                        updateButtons();
                    })();
                </script>
            </div>
        </div>
    </section>

    <!-- Section Kontak -->
    <section id="kontak" class="py-12 md:py-16 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-left">
                <div class="montserrat-regular-10 mb-2">Tim Kami</div>
                <h2 class="font-montserrat-alt-48 text-black mb-6 md:mb-8 uppercase">TENAGA AHLI DI BALIK SERVIS TERBAIK</h2>
            </div>

            <!-- Person list generated via array loop -->
            @php
                $teamMembers = [
                    [
                        'name' => 'ROBERT LOX',
                        'role' => 'Owner',
                        'desc' => 'Dengan pengalaman lebih dari 7 tahun di bidang perbaikan dan perawatan sistem AC mobil, dikenal sebagai teknisi yang teliti dan berdedikasi. Menguasai berbagai jenis kendaraan, terbiasa menangani pengisian freon, pembersihan evaporator, hingga penggantian komponen penting seperti kompresor dan kondensor. Komitmen terhadap kualitas dan kepuasan pelanggan menjadikannya salah satu aset terbaik dalam tim bengkel kami.',
                        'image' => asset('images/team/team.jpg'),
                        'wa_number' => '6281234567891',
                        'wa_display' => '0812 3456 7891',
                        'fb_label' => 'Timbul Dwi Ac Mobil',
                    ],
                    [
                        'name' => 'MICHAEL KORS',
                        'role' => 'Karyawan',
                        'desc' => 'Dengan pengalaman lebih dari 7 tahun di bidang perbaikan dan perawatan sistem AC mobil, menguasai beragam pekerjaan seperti pengisian freon, pembersihan evaporator, serta pemeriksaan kebocoran. Keahliannya memastikan sistem pendingin kabin kembali dingin dan nyaman.',
                        'image' => asset('images/team/team1.jpg'),
                        'wa_number' => '6281234567891',
                        'wa_display' => '0812 3456 7891',
                        'fb_label' => '0812 3456 7891',
                    ],
                ];
            @endphp

            @foreach($teamMembers as $index => $member)
                @php
                    $gridCols = $index % 2 === 0 ? 'lg:grid-cols-[260px_1fr]' : 'lg:grid-cols-[1fr_260px]';
                    $hasBottomMargin = $index < count($teamMembers) - 1 ? 'mb-12 md:mb-16' : '';
                @endphp
                <div class="grid grid-cols-1 {{ $gridCols }} items-start gap-8 md:gap-10 {{ $hasBottomMargin }}">
                    @if($index % 2 === 0)
                        <div>
                            <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="w-[230px] h-[300px] object-cover border border-gray-300" />
                        </div>
                        <div>
                            <h3 class="font-montserrat-alt-36 text-black uppercase mb-1">{{ $member['name'] }}</h3>
                            <div class="defparagraf text-black/70 mb-4 md:mb-6">{{ $member['role'] }}</div>
                            <p class="defparagraf text-black/80 leading-relaxed mb-4 md:mb-6">{{ $member['desc'] }}</p>
                            <div class="flex flex-wrap items-center gap-3 md:gap-4">
                                <a href="https://wa.me/{{ $member['wa_number'] }}" target="_blank" class="inline-flex items-center gap-3 border border-gray-300 px-4 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#000" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"/></svg>
                                    <span class="defparagraf">{{ $member['wa_display'] }}</span>
                                </a>
                                <a href="#" class="inline-flex items-center gap-3 border border-gray-300 px-4 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#000" d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95"/></svg>
                                    <span class="defparagraf">{{ $member['fb_label'] }}</span>
                                </a>
                            </div>
                        </div>
                    @else
                        <div>
                            <h3 class="font-montserrat-alt-36 text-black uppercase mb-1">{{ $member['name'] }}</h3>
                            <div class="defparagraf text-black/70 mb-4 md:mb-6">{{ $member['role'] }}</div>
                            <p class="defparagraf text-black/80 leading-relaxed mb-4 md:mb-6">{{ $member['desc'] }}</p>
                            <div class="flex flex-wrap items-center gap-3 md:gap-4">
                                <a href="https://wa.me/{{ $member['wa_number'] }}" target="_blank" class="inline-flex items-center gap-3 border border-gray-300 px-4 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#000" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"/></svg>
                                    <span class="defparagraf">{{ $member['wa_display'] }}</span>
                                </a>
                                <a href="#" class="inline-flex items-center gap-3 border border-gray-300 px-4 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#000" d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95"/></svg>
                                    <span class="defparagraf">{{ $member['fb_label'] }}</span>
                                </a>
                            </div>
                        </div>
                        <div>
                            <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="w-[230px] h-[300px] object-cover border border-gray-300" />
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    <!-- Section Galeri -->
    <section id="galeri" class="py-12 md:py-16 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-left">
                <div class="montserrat-regular-10 mb-2">Galeri Kami</div>
                <h2 class="font-montserrat-alt-48 text-black mb-6 md:mb-8 uppercase">POTRET KEGIATAN BENGKEL KAMI DALAM SETIAP LANGKAH PERBAIKAN</h2>
            </div>

            <!-- Grid: 3 images on top row, 2 images on bottom row -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                <div class="md:col-span-4">
                    <img src="{{ asset('images/review/example.jpg') }}" alt="Proses perakitan dashboard dan sistem AC" class="w-full h-[240px] sm:h-[260px] md:h-[300px] object-cover" />
                </div>
                <div class="md:col-span-4">
                    <img src="{{ asset('images/review/example1.jpg') }}" alt="Pencucian komponen evaporator AC" class="w-full h-[240px] sm:h-[260px] md:h-[300px] object-cover" />
                </div>
                <div class="md:col-span-4">
                    <img src="{{ asset('images/review/example2.jpg') }}" alt="Pemeriksaan bawah mobil oleh teknisi" class="w-full h-[240px] sm:h-[260px] md:h-[300px] object-cover" />
                </div>

                <div class="md:col-span-6">
                    <img src="{{ asset('images/review/example3.jpg') }}" alt="Pengukuran tekanan freon pada sistem AC" class="w-full h-[240px] sm:h-[280px] md:h-[360px] object-cover" />
                </div>
                <div class="md:col-span-6">
                    <img src="{{ asset('images/review/example4.jpg') }}" alt="Penggantian filter kabin AC mobil" class="w-full h-[240px] sm:h-[280px] md:h-[360px] object-cover" />
                </div>
            </div>
        </div>
    </section>
</x-layout>