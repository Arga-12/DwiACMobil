<x-user.dashboard-layout>
    <!-- Notifications Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
            <!-- Header -->
            <div class="mb-4 sm:mb-6 md:mb-8">
                <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 uppercase text-gray-900 font-bold tracking-tight">
                    NOTIFIKASI
                </h1>
                <p class="mt-1 text-gray-600 defparagraf text-sm sm:text-base">
                    Semua pemberitahuan dan update layanan Anda.
                </p>
            </div>

            @php
            $user = auth()->user();
            $unread = collect($user?->unreadNotifications ?? []);
            $read = collect($user?->readNotifications ?? [])->take(20);
            // Gabungkan semua notifikasi untuk mencari waktu mulai (status: dalam_servisan)
            $allNotifications = $unread->concat($read);
            $startServiceMap = $allNotifications
                ->filter(function($n){
                    $d = $n->data ?? [];
                    return strtolower($d['status_to'] ?? '') === \App\Models\AntriStruk::STATUS_DALAM_SERVISAN;
                })
                ->mapWithKeys(function($n){
                    $d = $n->data ?? [];
                    $key = $d['nomor_booking'] ?? null;
                    if (!$key) return [];
                    $at = $d['at'] ?? optional($n->created_at)->toDateTimeString();
                    return [$key => $at];
                });
            // Bagi TERBARU (< 30 menit) dan LAMPAU (>= 30 menit) tanpa melihat status read/unread
            $sortedAll = $allNotifications->sortByDesc(function($n){ return optional($n->created_at)->timestamp; });
            $threshold = \Illuminate\Support\Carbon::now()->subMinutes(30);
            $recent = $sortedAll->filter(function($n) use ($threshold){
                $created = optional($n->created_at);
                return $created && $created->greaterThan($threshold);
            });
            $older = $sortedAll->reject(function($n) use ($threshold){
                $created = optional($n->created_at);
                return $created && $created->greaterThan($threshold);
            });
            @endphp

            <!-- TERBARU Section -->
            <div class="space-y-4 sm:space-y-5">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#1D2C90] to-[#0F044C] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-lg sm:text-xl md:text-2xl font-montserrat-48 text-gray-900 font-bold tracking-wide">TERBARU</h2>
                </div>
                
                @forelse($recent as $n)
                @php
                    $d = $n->data ?? [];
                    $createdAt = optional($n->created_at);
                    $judul = 'Antrian ' . ($d['nomor_booking'] ?? '—');
                    $status = ($d['label_to'] ?? ucfirst($d['status_to'] ?? '-'));
                    $tanggal = $createdAt->locale('id')->translatedFormat('d F Y');
                    $waktu = $createdAt->format('H:i');
                    $mobil = trim(($d['mobil'] ?? '').' '.(($d['plate'] ?? '') ? '(' . $d['plate'] . ')' : '')) ?: '—';

                    // Tampilkan rentang waktu mulai-servis hingga selesai jika status_to = 'selesai'
                    $statusTo = strtolower($d['status_to'] ?? '');
                    $statusBadgeClasses = match ($statusTo) {
                        \App\Models\AntriStruk::STATUS_PENDING, \App\Models\AntriStruk::STATUS_HARGA_DARI_ADMIN => 'bg-[#FFDC7F]/20 text-[#B8941F] border border-[#FFDC7F]/40',
                        \App\Models\AntriStruk::STATUS_DALAM_ANTRIAN => 'bg-[#141E61]/10 text-[#141E61] border border-[#141E61]/30',
                        \App\Models\AntriStruk::STATUS_DALAM_SERVISAN => 'bg-[#C66E52]/15 text-[#A0523C] border border-[#C66E52]/35',
                        \App\Models\AntriStruk::STATUS_SELESAI => 'bg-[#B8C999]/20 text-[#7A8F5C] border border-[#B8C999]/40',
                        default => 'bg-gray-100 text-gray-700 border border-gray-300',
                    };
                    $timeDisplay = $waktu; // default
                    if ($statusTo === \App\Models\AntriStruk::STATUS_SELESAI) {
                        $startAtStr = $startServiceMap[$d['nomor_booking'] ?? ''] ?? null;
                        $endAtStr = $d['at'] ?? optional($n->created_at)->toDateTimeString();
                        try {
                            $startTime = $startAtStr ? \Illuminate\Support\Carbon::parse($startAtStr)->format('H:i') : null;
                            $endTime = $endAtStr ? \Illuminate\Support\Carbon::parse($endAtStr)->format('H:i') : null;
                        } catch (\Exception $e) {
                            $startTime = null; $endTime = null;
                        }
                        $timeDisplay = ($startTime && $endTime) ? ($startTime.' - '.$endTime) : ($endTime ?: $waktu);
                    } elseif ($statusTo === \App\Models\AntriStruk::STATUS_DALAM_SERVISAN) {
                        $timeDisplay = 'Mulai '.$waktu;
                    }
                @endphp
                <div class="bg-white border border-[#0F044C]/20 shadow-md rounded-2xl overflow-hidden">
                    <div class="px-4 sm:px-5 py-4 sm:py-5">
                        <div class="flex flex-col md:flex-row items-stretch justify-between gap-4 sm:gap-6">
                            <div class="flex-1 min-w-0">
                                <p class="font-bold bigparagraf text-gray-900 text-sm sm:text-base md:text-lg mb-1">{{ $judul }} · {{ $mobil }}</p>
                                <p class="bigparagraf text-gray-700 text-xs sm:text-sm">{{ $tanggal }}</p>
                                <div class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs sm:text-sm font-semibold {{ $statusBadgeClasses }}">Status: {{ $status }}</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-stretch justify-between w-full md:w-40 lg:w-48">
                                <div class="flex items-center justify-between md:block md:text-center mb-2 md:mb-3">
                                    <span class="bigparagraf text-gray-900 text-sm sm:text-base font-s-emibold">{{ $timeDisplay }}</span>
                                </div>
                                <a href="{{ route('antrian') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-[#1D2C90] to-[#0F044C] hover:from-[#0F044C] hover:to-[#1D2C90] text-white defparagraf text-xs sm:text-sm font-semibold rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    Detail Struk
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white border border-gray-200 rounded-xl p-8 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 19v-9a6 6 0 0 1 6-6v0a6 6 0 0 1 6 6v9M6 19h12M6 19H4m14 0h2m-9 3h2"/>
                        <circle cx="12" cy="3" r="1"/>
                    </svg>
                    <p class="text-sm text-gray-600">Belum ada notifikasi baru.</p>
                </div>
                @endforelse
            </div>


            <!-- LAMPAU Section -->
            <div class="space-y-4 sm:space-y-5 mt-8 sm:mt-10">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gray-300 to-gray-500 flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                <h2 class="text-lg sm:text-xl md:text-2xl font-montserrat-48 text-gray-900 font-bold tracking-wide">LAMPAU</h2>
                </div>
                
                @forelse($older as $n)
                @php
                    $d = $n->data ?? [];
                    $createdAt = optional($n->created_at);
                    $judul = 'Antrian ' . ($d['nomor_booking'] ?? '—');
                    $status = ($d['label_to'] ?? ucfirst($d['status_to'] ?? '-'));
                    $tanggal = $createdAt->locale('id')->translatedFormat('d F Y');
                    $waktu = $createdAt->format('H:i');
                    $mobil = trim(($d['mobil'] ?? '').' '.(($d['plate'] ?? '') ? '(' . $d['plate'] . ')' : '')) ?: '—';

                    // Tampilkan rentang waktu mulai-servis hingga selesai jika status_to = 'selesai'
                    $statusTo = strtolower($d['status_to'] ?? '');
                    $statusBadgeClasses = match ($statusTo) {
                        \App\Models\AntriStruk::STATUS_PENDING, \App\Models\AntriStruk::STATUS_HARGA_DARI_ADMIN => 'bg-[#FFDC7F]/20 text-[#B8941F] border border-[#FFDC7F]/40',
                        \App\Models\AntriStruk::STATUS_DALAM_ANTRIAN => 'bg-[#141E61]/10 text-[#141E61] border border-[#141E61]/30',
                        \App\Models\AntriStruk::STATUS_DALAM_SERVISAN => 'bg-[#C66E52]/15 text-[#A0523C] border border-[#C66E52]/35',
                        \App\Models\AntriStruk::STATUS_SELESAI => 'bg-[#B8C999]/20 text-[#7A8F5C] border border-[#B8C999]/40',
                        default => 'bg-gray-100 text-gray-700 border border-gray-300',
                    };
                    $timeDisplay = $waktu; // default
                    if ($statusTo === \App\Models\AntriStruk::STATUS_SELESAI) {
                        $startAtStr = $startServiceMap[$d['nomor_booking'] ?? ''] ?? null;
                        $endAtStr = $d['at'] ?? optional($n->created_at)->toDateTimeString();
                        try {
                            $startTime = $startAtStr ? \Illuminate\Support\Carbon::parse($startAtStr)->format('H:i') : null;
                            $endTime = $endAtStr ? \Illuminate\Support\Carbon::parse($endAtStr)->format('H:i') : null;
                        } catch (\Exception $e) {
                            $startTime = null; $endTime = null;
                        }
                        $timeDisplay = ($startTime && $endTime) ? ($startTime.' - '.$endTime) : ($endTime ?: $waktu);
                    } elseif ($statusTo === \App\Models\AntriStruk::STATUS_DALAM_SERVISAN) {
                        $timeDisplay = 'Mulai '.$waktu;
                    }
                @endphp
                <div class="bg-white border border-[#0F044C]/15 shadow-md rounded-2xl overflow-hidden">
                    <div class="px-4 sm:px-5 py-4 sm:py-5">
                        <div class="flex flex-col md:flex-row items-stretch justify-between gap-4 sm:gap-6">
                            <div class="flex-1 min-w-0">
                                <p class="font-bold bigparagraf text-gray-900 text-sm sm:text-base md:text-lg mb-1">{{ $judul }} · {{ $mobil }}</p>
                                <p class="bigparagraf text-gray-700 text-xs sm:text-sm">{{ $tanggal }}</p>
                                <div class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs sm:text-sm font-semibold {{ $statusBadgeClasses }}">Status: {{ $status }}</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-stretch justify-between w-full md:w-40 lg:w-48">
                                <div class="flex items-center justify-between md:block md:text-center mb-2 md:mb-3">
                                    <span class="bigparagraf text-gray-900 text-sm sm:text-base font-semibold">{{ $timeDisplay }}</span>
                                </div>
                                <a href="{{ route('antrian') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-[#0F044C]/40 text-[#0F044C] hover:bg-[#141E61] hover:text-white defparagraf text-xs sm:text-sm font-semibold rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    Detail Struk
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white border border-gray-200 rounded-xl p-8 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm text-gray-600">Belum ada notifikasi lampau.</p>
                </div>
                @endforelse
            </div>
    </div>
        <!-- Include Booking Receipt Modal Component -->
        <x-user.booking-receipt-modal />

        <script></script>
</x-user.dashboard-layout>