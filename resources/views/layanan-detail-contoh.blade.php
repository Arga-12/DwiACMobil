<x-layout :showHeader="true" :showHero="false" title="{{ $service['title'] ?? 'Isi Freon' }} - Dwi AC Mobil">
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
    <section class="py-12 md:py-16 bg-white">
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
                        <div class="relative border-2 border-black overflow-hidden mb-8">
                            <img src="{{ $service['image'] ?? asset('images/layanan/isi-freon.png') }}" 
                                 alt="{{ $service['title'] ?? 'Isi Freon' }}" 
                                 class="w-full h-80 md:h-96 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>

                        <!-- Quote -->
                        <blockquote class="bg-gray-50 p-6 border-l-4 border-[#0F044C]">
                            <p class="defparagraf text-black/80 italic">
                                "{{ $service['quote'] ?? 'Isi freon di Dwi AC Mobil dijamin aman, berkualitas, dan sesuai standar pabrik.' }}"
                            </p>
                        </blockquote>
                    </div>

                    <!-- Right Column - Service Details -->
                    <div class="space-y-8">
                        <!-- Service Description -->
                        <div>
                            <h2 class="font-montserrat-36 text-black mb-4">{{ strtoupper($service['title'] ?? 'ISI FREON') }} AC MOBIL</h2>
                            <p class="defparagraf text-black/80 leading-relaxed">
                                {{ $service['description'] ?? 'Freon adalah komponen utama yang membuat AC mobil mengeluarkan udara dingin. Jika freon berkurang atau habis, AC tidak akan bekerja maksimal dan udara yang keluar menjadi panas. Oleh karena itu, isi ulang freon perlu dilakukan secara berkala. Pengisian freon harus sesuai dengan tekanan dan jenis yang direkomendasikan agar kinerja AC tetap optimal dan kompresor tidak cepat rusak. Dengan servis freon yang tepat, kenyamanan berkendara tetap terjaga, terutama di cuaca panas.' }}
                            </p>
                        </div>

                        <!-- Need to Know Section -->
                        <div>
                            <h3 class="font-montserrat-36 text-black mb-4">PERLU DIKETAHUI</h3>
                            <ul class="space-y-3">
                                @php
                                    $points = $service['points'] ?? [
                                        'Setiap kali isi freon, sebaiknya dilakukan pengecekan tekanan dan kebocoran sistem AC agar freon tidak cepat habis.',
                                        'Jenis freon harus disesuaikan dengan spesifikasi mobil Anda untuk hasil yang maksimal dan aman bagi sistem AC.',
                                        'Pengisian freon sebaiknya dilakukan setiap 1 tahun atau saat AC mulai terasa kurang dingin.',
                                        'Jika Anda mencium bau gas atau AC tiba-tiba tidak dingin, bisa jadi ada kebocoran pada sistem freon.',
                                        'Mengemudi dengan AC yang kekurangan freon bisa membuat kompresor dan menyebabkan kerusakan pada sistem AC mobil Anda.'
                                    ];
                                @endphp
                                @foreach($points as $point)
                                    <li class="flex items-start space-x-3">
                                        <div class="w-2 h-2 bg-[#0F044C] rounded-full mt-2 flex-shrink-0"></div>
                                        <p class="defparagraf text-black/80">{{ $point }}</p>
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
