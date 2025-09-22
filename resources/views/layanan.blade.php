<x-layout :showHeader="true" :showHero="false" title="Layanan - Dwi AC Mobil">
  
    <x-hero-layanan
    headerHeight="100px"      {{-- tinggi header desktop --}}
    headerHeightSm="68px"    {{-- tinggi header mobile --}}
    heading="KAMI HADIR DENGAN LAYANAN SERVIS AC MOBIL TERBAIK"
    subtitle="Servis & Perawatan AC Mobil Anda di Tangan yang Tepat"
     />

    <!-- Grid Kartu --> 
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-12 relative -mt-16 md:-mt-24 lg:-mt-32 z-10">
      @php
        $services = [
          ['num' => '01', 'title' => 'Isi Freon', 'desc' => 'Mengisi ulang freon pada sistem AC mobil yang kurang/ habis agar AC kembali dingin dan optimal.', 'img' => 'layanan/isi-freon.png', 'slug' => 'isi-freon'],
          ['num' => '02', 'title' => 'Cuci Evaporator', 'desc' => 'Membersihkan evaporator dari kotoran dan jamur agar udara lebih bersih dan dingin.', 'img' => 'layanan/cuci-evap.png', 'slug' => 'cuci-evaporator'],
          ['num' => '03', 'title' => 'Flushing Sistem AC', 'desc' => 'Membersihkan seluruh saluran AC dari oli lama dan kotoran agar sistem bekerja lebih lancar.', 'img' => 'layanan/flushing-ac.png', 'slug' => 'flushing-sistem-ac'],
          ['num' => '04', 'title' => 'Ganti Oli Kompresor & Dryer', 'desc' => 'Mengganti dryer agar sirkulasi freon kembali baik dan menjaga komponen lain.', 'img' => 'layanan/ganti-oli.png', 'slug' => 'ganti-dryer'],
        ];
      @endphp

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach ($services as $s)
          <article class="relative overflow-hidden text-white shadow-xl ring-1 ring-white/10">
            <!-- Foto background -->
            @if (!empty($s['img']))
              <img src="{{ asset('images/' . $s['img']) }}" alt="{{ $s['title'] }}" class="absolute inset-0 h-full w-full object-cover" />
              <div class="absolute inset-0 bg-black/30 bg-gradient-to-t from-[#0F044C] via-transparent to-transparent"></div>
            @else
              <div class="absolute inset-0 bg-[#0F044C]"></div>
              <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#0F044C]/70"></div>
              <div class="absolute inset-0 bg-gradient-to-r from-black/20 via-[#0F044C]/30 to-transparent"></div>
            @endif

            <div class="absolute top-4 left-4 sm:top-5 sm:left-5 md:top-6 md:left-6 z-10 text-white font-montserrat-64 tracking-tight text-[44px] sm:text-[52px]">{{ $s['num'] }}</div>

            <div class="relative p-5 sm:p-8 md:p-10 pt-20 sm:pt-24 md:pt-28 min-h-[420px] md:min-h-[480px] lg:min-h-[560px] flex flex-col h-full justify-start gap-4 defparagraf">
              <div class="flex-1 flex flex-col justify-center">
                <h3 class="mt-2 text-[40px] sm:text-[48px] font-extrabold tracking-wide font-montserrat-48 uppercase">{{ $s['title'] }}</h3>
                <p class="mt-2 text-base sm:text-lg defparagraf leading-relaxed max-w-prose">{{ $s['desc'] }}</p>
              </div>
              <div class="mt-auto">
                <a href="{{ route('layanan.detail') }}" class="inline-flex items-center gap-2 border border-white/50 bg-white/10 px-5 py-3 bigparagraf text-white hover:bg-white/15">Selengkapnya</a>
              </div>
            </div>
          </article>
        @endforeach

        <!-- Kartu lebar (07) -->
        <article class="md:col-span-2 relative overflow-hidden text-white shadow-xl">
          <img src="{{ asset('https://images.unsplash.com/photo-1525609004556-c46c7d6cf023?q=80&w=1200&auto=format&fit=crop') }}" alt="Diagram AC Mobil" class="absolute inset-0 h-full w-full object-cover" />
          <div class="absolute inset-0 bg-gradient-to-t from-[#0F044C] via-transparent to-transparent"></div>

          <div class="relative p-3 sm:p-5 md:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 defparagraf">
              <div>
                <div class="font-montserrat-48 tracking-tight text-white/95">07</div>
                <h3 class="mt-2 text-[28px] font-montserrat-48 tracking-wide uppercase">Penggantian Spare Part AC Mobil</h3>
                <p class="mt-2 text-white defparagraf">Kami siap mengganti komponen AC mobil Anda yang rusak atau aus, sesuai standar dan cocok untuk semua jenis kendaraan.</p>
                <ul class="mt-3 grid grid-cols-2 gap-x-3 gap-y-1 text-white defparagraf">
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
                <a href="{{ route('layanan.detail') }}" class="inline-flex items-center gap-2 border border-white/50 bg-white/10 px-5 py-3 bigparagraf text-white hover:bg-white/15 self-end">Selengkapnya</a>
              </div>
            </div>
          </div>
        </article>
      </div>
    </div>
</x-layout>
