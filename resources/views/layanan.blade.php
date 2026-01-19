<x-layout :showHeader="true" :showHero="false" title="Layanan - Dwi AC Mobil">
  
    <x-hero-layanan
    headerHeight="100px"      {{-- tinggi header desktop --}}
    headerHeightSm="68px"    {{-- tinggi header mobile --}}
    heading="KAMI HADIR DENGAN LAYANAN SERVIS AC MOBIL TERBAIK"
    subtitle="Servis & Perawatan AC Mobil Anda di Tangan yang Tepat"
     />

    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-12 relative -mt-16 md:-mt-24 lg:-mt-32 z-10">
      @php
        $services = [
          ['title' => 'Isi Freon', 'desc' => 'Mengisi ulang refrigerant sesuai spesifikasi pabrikan agar suhu kabin cepat kembali dingin.', 'img' => 'layanan/isi-freon.png', 'duration' => '30–60 menit', 'price_from' => '150.000', 'warranty' => '7 hari', 'updated' => '21 Nov'],
          ['title' => 'Cuci Evaporator', 'desc' => 'Membersihkan evaporator dari jamur/debu agar aliran udara lancar dan bebas bau.', 'img' => 'layanan/cuci-evap.png', 'duration' => '1–2 jam', 'price_from' => '250.000', 'warranty' => '7 hari', 'updated' => '14 Nov'],
          ['title' => 'Flushing Sistem AC', 'desc' => 'Menguras oli lama dan kotoran pada jalur AC untuk memulihkan performa pendinginan.', 'img' => 'layanan/flushing-ac.png', 'duration' => '2–3 jam', 'price_from' => '450.000', 'warranty' => '14 hari', 'updated' => '05 Nov'],
          ['title' => 'Ganti Oli Kompresor & Dryer', 'desc' => 'Menjaga pelumasan kompresor dan menyaring kelembapan agar sistem awet.', 'img' => 'layanan/ganti-oli.png', 'duration' => '1–2 jam', 'price_from' => '350.000', 'warranty' => '14 hari', 'updated' => '28 Okt'],
        ];
        $categories = [
          ['name' => 'Perawatan Berkala'],
          ['name' => 'Pembersihan & Higienis'],
          ['name' => 'Perbaikan & Diagnostik'],
          ['name' => 'Spare Part & Komponen'],
          ['name' => 'Upgrade & Modifikasi'],
        ];
      @endphp

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8 space-y-8">
          @if(isset($articles) && count($articles))
            @foreach($articles as $a)
              @php
                // Handle foto path with priority: uploaded > static > default
                if (!empty($a->foto)) {
                    // Check if it's a URL
                    if (function_exists('str_starts_with') && str_starts_with($a->foto, 'http')) {
                        $img = $a->foto;
                    }
                    // Check if it's uploaded file (in storage)
                    elseif (str_contains($a->foto, '/') && file_exists(storage_path('app/public/' . $a->foto))) {
                        $img = asset('storage/' . $a->foto);
                    }
                    // Check if it's in public/images
                    elseif (file_exists(public_path($a->foto))) {
                        $img = asset($a->foto);
                    }
                    // Fallback to default
                    else {
                        $img = asset('images/layanan/isi-freon.png');
                    }
                } else {
                    $img = asset('images/layanan/isi-freon.png');
                }
                $dur = ($a->durasi_min && $a->durasi_maks)
                  ? (($a->durasi_min >= 60 || $a->durasi_maks >= 60)
                      ? (ceil($a->durasi_min/60) . '–' . ceil($a->durasi_maks/60) . ' jam')
                      : ($a->durasi_min . '–' . $a->durasi_maks . ' menit'))
                  : '-';
                $price = !is_null($a->harga) ? number_format($a->harga,0,',','.') : '-';
                $warranty = $a->garansi_hari ? ($a->garansi_hari . ' hari') : '-';
                $updated = $a->updated_at ? $a->updated_at->format('d M') : '';
              @endphp
              <article class="bg-white border border-[#EEEEEE] rounded-xl overflow-hidden">
                <img src="{{ $img }}" alt="{{ $a->judul }}" class="w-full h-[320px] object-cover" />

                <div class="border-b border-[#EEEEEE] flex items-center justify-between px-4 sm:px-6 py-3">
                  <div class="flex items-center gap-6 text-sm text-[#787A91] defparagraf">
                    <div class="flex items-center gap-2">
                      <svg class="w-4 h-4 text-[#0F044C]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                      <span>Durasi: {{ $dur }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                      <svg class="w-4 h-4 text-[#0F044C]" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"><g opacity="0.2"><path d="M8.397 5.7c-.551.413-.8.908-.8 1.37s.249.958.8 1.372c.552.414 1.36.7 2.295.7a1 1 0 1 1 0 2c-1.326 0-2.565-.402-3.495-1.1s-1.6-1.738-1.6-2.971s.67-2.274 1.6-2.972C8.127 3.402 9.367 3 10.692 3c2.053 0 3.994.983 4.766 2.62a1 1 0 0 1-1.81.853C13.298 5.726 12.206 5 10.693 5c-.935 0-1.743.286-2.295.7"/><path d="M12.657 14.583c.551-.413.799-.908.799-1.37s-.248-.959-.8-1.372c-.551-.414-1.36-.7-2.295-.7a1 1 0 0 1 0-2c1.327 0 2.566.402 3.496 1.1s1.599 1.738 1.599 2.971s-.669 2.274-1.6 2.971c-.93.698-2.168 1.1-3.495 1.1c-2.052 0-3.994-.983-4.765-2.621a1 1 0 0 1 1.809-.853c.352.748 1.444 1.474 2.956 1.474c.936 0 1.744-.286 2.296-.7M10.5 1a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0V2a1 1 0 0 1 1-1"/><path d="M10.5 16a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0v-1a1 1 0 0 1 1-1"/></g><path d="M7.097 5.3c-.646.484-1 1.115-1 1.77c0 .656.354 1.287 1 1.772s1.562.8 2.595.8a.5.5 0 0 1 0 1c-1.228 0-2.36-.373-3.195-1c-.836-.627-1.4-1.53-1.4-2.571c0-1.04.564-1.945 1.4-2.572c.836-.626 1.967-.999 3.195-.999c1.918 0 3.647.919 4.314 2.334a.5.5 0 0 1-.905.426c-.457-.97-1.761-1.76-3.409-1.76c-1.033 0-1.949.315-2.595.8"/><path d="M11.957 14.983c.646-.484.999-1.116.999-1.77c0-.656-.353-1.287-1-1.772c-.646-.485-1.562-.8-2.594-.8a.5.5 0 1 1 0-1c1.228 0 2.36.373 3.195 1s1.399 1.53 1.399 2.571c0 1.04-.564 1.945-1.4 2.571c-.835.627-1.966 1-3.194 1c-1.918 0-3.647-.919-4.314-2.334a.5.5 0 0 1 .905-.426c.457.97 1.76 1.76 3.409 1.76c1.032 0 1.948-.315 2.595-.8M9 1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 9 1"/><path d="M9 16a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 9 16"/></g></svg>
                      <span>Mulai dari: Rp {{ $price }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                      <svg class="w-4 h-4 text-[#0F044C]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s-8-4-8-10V5l8-3 8 3v7c0 6-8 10-8 10Z"/></svg>
                      <span>Garansi: {{ $warranty }}</span>
                    </div>
                  </div>
                  <div class="bg-[#141E61] text-white px-4 py-1.5 rounded-md font-semibold text-sm">{{ $updated }}</div>
                </div>

                <div class="px-4 sm:px-6 py-6">
                  <h3 class="font-montserrat-48 uppercase text-lg sm:text-xl text-[#0F044C]">{{ $a->judul }}</h3>
                  <p class="defparagraf text-[#141E61] mt-2 leading-relaxed">{{ \Illuminate\Support\Str::limit($a->deskripsi, 180) }}</p>
                  <div class="defparagraf text-xs text-[#787A91] mt-2">Harga bersifat estimasi dan tergantung model/tipe mobil serta kondisi unit.</div>
                  @php
                    $liked = session()->has('liked_artikel_' . $a->id);
                    $likes = (int)($a->suka ?? 0);
                  @endphp
                  <div class="mt-5 flex items-center gap-3 flex-wrap">
                    <form method="POST" action="{{ $liked ? route('layanan.unlike', $a->slug) : route('layanan.like', $a->slug) }}">
                      @csrf
                      <button type="submit" class="inline-flex items-center gap-2 border border-[#0F044C] {{ $liked ? 'bg-[#0F044C] text-white' : 'text-[#0F044C] hover:bg-[#0F044C] hover:text-white' }} px-4 py-2 rounded-md defparagraf transition-colors">
                        @if($liked)
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48"><path fill="currentColor" d="M15 8C8.925 8 4 12.925 4 19c0 11 13 21 20 23.326C31 40 44 30 44 19c0-6.075-4.925-11-11-11c-3.72 0-7.01 1.847-9 4.674A10.99 10.99 0 0 0 15 8"/></svg>
                          <span>Batalkan Like</span>
                        @else
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M15 8C8.925 8 4 12.925 4 19c0 11 13 21 20 23.326C31 40 44 30 44 19c0-6.075-4.925-11-11-11c-3.72 0-7.01 1.847-9 4.674A10.99 10.99 0 0 0 15 8"/></svg>
                          <span>Like</span>
                        @endif
                        <span class="ml-1 text-xs {{ $liked ? 'bg-white/20 text-white' : 'bg-[#0F044C]/10 text-[#0F044C]' }} px-2 py-0.5 rounded">{{ $likes }}</span>
                      </button>
                    </form>
                    <a href="{{ route('layanan.detail', $a->slug) }}" class="inline-flex items-center gap-2 bg-[#0F044C] hover:bg-[#141E61] text-white px-5 py-2 rounded-md defparagraf">Lihat Detail Layanan</a>
                    <a href="{{ url('/booking') }}" class="inline-flex items-center gap-2 border border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white px-5 py-2 rounded-md defparagraf">Booking Sekarang</a>
                  </div>
                </div>
              </article>
            @endforeach
          @else
            @foreach($services as $i => $s)
              <article class="bg-white border border-[#EEEEEE] rounded-xl overflow-hidden">
                <img src="{{ asset('images/' . $s['img']) }}" alt="{{ $s['title'] }}" class="w-full h-[320px] object-cover" />

                <div class="border-b border-[#EEEEEE] flex items-center justify-between px-4 sm:px-6 py-3">
                  <div class="flex items-center gap-6 text-sm text-[#787A91] defparagraf">
                    <div class="flex items-center gap-2">
                      <svg class="w-4 h-4 text-[#0F044C]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                      <span>Durasi: {{ $s['duration'] }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                      <svg class="w-4 h-4 text-[#0F044C]" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"><g opacity="0.2"><path d="M8.397 5.7c-.551.413-.8.908-.8 1.37s.249.958.8 1.372c.552.414 1.36.7 2.295.7a1 1 0 1 1 0 2c-1.326 0-2.565-.402-3.495-1.1s-1.6-1.738-1.6-2.971s.67-2.274 1.6-2.972C8.127 3.402 9.367 3 10.692 3c2.053 0 3.994.983 4.766 2.62a1 1 0 0 1-1.81.853C13.298 5.726 12.206 5 10.693 5c-.935 0-1.743.286-2.295.7"/><path d="M12.657 14.583c.551-.413.799-.908.799-1.37s-.248-.959-.8-1.372c-.551-.414-1.36-.7-2.295-.7a1 1 0 0 1 0-2c1.327 0 2.566.402 3.496 1.1s1.599 1.738 1.599 2.971s-.669 2.274-1.6 2.971c-.93.698-2.168 1.1-3.495 1.1c-2.052 0-3.994-.983-4.765-2.621a1 1 0 0 1 1.809-.853c.352.748 1.444 1.474 2.956 1.474c.936 0 1.744-.286 2.296-.7M10.5 1a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0V2a1 1 0 0 1 1-1"/><path d="M10.5 16a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0v-1a1 1 0 0 1 1-1"/></g><path d="M7.097 5.3c-.646.484-1 1.115-1 1.77c0 .656.354 1.287 1 1.772s1.562.8 2.595.8a.5.5 0 0 1 0 1c-1.228 0-2.36-.373-3.195-1c-.836-.627-1.4-1.53-1.4-2.571c0-1.04.564-1.945 1.4-2.572c.836-.626 1.967-.999 3.195-.999c1.918 0 3.647.919 4.314 2.334a.5.5 0 0 1-.905.426c-.457-.97-1.761-1.76-3.409-1.76c-1.033 0-1.949.315-2.595.8"/><path d="M11.957 14.983c.646-.484.999-1.116.999-1.77c0-.656-.353-1.287-1-1.772c-.646-.485-1.562-.8-2.594-.8a.5.5 0 1 1 0-1c1.228 0 2.36.373 3.195 1s1.399 1.53 1.399 2.571c0 1.04-.564 1.945-1.4 2.571c-.835.627-1.966 1-3.194 1c-1.918 0-3.647-.919-4.314-2.334a.5.5 0 0 1 .905-.426c.457.97 1.76 1.76 3.409 1.76c1.032 0 1.948-.315 2.595-.8M9 1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 9 1"/><path d="M9 16a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 9 16"/></g></svg>
                      <span>Mulai dari: Rp {{ $s['price_from'] }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                      <svg class="w-4 h-4 text-[#0F044C]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s-8-4-8-10V5l8-3 8 3v7c0 6-8 10-8 10Z"/></svg>
                      <span>Garansi: {{ $s['warranty'] }}</span>
                    </div>
                  </div>
                  <div class="bg-[#141E61] text-white px-4 py-1.5 rounded-md font-semibold text-sm">{{ $s['updated'] }}</div>
                </div>

                <div class="px-4 sm:px-6 py-6">
                  <h3 class="font-montserrat-48 uppercase text-lg sm:text-xl text-[#0F044C]">{{ $s['title'] }}</h3>
                  <p class="defparagraf text-[#141E61] mt-2 leading-relaxed">{{ $s['desc'] }}</p>
                  <div class="defparagraf text-xs text-[#787A91] mt-2">Harga bersifat estimasi dan tergantung model/tipe mobil serta kondisi unit.</div>
                  <div class="mt-5 flex items-center gap-3 flex-wrap">
                    <a href="{{ route('layanan.detail', \Illuminate\Support\Str::slug($s['title'])) }}" class="inline-flex items-center gap-2 bg-[#0F044C] hover:bg-[#141E61] text-white px-5 py-2 rounded-md defparagraf">Lihat Detail Layanan</a>
                    <a href="{{ url('/booking') }}" class="inline-flex items-center gap-2 border border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white px-5 py-2 rounded-md defparagraf">Booking Sekarang</a>
                  </div>
                </div>
              </article>
            @endforeach
          @endif
        </div>

        <aside class="lg:col-span-4 space-y-8">
          <div class="bg-white border border-[#EEEEEE] rounded-xl p-5">
            <h4 class="font-montserrat-36 uppercase text-[#0F044C]">Kategori Layanan</h4>
            <div class="w-16 h-0.5 bg-[#141E61] mt-2 mb-4"></div>
            <ul class="divide-y divide-gray-200">
              @foreach($categories as $c)
                <li class="py-3 defparagraf flex items-center justify-between">
                  <span>{{ $c['name'] }}</span>
                  <svg class="w-4 h-4 text-[#787A91]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                </li>
              @endforeach
            </ul>
          </div>

          <div class="bg-white border border-[#EEEEEE] rounded-xl p-5">
            <h4 class="font-montserrat-36 uppercase text-[#0F044C]">Jam Operasional</h4>
            <div class="w-16 h-0.5 bg-[#0F044C] mt-2 mb-4"></div>
            <ul class="space-y-1 defparagraf text-[#787A91]">
              <li>Senin–Jumat: 08.00 – 17.00</li>
              <li>Sabtu: 08.00 – 15.00</li>
              <li>Minggu/Libur: Tutup</li>
            </ul>
          </div>

          <div class="bg-white border border-gray-200 rounded-xl p-5">
            <h4 class="font-montserrat-36 uppercase text-gray-900">Kontak Cepat</h4>
            <div class="w-16 h-0.5 bg-[#0F044C] mt-2 mb-4"></div>
            <div class="space-y-3">
              <a href="https://wa.me/6281234567890" target="_blank" class="w-full inline-flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md defparagraf">WhatsApp</a>
              <a href="tel:+6281234567890" class="w-full inline-flex items-center justify-center gap-2 border border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white px-4 py-2 rounded-md defparagraf">Telepon</a>
              <div class="defparagraf text-gray-600">Jl. Contoh Alamat No. 123, Kota Anda</div>
            </div>
          </div>
        </aside>
      </div>
    </div>
</x-layout>
