{{-- resources/views/components/hero-layanan.blade.php --}}
@props([
  'badge' => 'Selamat Datang di Dwi AC Mobil',
  'heading' => null,
  'subtitle' => null,
  'headerHeight' => '80px',     // desktop / lg
  'headerHeightSm' => '64px',   // mobile / sm
  'minHeight' => '60vh',
  'heroData' => [],
])

@php
  // Array background images
  $backgrounds = [
    asset('images/hero-background1.png'),
    asset('images/hero-background2.png'),
    asset('images/hero-background3.png'),
    asset('images/hero-background4.png'),
  ];

  // Random background untuk initial load
  $bgUrl = $backgrounds[array_rand($backgrounds)];

  // Array persuasif untuk heading
  $headings = [
    'KAMI HADIR DENGAN LAYANAN SERVIS AC MOBIL TERBAIK',
    'AC MOBIL ANDA TETAP SEJUK BERSAMA KAMI',
    'LAYANAN PROFESIONAL UNTUK AC MOBIL ANDA',
    'SERVIS AC MOBIL BERKUALITAS HARGA BERSAHABAT',
    'JAGA KENYAMANAN BERKENDARA DENGAN AC MOBIL YANG OPTIMAL',
  ];

  // Array persuasif untuk subtitle
  $subtitles = [
    'Servis & Perawatan AC Mobil Anda di Tangan yang Tepat',
    'Pastikan Perjalanan Anda Selalu Nyaman dengan AC yang Sejuk',
    'Kami Hadir Memberikan Solusi Cepat, Aman, dan Terpercaya',
    'Percayakan AC Mobil Anda pada Ahli yang Berpengalaman',
    'Udara Bersih, Dingin, dan Nyaman untuk Setiap Perjalanan',
  ];

  // Pilih random kalau tidak dikirim lewat props
  $computedHeading = $heading ?: $headings[array_rand($headings)];
  $computedSubtitle = $subtitle ?: $subtitles[array_rand($subtitles)];
@endphp

<style>
  :root { --header-height: {{ $headerHeight }}; }
  @media (max-width: 1024px) {
    :root { --header-height: {{ $headerHeightSm }}; }
  }

  /* Dissolve animation for hero background */
  .hero-bg-layer {
    transition: opacity 1.5s ease-in-out;
  }

  .hero-bg-layer.active {
    opacity: 1;
  }

  .hero-bg-layer.inactive {
    opacity: 0;
  }
</style>

