<x-layout :showHeader="true" :showHero="false" title="Layanan - Dwi AC Mobil">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100..900;1,100..900&display=swap');
    * { font-family: 'Montserrat Alternates', sans-serif; }
  </style>
  <section class="relative font-['Montserrat_Alternates']">
    <!-- Banner Atas -->
    <div class="bg-[#0F044C] text-white">
      <div class="mx-auto max-w-7xl px-6 lg:px-8 py-16 md:py-20 lg:py-24">
        <div class="text-center">
          <span class="inline-flex items-center px-4 py-1 rounded-full bg-white/10 text-white text-sm font-semibold">Layanan kami</span>
          <h1 class="mt-6 text-[48px] font-extrabold tracking-wide uppercase">Kami Hadir Dengan Layanan<br class="hidden sm:block"/> Servis AC Mobil Terbaik</h1>
          <p class="mt-3 text-white/80 text-sm sm:text-base">Servis & Perawatan AC Mobil Anda di Tangan yang Tepat</p>
        </div>
      </div>
    </div>

    <!-- Grid Kartu -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-12 relative -mt-16 md:-mt-24 lg:-mt-32 z-10">
      @php
        $services = [
          ['num' => '01', 'title' => 'Isi Freon', 'desc' => 'Mengisi ulang freon pada sistem AC mobil yang kurang/ habis agar AC kembali dingin dan optimal.', 'img' => '_ea506e83-eaa7-464e-a745-115061c546df_2.png'],
          ['num' => '02', 'title' => 'Cuci Evaporator', 'desc' => 'Membersihkan evaporator dari kotoran dan jamur agar udara lebih bersih dan dingin.', 'img' => 'https://images.unsplash.com/photo-1584714268709-c3dd3a8d8b32?q=80&w=1200&auto=format&fit=crop'],
          ['num' => '03', 'title' => 'Flushing Sistem AC', 'desc' => 'Membersihkan seluruh saluran AC dari oli lama dan kotoran agar sistem bekerja lebih lancar.', 'img' => 'https://images.unsplash.com/photo-1515923162079-8cf13fb90a88?q=80&w=1200&auto=format&fit=crop'],
          ['num' => '04', 'title' => 'Ganti Dryer', 'desc' => 'Mengganti dryer agar sirkulasi freon kembali baik dan menjaga komponen lain.', 'img' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=1200&auto=format&fit=crop'],
          ['num' => '05', 'title' => 'Ganti Oli Kompresor', 'desc' => 'Meningkatkan performa kompresor dengan mengganti oli khusus agar tidak cepat aus atau macet.', 'img' => 'https://images.unsplash.com/photo-1581093576659-3d4d8aa4d50a?q=80&w=1200&auto=format&fit=crop'],
          ['num' => '06', 'title' => 'Ganti Dryer', 'desc' => 'Mengembalikan performa pendinginan melalui penggantian dryer saat jenuh/ tersumbat.', 'img' => 'https://images.unsplash.com/photo-1525609004556-c46c7d6cf023?q=80&w=1200&auto=format&fit=crop'],
        ];
      @endphp

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach ($services as $s)
          <article class="relative rounded-2xl overflow-hidden text-white shadow-xl ring-1 ring-white/10">
            <!-- Foto background -->
            @if (!empty($s['img']))
              <img src="{{ Str::startsWith($s['img'], 'http') ? $s['img'] : asset('images/' . $s['img']) }}" alt="{{ $s['title'] }}" class="absolute inset-0 h-full w-full object-cover" />
              <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#0F044C]/70"></div>
              <div class="absolute inset-0 bg-gradient-to-r from-[#0F044C]/60 via-[#0F044C]/25 to-transparent"></div>
            @else
              <div class="absolute inset-0 bg-[#0F044C]"></div>
              <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#0F044C]/70"></div>
              <div class="absolute inset-0 bg-gradient-to-r from-black/20 via-[#0F044C]/30 to-transparent"></div>
            @endif

            <div class="absolute top-4 left-4 sm:top-5 sm:left-5 md:top-6 md:left-6 z-10 text-white/95 font-extrabold tracking-tight text-[44px] sm:text-[52px]">{{ $s['num'] }}</div>

            <div class="relative p-5 sm:p-8 md:p-10 pt-20 sm:pt-24 md:pt-28 min-h-[420px] md:min-h-[480px] lg:min-h-[560px] flex flex-col h-full justify-start gap-4">
              <div class="flex-1 flex flex-col justify-center">
                <h3 class="mt-2 text-[40px] sm:text-[48px] font-extrabold tracking-wide uppercase">{{ $s['title'] }}</h3>
                <p class="mt-2 text-base sm:text-lg text-white/90 leading-relaxed max-w-prose">{{ $s['desc'] }}</p>
              </div>
              <div class="mt-auto">
                <a href="#" class="inline-flex items-center gap-2 rounded-xl border border-white/50 bg-white/10 px-5 py-3 font-semibold text-white hover:bg-white/15">Selengkapnya</a>
              </div>
            </div>
          </article>
        @endforeach

        <!-- Kartu lebar (07) -->
        <article class="md:col-span-2 relative rounded-2xl overflow-hidden text-white shadow-xl">
          <img src="{{ asset('images/_ea506e83-eaa7-464e-a745-115061c546df_2.png') }}" alt="Diagram AC Mobil" class="absolute inset-0 h-full w-full object-cover" />
          <div class="absolute inset-0 bg-gradient-to-r from-[#0F044C]/90 via-[#0F044C]/45 to-transparent"></div>

          <div class="relative p-3 sm:p-5 md:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
              <div>
                <div class="text-xl font-extrabold tracking-tight text-white/95">07</div>
                <h3 class="mt-2 text-[28px] font-extrabold tracking-wide uppercase">Penggantian Spare Part AC Mobil</h3>
                <p class="mt-2 text-white/85">Kami siap mengganti komponen AC mobil Anda yang rusak atau aus, sesuai standar dan cocok untuk semua jenis kendaraan.</p>
                <ul class="mt-3 grid grid-cols-2 gap-x-3 gap-y-1 text-white/85 text-sm">
                  <li>Freon / Refrigerant</li>
                  <li>Magnetic Clutch</li>
                  <li>Kondensor</li>
                  <li>Cooling Fan</li>
                  <li>Evaporator</li>
                  <li>Blower</li>
                  <li>Dryer / Filter</li>
                  <li>Relay</li>
                  <li>Pressure Switch</li>
                  <li>Selang AC</li>
                </ul>
              </div>
              <div class="flex flex-col justify-end">
                <a href="#" class="inline-flex items-center gap-2 rounded-xl bg-[#787A91] border border-[#787A91] px-3 py-1.5 font-semibold text-white hover:bg-[#787A91]/80 self-end">Selengkapnya</a>
              </div>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>
</x-layout>
