<!-- BENGKEL DASHBOARD MODE -->
<div id="bengkelDashboard" class="dashboard-mode" data-mode="bengkel">
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
    <!-- Hero / Header -->
    <div class="bg-gradient-to-br from-[#0F044C] via-[#1D2C90] to-[#192BC2] text-white rounded-2xl px-6 py-8 sm:px-8 sm:py-10 shadow-xl relative overflow-hidden">
        <div class="absolute inset-0 opacity-20 pointer-events-none">
            <div class="w-56 h-56 bg-white/10 rounded-full blur-3xl absolute -right-16 top-4"></div>
            <div class="w-40 h-40 bg-white/5 rounded-full blur-3xl absolute -left-10 bottom-0"></div>
        </div>
        <div class="relative flex flex-col md:flex-row items-start md:items-center gap-6">
            <div class="flex-1">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-montserrat-48 font-bold leading-tight">Dashboard Bengkel</h1>
                <p class="mt-3 text-sm sm:text-base text-white/80 defparagraf max-w-3xl">
                    Kelola antrian, layanan, dan operasional bengkel dari satu tempat yang terpusat.
                </p>
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.antrian') }}" class="px-5 py-3 bg-white text-[#0F044C] rounded-xl font-semibold defparagraf text-center shadow-lg hover:shadow-xl transition-all duration-200">Kelola Antrian</a>
                    <a href="{{ route('admin.layanan') }}" class="px-5 py-3 border border-white/30 text-white rounded-xl font-semibold defparagraf text-center hover:bg-white/10 transition-all duration-200">Kelola Layanan</a>
                    <a href="{{ route('admin.profil-admin') }}" class="px-5 py-3 border border-white/30 text-white rounded-xl font-semibold defparagraf text-center hover:bg-white/10 transition-all duration-200">Profil</a>
                </div>
            </div>
            <div class="w-full md:w-auto">
                <div class="bg-white/15 border border-white/20 rounded-2xl px-6 py-5 backdrop-blur-sm shadow-lg min-w-[240px]">
                    <p class="text-xs uppercase tracking-[0.3em] text-white/70">Status Sistem</p>
                    <p class="text-3xl font-bold mt-2"><span id="status-time">{{ now()->locale('id')->translatedFormat('H:i:s') }}</span></p>
                    <p class="text-white/70 text-sm">Terakhir diakses • <span id="status-date">{{ now()->locale('id')->translatedFormat('d F Y') }}</span></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Set Tanggal Libur -->
    <div id="holidayModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 relative">
            <button type="button" onclick="window.toggleHolidayModal(false)" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </button>
            <h3 class="text-lg font-montserrat-48 text-gray-900 font-bold mb-1">Tambah Tanggal Libur</h3>
            <p class="text-sm text-gray-500 mb-5">Tandai tanggal libur agar kalender tidak menerima booking.</p>
            <form method="POST" action="{{ route('admin.calendar.holidays.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-[#0F044C] mb-1.5">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-[#0F044C] mb-1.5">Judul</label>
                    <input type="text" name="judul" placeholder="Contoh: Libur Nasional" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-[#0F044C] mb-1.5">Keterangan (opsional)</label>
                    <textarea name="keterangan" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30" placeholder="Catatan tambahan"></textarea>
                </div>
                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" onclick="window.toggleHolidayModal(false)" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-100">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-[#0F044C] to-[#1D2C90] text-white rounded-lg text-sm font-semibold hover:opacity-95">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <!-- Total Customers -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
            <p class="bigparafraf font-semibold text-black mb-4">Total Pelanggan</p>
            <div class="flex items-center gap-4">
                <!-- Inner Box untuk Value -->
                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">200</p>
                </div>
                <!-- SVG Icon -->
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Services Today -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
            <p class="bigparafraf font-semibold text-black mb-4">Servis Hari Ini</p>
            <div class="flex items-center gap-4">
                <!-- Inner Box untuk Value -->
                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">15</p>
                </div>
                <!-- SVG Icon -->
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Queue Status -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
            <p class="bigparafraf font-semibold text-black mb-4">Antrian Aktif</p>
            <div class="flex items-center gap-4">
                <!-- Inner Box untuk Value -->
                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">8</p>
                </div>
                <!-- SVG Icon -->
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-[#1D2C90]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7L4 8v10h16V8zm0-2l8-5H4zM4 8V6v12z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Rating -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-6 min-h-full flex flex-col">
            <p class="bigparafraf font-semibold text-black mb-4">Rating Bengkel</p>
            <div class="flex items-center gap-4">
                <!-- Inner Box untuk Value -->
                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">4.5/5</p>
                </div>
                <!-- SVG Icon -->
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-[#1D2C90]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="m12 18.26l-7.053 3.948l1.575-7.928L.588 8.792l8.027-.952L12 .5l3.385 7.34l8.027.952l-5.934 5.488l1.575 7.928z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid: Antrian & Calendar -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6">
        <!-- Queue Management -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-4 md:p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-montserrat-48 font-bold text-[#0F044C]">Antrian Hari Ini</h3>
                <a href="{{ route('admin.antrian') }}" class="text-sm text-[#0F044C] hover:underline">lihat semua</a>
            </div>
            <div class="space-y-3">
                <!-- Service Cards akan ditambahkan di sini -->
                <div class="border border-dashed border-[#0F044C]/30 rounded-xl p-6 text-center text-sm text-gray-600">Belum ada antrian hari ini</div>
            </div>
        </div>

        <!-- Calendar Widget -->
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-4 md:p-5 relative">
            @php
                $calendar = $calendarContext ?? null;
                $calendarStart = $calendar['month_start'] ?? \Carbon\Carbon::now()->startOfMonth();
                $monthNameCal = $calendar['month_name'] ?? $calendarStart->locale('id')->translatedFormat('F Y');
                $daysInMonthCal = $calendar['days_in_month'] ?? $calendarStart->daysInMonth;
                $startDowCal = $calendar['start_day_of_week'] ?? (int) $calendarStart->copy()->startOfMonth()->dayOfWeekIso;
                $calendarDays = $calendar['days'] ?? [];
            @endphp
            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between mb-4">
                <div>
                    <h3 class="font-montserrat-48 font-bold text-[#0F044C]">Kalender</h3>
                    <span class="text-sm text-[#787A91]">{{ $monthNameCal }}</span>
                </div>
            </div>
            <div class="grid grid-cols-7 gap-2 text-xs select-none">
                @foreach(['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $d)
                    <div class="text-center font-semibold text-[#0F044C]">{{ $d }}</div>
                @endforeach
                @for($i = 1; $i < $startDowCal; $i++)
                    <div class="h-16"></div>
                @endfor
                @for($day = 1; $day <= $daysInMonthCal; $day++)
                    @php
                        $dateObj = $calendarStart->copy()->addDays($day - 1);
                        $dateKey = $dateObj->toDateString();
                        $dayInfo = $calendarDays[$dateKey] ?? null;
                        $isHoliday = $dayInfo && isset($dayInfo['holiday']);
                        $bookingCount = $dayInfo['booking_count'] ?? 0;
                        $dayTooltip = null;

                        if ($dayInfo) {
                            $dayTooltip = [
                                'date' => $dateObj->locale('id')->translatedFormat('d F Y'),
                                'holiday' => $dayInfo['holiday'] ?? null,
                                'bookings' => $dayInfo['bookings'] ?? [],
                            ];
                        }

                        $dayClasses = 'calendar-day h-16 border rounded-xl flex flex-col items-center justify-center text-gray-700 transition relative';
                        if ($isHoliday) {
                            $dayClasses .= ' bg-red-50 border-red-300 text-red-700';
                        } elseif ($bookingCount > 0) {
                            $dayClasses .= ' bg-[#1D2C90]/5 border-[#1D2C90]/40 text-[#0F044C]';
                        } else {
                            $dayClasses .= ' border-gray-200';
                        }
                    @endphp
                    <div class="{{ $dayClasses }}"
                         @if($dayTooltip)
                             data-day-info='@json($dayTooltip, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT)'
                         @endif>
                        <span class="text-base font-semibold">{{ $day }}</span>
                        @if($isHoliday)
                            <span class="text-[10px] text-red-600 font-semibold mt-1">Libur</span>
                        @elseif($bookingCount > 0)
                            <span class="text-[10px] text-[#1D2C90] font-medium mt-1">{{ $bookingCount }} booking</span>
                        @endif
                    </div>
                @endfor
            </div>
            <div class="mt-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="flex gap-3">
                    <a href="{{ route('admin.antrian') }}" class="px-4 py-2 bg-gradient-to-r from-[#0F044C] to-[#1D2C90] text-white rounded-lg shadow hover:opacity-95 transition">
                        Lihat Antrian
                    </a>
                    <a href="{{ route('admin.layanan') }}" class="px-4 py-2 border border-[#0F044C] text-[#0F044C] rounded-lg shadow hover:opacity-95 transition">
                        Kelola Layanan
                    </a>
                </div>
                <button type="button" onclick="window.toggleHolidayModal(true)" class="inline-flex items-center justify-center gap-2 px-4 py-2 border border-red-200 bg-red-50 text-red-700 rounded-lg shadow hover:bg-red-100 transition text-sm font-semibold">
                    Setel Tanggal Libur
                </button>
            </div>
        </div>
    </div>
    <div id="calendarTooltip" class="hidden pointer-events-none fixed z-50 w-64 bg-white border border-gray-200 rounded-xl shadow-xl px-4 py-3 text-xs text-gray-700"></div>

    <!-- Customer Data Table -->
    <div>
        <h2 class="text-lg sm:text-xl font-montserrat-48 text-gray-900 font-bold mb-4">ANTRIAN PELANGGAN</h2>
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md p-4 md:p-5">
            <!-- Table content akan ditambahkan di sini -->
            <div class="text-center text-sm text-gray-600 py-8">
                Tabel data pelanggan akan ditambahkan di sini
            </div>
        </div>
    </div>
    </div>
<script>
    window.toggleHolidayModal = function (show) {
        const modal = document.getElementById('holidayModal');
        if (!modal) return;
        if (show) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    };

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            window.toggleHolidayModal(false);
        }
    });
</script>
</div>

