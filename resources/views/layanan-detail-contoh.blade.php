<x-layout :showHeader="true" :showHero="false" :solidHeaderAtTop="true" title="{{ $service['title'] ?? 'Isi Freon' }} - Dwi AC Mobil">
    <!-- Gunakan font yang sudah tersedia secara lokal -->
    <link rel="stylesheet" href="{{ asset('css/custom-fonts.css') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dwi-purple': '#0F044C',
                        'dwi-blue': '#1E3A8A',
                    }
                }
            }
        }
    </script>

    <!-- Section Detail Layanan -->
    <section class="mt-20 py-12 md:py-16 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-left">
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('layanan') }}" class="inline-flex items-center gap-2 text-[#0F044C] hover:text-[#0F044C]/80 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        <span class="defparagraf font-semibold">Kembali ke Layanan</span>
                    </a>
                </div>
                
                <h1 class="font-montserrat-48 text-black mb-6 md:mb-8">{{ strtoupper($service['title'] ?? 'ISI FREON') }}</h1>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                    <!-- Left Column - Service Info -->
                    <div>
                        <!-- Service Image -->
                        <div class="relative overflow-hidden mb-6 rounded-xl border border-[#EEEEEE] shadow-md">
                            <img src="{{ $service['image'] ?? asset('images/layanan/isi-freon.png') }}" 
                                 alt="{{ $service['title'] ?? 'Isi Freon' }}" 
                                 class="w-full h-80 md:h-96 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                            <div class="absolute bottom-3 right-3 bg-[#141E61] text-white px-3 py-1 rounded-md text-xs">Update: {{ $service['updated'] ?? '21 Nov' }}</div>
                        </div>

                        <!-- Meta row: Durasi, Harga, Garansi -->
                        <div class="border border-[#EEEEEE] rounded-xl bg-white p-4 flex flex-wrap items-center gap-6 shadow-sm">
                            <div class="flex items-center gap-2 text-sm text-[#787A91]">
                                <svg class="w-4 h-4 text-[#0F044C]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                                <span>Durasi: {{ $service['duration'] ?? '1-2 jam' }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-[#787A91]">
                                <svg class="w-4 h-4 text-[#0F044C]" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"><g opacity="0.2"><path d="M8.397 5.7c-.551.413-.8.908-.8 1.37s.249.958.8 1.372c.552.414 1.36.7 2.295.7a1 1 0 1 1 0 2c-1.326 0-2.565-.402-3.495-1.1s-1.6-1.738-1.6-2.971s.67-2.274 1.6-2.972C8.127 3.402 9.367 3 10.692 3c2.053 0 3.994.983 4.766 2.62a1 1 0 0 1-1.81.853C13.298 5.726 12.206 5 10.693 5c-.935 0-1.743.286-2.295.7"/><path d="M12.657 14.583c.551-.413.799-.908.799-1.37s-.248-.959-.8-1.372c-.551-.414-1.36-.7-2.295-.7a1 1 0 0 1 0-2c1.327 0 2.566.402 3.496 1.1s1.599 1.738 1.599 2.971s-.669 2.274-1.6 2.971c-.93.698-2.168 1.1-3.495 1.1c-2.052 0-3.994-.983-4.765-2.621a1 1 0 0 1 1.809-.853c.352.748 1.444 1.474 2.956 1.474c.936 0 1.744-.286 2.296-.7M10.5 1a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0V2a1 1 0 0 1 1-1"/><path d="M10.5 16a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0v-1a1 1 0 0 1 1-1"/></g><path d="M7.097 5.3c-.646.484-1 1.115-1 1.77c0 .656.354 1.287 1 1.772s1.562.8 2.595.8a.5.5 0 0 1 0 1c-1.228 0-2.36-.373-3.195-1c-.836-.627-1.4-1.53-1.4-2.571c0-1.04.564-1.945 1.4-2.572c.836-.626 1.967-.999 3.195-.999c1.918 0 3.647.919 4.314 2.334a.5.5 0 0 1-.905.426c-.457-.97-1.761-1.76-3.409-1.76c-1.033 0-1.949.315-2.595.8"/><path d="M11.957 14.983c.646-.484.999-1.116.999-1.77c0-.656-.353-1.287-1-1.772c-.646-.485-1.562-.8-2.594-.8a.5.5 0 1 1 0-1c1.228 0 2.36.373 3.195 1s1.399 1.53 1.399 2.571c0 1.04-.564 1.945-1.4 2.571c-.835.627-1.966 1-3.194 1c-1.918 0-3.647-.919-4.314-2.334a.5.5 0 0 1 .905-.426c.457.97 1.76 1.76 3.409 1.76c1.032 0 1.948-.315 2.595-.8M9 1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 9 1"/><path d="M9 16a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 9 16"/></g></svg>
                                <span>Mulai dari: Rp {{ $service['price_from'] ?? '150.000' }}</span>>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-[#787A91]">
                                <svg class="w-4 h-4 text-[#0F044C]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s-8-4-8-10V5l8-3 8 3v7c0 6-8 10-8 10Z"/></svg>
                                <span>Garansi: {{ $service['warranty'] ?? '7 hari' }}</span>
                            </div>
                        </div>

                        <!-- CTA Card -->
                        <div class="border border-[#EEEEEE] rounded-xl bg-white p-5 shadow-md mt-6">
                            <div class="flex items-center justify-between flex-wrap gap-3">
                                <div>
                                    <div class="defparagraf text-sm text-[#787A91]">Harga mulai</div>
                                    <div class="font-montserrat-48 text-[#0F044C] text-xl">Rp {{ $service['price_from'] ?? '150.000' }}</div>
                                    <div class="defparagraf text-xs text-[#787A91] mt-1">Harga dapat berbeda tergantung model/tipe mobil & kondisi unit.</div>
                                    <details class="mt-2">
                                        <summary class="defparagraf text-xs text-[#0F044C] cursor-pointer underline underline-offset-2">Kenapa harga bisa berbeda?</summary>
                                        <ul class="mt-2 space-y-1 list-disc pl-5 defparagraf text-xs text-[#141E61]">
                                            <li>Model/tipe mobil dan kapasitas refrigerant</li>
                                            <li>Kondisi komponen (kompresor, evaporator, dryer, dll.)</li>
                                            <li>Jenis oli kompresor/refrigerant yang direkomendasikan</li>
                                        </ul>
                                    </details>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ url('/booking') }}" class="inline-flex items-center gap-2 bg-[#0F044C] hover:bg-[#141E61] text-white px-5 py-2 rounded-md defparagraf">Booking Sekarang</a>
                                    <a href="https://wa.me/6281234567890?text={{ urlencode('Halo Dwi AC Mobil, saya ingin tanya estimasi harga layanan ' . ($service['title'] ?? 'Isi Freon') . ' sesuai model mobil saya') }}" target="_blank" class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-md defparagraf">Tanya Harga</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Service Details -->
                    <div class="space-y-6 lg:sticky lg:top-24">
                        <!-- Service Description -->
                        <div class="border border-[#EEEEEE] rounded-xl bg-white p-5 shadow-sm">
                            <h2 class="font-montserrat-36 text-[#0F044C] mb-3">{{ strtoupper($service['title'] ?? 'ISI FREON') }}</h2>
                            <p class="defparagraf text-[#141E61] leading-relaxed">
                                {{ $service['description'] ?? 'Freon adalah komponen utama yang membuat AC mobil mengeluarkan udara dingin. Jika freon berkurang atau habis, AC tidak akan bekerja maksimal. Pengisian harus sesuai tekanan/jenis yang direkomendasikan agar kinerja optimal dan kompresor awet.' }}
                            </p>
                        </div>

                        <!-- Need to Know Section -->
                        <div class="border border-[#EEEEEE] rounded-xl bg-white p-5 shadow-sm">
                            <h3 class="font-montserrat-36 text-[#0F044C] mb-3">PERLU DIKETAHUI</h3>
                            <ul class="space-y-3">
                                @php
                                    $points = $service['points'] ?? [
                                        'Selalu cek tekanan dan kebocoran saat isi freon agar tidak cepat habis.',
                                        'Gunakan jenis refrigerant sesuai spesifikasi pabrikan mobil.',
                                        'Servis berkala menjaga performa dingin dan mencegah kerusakan kompresor.',
                                    ];
                                @endphp
                                @foreach($points as $point)
                                    <li class="flex items-start gap-3">
                                        <div class="w-2 h-2 bg-[#0F044C] rounded-full mt-2"></div>
                                        <p class="defparagraf text-[#141E61]">{{ $point }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
