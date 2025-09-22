{{-- resources/views/components/hero-layanan.blade.php --}}
@props([
  'badge' => 'Selamat Datang di Dwi AC Mobil',
  'heading' => null,
  'subtitle' => null,
  'headerHeight' => '80px',     // desktop / lg
  'headerHeightSm' => '64px',   // mobile / sm
  'minHeight' => '60vh',
])

@php
  $bgUrl = asset('images/hero-background.png');

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
</style>

<section class="hero-layanan relative isolate overflow-hidden z-0"
         style="margin-top: calc(-1 * var(--header-height));">
  <!-- Background image -->
  <div class="absolute inset-0 bg-cover bg-center brightness-90"
       style="background-image: url('{{ $bgUrl }}');"></div>

  <!-- overlays -->
  <div class="absolute inset-0 bg-black/40"></div>
  <div class="absolute inset-0 bg-gradient-to-r from-[#0F044C] to-[#0F044C]/0"></div>

  <!-- inner wrapper -->
  <div class="hero-inner relative mx-auto max-w-7xl px-6 lg:px-8"
       style="padding-top: calc(var(--header-height) + 24px); padding-bottom: 3rem; min-height: {{ $minHeight }};">
    <div class="py-24 sm:py-32">
      <div class="max-w-5xl lg:max-w-6xl text-left">
        {{-- <div class="inline-flex items-center px-5 py-2 bg-[#787A91] h-[40px] rounded-full backdrop-blur-sm text-white mb-6 bigparagraf">
          <span>
            Selamat Datang di <span class="text-[#0F044C]">Dwi AC Mobil</span>
          </span>          
        </div> --}}

        <h1 class="font-montserrat-64 text-white leading-tight uppercase">
          {{ $computedHeading }}
        </h1>

        <p class="mt-6 text-white/80 bighpparagraf">
          {!! nl2br(e($computedSubtitle)) !!}
        </p>

        <div class="mt-10 flex flex-wrap items-center gap-3 sm:gap-4 md:gap-6">
          <a href="{{ auth()->check() ? route('booking') : route('login') }}"
             class="w-full sm:w-[240px] md:w-[275px] h-12 sm:h-14 md:h-[70px]
                    inline-flex items-center justify-center bg-[#0F044C] text-white
                    font-semibold tracking-wide hover:bg-[#0F044C]/90 transition">
            <span class="bigparagraf">Antri & Serviskan!</span>
            <img src="/images/arrows_button/panah-miringkeatas.svg" alt="" class="ml-3 h-5 w-5" />
          </a>
          <a href="/layanan"
             class="w-full sm:w-[240px] md:w-[275px] h-12 sm:h-14 md:h-[70px]
                    inline-flex items-center justify-center border border-white/50 bg-white/20
                    text-white font-semibold hover:bg-white/10 transition">
            <span class="bigparagraf">Jelajahi layanan kami</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>