<section class="hero-layanan relative isolate overflow-hidden z-0"
         style="min-height: 100vh;">

  <!-- Background Images with Dissolve Effect -->
  <div class="absolute inset-0 bg-cover bg-center brightness-75 hero-bg-layer active" id="heroBg1"
       style="background-image: url('{{ $bgUrl }}');"></div>
  <div class="absolute inset-0 bg-cover bg-center brightness-75 hero-bg-layer inactive" id="heroBg2"
       style="background-image: url('{{ $bgUrl }}');"></div>

  <!-- Gradient Overlay Biru -->
  <div class="absolute inset-0 bg-gradient-to-r from-[#0F044C]/90 via-[#141E61]/80 to-[#0F044C]/90"></div>

  <!-- inner wrapper - complex layout -->
  <div class="hero-inner relative mx-auto px-16 sm:px-20 lg:px-24 flex flex-col justify-center"
       style="min-height: 100vh; padding-top: 6rem; padding-bottom: 3rem;">

    <!-- Top Section: Heading + Background Selector -->
    <div class="flex items-center justify-between gap-8 mt-[150px]">
      <!-- Left: Heading & Subtitle & Buttons -->
      <div class="flex-1 max-w-4xl flex flex-col justify-center">
        <h1 class="font-montserrat-64 text-white leading-tight uppercase">
          {{ $computedHeading }}
        </h1>

        <p class="mt-6 text-white/90 bighpparagraf">
          {!! nl2br(e($computedSubtitle)) !!}
        </p>

        <div class="mt-8 flex flex-wrap items-center gap-4">
          <a href="{{ auth()->check() ? route('booking') : route('login') }}"
             class="w-full sm:w-64 h-14 md:h-16 bg-white text-[#0F044C] font-semibold rounded-xl
                    flex items-center justify-center hover:bg-white/90 transition shadow-lg">
            <span class="bigparagraf">Antri & Serviskan!</span>
            <img src="/images/arrows_button/panah-miringkeatas.svg" alt="" aria-hidden="true" class="ml-3 h-5 w-5 brightness-0" />
          </a>
          <a href="/layanan"
             class="w-full sm:w-64 h-14 md:h-16 border-2 border-white text-white font-semibold rounded-xl
                    flex items-center justify-center hover:bg-white/10 transition">
            <span class="bigparagraf">Jelajahi layanan kami</span>
          </a>
        </div>
      </div>

      <!-- Right: Background Selector (01-04) -->
      <div class="flex flex-col justify-center gap-3 text-white/60">
        <button onclick="changeHeroBg(1)" class="hero-bg-btn font-montserrat-36 hover:text-white transition" data-bg="1">01</button>
        <button onclick="changeHeroBg(2)" class="hero-bg-btn font-montserrat-36 hover:text-white transition" data-bg="2">02</button>
        <button onclick="changeHeroBg(3)" class="hero-bg-btn font-montserrat-36 hover:text-white transition" data-bg="3">03</button>
        <button onclick="changeHeroBg(4)" class="hero-bg-btn font-montserrat-36 hover:text-white transition" data-bg="4">04</button>
      </div>
    </div>

    <!-- Bottom Section: Users + Rating -->
    <div class="flex items-center justify-between mt-auto pt-20">
      <!-- Left: Overlapping User Icons -->
      @if(!empty($heroData['recent_users']) && count($heroData['recent_users']) > 0)
        <div class="flex items-center gap-4">
          <div class="flex -space-x-3">
            @foreach($heroData['recent_users'] as $user)
              <img src="{{ $user['image'] }}" alt="{{ $user['name'] }}" class="w-14 h-14 rounded-full border-4 border-white object-cover shadow-lg hover:scale-110 transition-transform duration-200" />
            @endforeach
          </div>
          <p class="text-white/90 bigparagraf">{{ $heroData['user_message'] }}</p>
        </div>
      @elseif(($heroData['total_users'] ?? 0) > 0)
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 rounded-full border-2 border-white bg-white/20 flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>
          <p class="text-white/90 bigparagraf">{{ $heroData['user_message'] }}</p>
        </div>
      @else
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 rounded-full border-2 border-white/40 bg-white/10 flex items-center justify-center">
            <svg class="w-6 h-6 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>
          <p class="text-white/60 bigparagraf">Belum ada pengguna terdaftar</p>
        </div>
      @endif

      <!-- Right: Rating -->
      @if(($heroData['avg_rating'] ?? 0) > 0)
        <div class="flex items-center gap-4">
          <p class="text-white/90 bigparagraf">{{ $heroData['rating_message'] }}</p>
          <div class="flex items-center gap-1">
            @php
              $avgRating = $heroData['avg_rating'] ?? 0;
              $fullStars = floor($avgRating);
              $hasHalfStar = ($avgRating - $fullStars) >= 0.5;
            @endphp
            @for($i = 1; $i <= 5; $i++)
              @if($i <= $fullStars)
                {{-- Full star --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="#fff042" fill-rule="evenodd" d="M12.908 1.581a1 1 0 0 0-1.816 0l-2.87 6.22l-6.801.807a1 1 0 0 0-.562 1.727l5.03 4.65l-1.335 6.72a1 1 0 0 0 1.469 1.067L12 19.426l5.977 3.346a1 1 0 0 0 1.47-1.068l-1.335-6.718l5.029-4.651a1 1 0 0 0-.562-1.727L15.777 7.8z" clip-rule="evenodd"/>
                </svg>
              @elseif($i == $fullStars + 1 && $hasHalfStar)
                {{-- Half star --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <defs>
                    <linearGradient id="halfStar{{ $i }}">
                      <stop offset="50%" stop-color="#fff042"/>
                      <stop offset="50%" stop-color="#ffffff40"/>
                    </linearGradient>
                  </defs>
                  <path fill="url(#halfStar{{ $i }})" fill-rule="evenodd" d="M12.908 1.581a1 1 0 0 0-1.816 0l-2.87 6.22l-6.801.807a1 1 0 0 0-.562 1.727l5.03 4.65l-1.335 6.72a1 1 0 0 0 1.469 1.067L12 19.426l5.977 3.346a1 1 0 0 0 1.47-1.068l-1.335-6.718l5.029-4.651a1 1 0 0 0-.562-1.727L15.777 7.8z" clip-rule="evenodd"/>
                </svg>
              @else
                {{-- Empty star --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="#ffffff40" fill-rule="evenodd" d="M12.908 1.581a1 1 0 0 0-1.816 0l-2.87 6.22l-6.801.807a1 1 0 0 0-.562 1.727l5.03 4.65l-1.335 6.72a1 1 0 0 0 1.469 1.067L12 19.426l5.977 3.346a1 1 0 0 0 1.47-1.068l-1.335-6.718l5.029-4.651a1 1 0 0 0-.562-1.727L15.777 7.8z" clip-rule="evenodd"/>
                </svg>
              @endif
            @endfor
          </div>
        </div>
      @else
        <div class="flex items-center gap-4">
          <p class="text-white/60 bigparagraf">Belum ada rating dari pelanggan</p>
          <div class="flex items-center gap-1">
            @for($i = 1; $i <= 5; $i++)
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                <path fill="#ffffff20" fill-rule="evenodd" d="M12.908 1.581a1 1 0 0 0-1.816 0l-2.87 6.22l-6.801.807a1 1 0 0 0-.562 1.727l5.03 4.65l-1.335 6.72a1 1 0 0 0 1.469 1.067L12 19.426l5.977 3.346a1 1 0 0 0 1.47-1.068l-1.335-6.718l5.029-4.651a1 1 0 0 0-.562-1.727L15.777 7.8z" clip-rule="evenodd"/>
              </svg>
            @endfor
          </div>
        </div>
      @endif
    </div>

  </div>
</section>



<script>
  let currentBg = 1;
  let autoSlideInterval = null;
  let currentLayer = 1; // Track which layer is currently active
  let isTransitioning = false; // Prevent multiple transitions at once

  // Function to change hero background with dissolve effect
  function changeHeroBg(bgNumber, isAuto = false) {
    // Prevent multiple transitions at the same time
    if (isTransitioning) return;

    const bg1 = document.getElementById('heroBg1');
    const bg2 = document.getElementById('heroBg2');
    const buttons = document.querySelectorAll('.hero-bg-btn');

    // Background images array
    const backgrounds = [
      '{{ asset('images/hero-background1.png') }}',
      '{{ asset('images/hero-background2.png') }}',
      '{{ asset('images/hero-background3.png') }}',
      '{{ asset('images/hero-background4.png') }}'
    ];

    if (!bg1 || !bg2 || !backgrounds[bgNumber - 1]) return;

    // Skip if already on this background
    if (currentBg === bgNumber && !isAuto) return;

    isTransitioning = true;

    // Determine which layer to update
    const activeLayer = currentLayer === 1 ? bg1 : bg2;
    const inactiveLayer = currentLayer === 1 ? bg2 : bg1;

    // Set new image on inactive layer
    inactiveLayer.style.backgroundImage = `url('${backgrounds[bgNumber - 1]}')`;

    // Dissolve effect: fade out active, fade in inactive
    activeLayer.classList.remove('active');
    activeLayer.classList.add('inactive');
    inactiveLayer.classList.remove('inactive');
    inactiveLayer.classList.add('active');

    // Switch current layer
    currentLayer = currentLayer === 1 ? 2 : 1;
    currentBg = bgNumber;

    // Allow transitions again after animation completes
    setTimeout(() => {
      isTransitioning = false;
    }, 1500); // Match transition duration

    // Update active button
    buttons.forEach((btn, index) => {
      if (index + 1 === bgNumber) {
        btn.classList.remove('text-white/60');
        btn.classList.add('text-white');
      } else {
        btn.classList.remove('text-white');
        btn.classList.add('text-white/60');
      }
    });

    // Reset auto-slide timer if manually clicked
    if (!isAuto) {
      resetAutoSlide();
    }
  }

  // Auto slide function
  function startAutoSlide() {
    // Clear any existing interval first
    if (autoSlideInterval) {
      clearInterval(autoSlideInterval);
      autoSlideInterval = null;
    }

    autoSlideInterval = setInterval(() => {
      let nextBg = currentBg + 1;
      if (nextBg > 4) nextBg = 1;
      changeHeroBg(nextBg, true);
    }, 5000); // Change every 5 seconds
  }

  // Reset auto slide
  function resetAutoSlide() {
    if (autoSlideInterval) {
      clearInterval(autoSlideInterval);
      autoSlideInterval = null;
    }
    startAutoSlide();
  }

  // Stop auto slide (useful for cleanup)
  function stopAutoSlide() {
    if (autoSlideInterval) {
      clearInterval(autoSlideInterval);
      autoSlideInterval = null;
    }
  }

  // Initialize on page load
  document.addEventListener('DOMContentLoaded', function() {
    // Clean up any existing intervals (in case of hot reload)
    stopAutoSlide();

    // Set initial background
    currentBg = 1;
    currentLayer = 1;
    isTransitioning = false;

    // Start auto slide
    startAutoSlide();

    // Add click listeners to buttons
    document.querySelectorAll('.hero-bg-btn').forEach((btn, index) => {
      btn.addEventListener('click', () => {
        changeHeroBg(index + 1, false);
      });
    });
  });

  // Clean up on page unload
  window.addEventListener('beforeunload', function() {
    stopAutoSlide();
  });
</script>
