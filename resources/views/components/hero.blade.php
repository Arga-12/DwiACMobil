<section class="relative isolate overflow-hidden pt-28 lg:pt-30">
  <!-- Background image -->
  <div class="absolute inset-0 bg-cover bg-center brightness-90" style="background-image: url('/images/hero-background.png');"></div>
  <!-- Darken overlay (adjust opacity: /30 /40 /50 /60) -->
  <div class="absolute inset-0 bg-black/40"></div>
  <!-- Gradient overlay: from left #0F044C (100%) to transparent (0%) -->
  <div class="absolute inset-0 bg-gradient-to-r from-[#0F044C] to-[#0F044C]/0"></div>

  @php
    $bigHeadings = [
      'HADIRKAN NYAMAN SEPANJANG PERJALANAN',
      'WUJUDKAN SEJUKNYA KENDARAAN ANDA',
      'DAPATKAN KINERJA AC TEROPTIMAL',
      'RASAKAN SEGARNYA UDARA BERKUALITAS',
      'NIKMATI PERFORMA AC TANPA TANDING',
    ];

    $smallSubtexts = [
      'Layanan servis AC mobil yang mengutamakan kenyamanan Anda.',
      'Teknologi perawatan AC terbaru untuk hasil terbaik.',
      'Performa prima AC mobil Anda, kapan pun diperlukan.',
      'Menjaga suhu ideal mobil di setiap perjalanan.',
      'Solusi terpercaya untuk kenyamanan berkendara.',
    ];

    $computedHeading = isset($heading) && $heading !== ''
      ? $heading
      : \Illuminate\Support\Arr::random($bigHeadings);

    $slotString = trim((string) $slot);
    $computedSubtitle = $slotString !== ''
      ? $slotString
      : \Illuminate\Support\Arr::random($smallSubtexts);
  @endphp

  <div class="relative mx-auto max-w-7xl px-6 lg:px-8 pt-24 sm:pt-32 pb-12 md:pb-16">
    <div class="max-w-4xl lg:max-w-5xl">
      <!-- Optional badge -->
      <div class="inline-flex items-center px-5 py-2 bg-[#787A91] h-[40px] rounded-full backdrop-blur-sm text-white mb-6 bigparagraf">
        <span>Selamat datang di <span class="text-[#0F044C]">Dwi AC Mobil</span></span>
      </div>

      <!-- Main heading -->
      <h1 class="font-montserrat-64 text-white leading-tight uppercase">
        {{ $computedHeading }}
      </h1>

      <!-- Subtitle / content -->
      <p class="mt-6 text-white/80 text-lg defparagrah">
        {{ $computedSubtitle }}
      </p>

      <!-- CTA Buttons -->
      <div class="mt-10 flex flex-wrap items-center gap-3 sm:gap-4 md:gap-6">
        <a href="#" class="w-full sm:w-[240px] md:w-[275px] h-12 sm:h-14 md:h-[70px] inline-flex items-center justify-center bg-[#0F044C] text-white font-semibold tracking-wide hover:bg-[#0F044C]/90 transition">
          <span class="bigparagraf">Antri & Serviskan!</span>
          <img src="/images/arrows_button/panah-miringkeatas.svg" alt="" aria-hidden="true" class="ml-3 h-5 w-5" />
        </a>
        <a href="#" class="w-full sm:w-[240px] md:w-[275px] h-12 sm:h-14 md:h-[70px] inline-flex items-center justify-center border border-white/50 bg-white/20 text-white font-semibold hover:bg-white/10 transition">
          <span class="bigparagraf">Jelajahi layanan kami</span>
        </a>
      </div>
    </div>
  </div>
</section> 