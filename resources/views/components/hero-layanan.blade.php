@props([
  'badge' => 'Layanan kami',
  'heading' => 'KAMI HADIR DENGAN LAYANAN SERVIS AC MOBIL TERBAIK',
  'subtitle' => 'Servis & Perawatan AC Mobil Anda di Tangan yang Tepat',
  // sesuaikan height header fixed-mu, mis. "72px" atau "80px"
  'headerHeight' => '72px',
  'minHeight' => '60vh',
])

@php
  $negMargin = "calc(-1 * {$headerHeight})";
  $innerPadTop = "calc({$headerHeight} + 24px)"; // 24px = jarak tambahan supaya judul tidak nempel ke header
@endphp

<section class="relative isolate overflow-hidden z-0" style="margin-top: {{ $negMargin }};">
  <!-- Solid background color / or image -->
  <div class="absolute inset-0 bg-[#0F044C]"></div>

  <div class="relative mx-auto max-w-7xl px-6 lg:px-8" style="padding-top: {{ $innerPadTop }}; padding-bottom: 3rem; min-height: {{ $minHeight }};">
    <div class="py-24 sm:py-32 flex items-center">
      <div class="max-w-4xl lg:max-w-5xl mx-auto text-center">
        <!-- Optional badge -->
        <div class="inline-flex items-center px-5 py-2 bg-[#787A91] h-[40px] rounded-full backdrop-blur-sm text-white mb-6 bigparagraf">
          <span>{{ $badge }}</span>
        </div>

        <!-- Main heading -->
        <h1 class="font-montserrat-48 text-white leading-tight uppercase">
          {{ $heading }}
        </h1>

        <!-- Subtitle / content -->
        <p class="mt-6 text-white/80 text-lg defparagrah">
          {{ $subtitle }}
        </p>
      </div>
    </div>
  </div>
</section>
