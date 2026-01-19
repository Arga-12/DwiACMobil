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
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">{{ number_format($stats['total_customers'] ?? 0) }}</p>
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
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">{{ $stats['services_today'] ?? 0 }}</p>
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
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">{{ $stats['active_queue'] ?? 0 }}</p>
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
            <div class="flex items-center justify-between mb-4">
                <p class="bigparafraf font-semibold text-black">Rating Bengkel</p>
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-[#0F044C] hover:underline">kelola rating</a>
            </div>
            <div class="flex items-center gap-4">
                <!-- Inner Box untuk Value -->
                <div class="flex-1 bg-gradient-to-br from-[#1D2C90]/5 to-[#1D2C90]/10 border border-[#1D2C90]/20 rounded-lg p-4">
                    <p class="font-montserrat-36 font-bold text-[#1D2C90]">{{ $stats['average_rating'] ?? '0' }}/5</p>
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
                @if(isset($todayQueue) && $todayQueue->count() > 0)
                    @foreach($todayQueue as $queue)
                    @php
                        $statusColor = match(strtolower($queue->status)) {
                            'pending', 'harga_dari_admin' => 'bg-yellow-50 border-yellow-200 text-yellow-800',
                            'dalam_antrian' => 'bg-blue-50 border-blue-200 text-blue-800',
                            'dalam_servisan' => 'bg-orange-50 border-orange-200 text-orange-800',
                            'selesai' => 'bg-green-50 border-green-200 text-green-800',
                            default => 'bg-gray-50 border-gray-200 text-gray-800'
                        };
                    @endphp
                    <div class="border border-[#0F044C]/10 rounded-xl p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <p class="font-semibold text-[#0F044C]">#{{ $queue->nomor_booking }}</p>
                                <p class="text-sm text-gray-600">{{ optional($queue->pelanggan)->nama ?? '-' }}</p>
                            </div>
                            <span class="px-2 py-1 rounded-full text-xs font-medium border {{ $statusColor }}">
                                {{ ucfirst(str_replace('_', ' ', $queue->status)) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>{{ optional($queue->mobil)->nama_mobil ?? '-' }} ({{ optional($queue->mobil)->plat_nomor ?? '-' }})</span>
                            <span>{{ optional($queue->tanggal_pesan)->format('H:i') ?? '-' }}</span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="border border-dashed border-[#0F044C]/30 rounded-xl p-6 text-center text-sm text-gray-600">Belum ada antrian hari ini</div>
                @endif
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
                $adjustedStartDow = $calendar['adjusted_start_day'] ?? ($startDowCal == 7 ? 6 : $startDowCal - 1);
                $calendarDays = $calendar['days'] ?? [];
            @endphp
            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between mb-4">
                <div class="flex items-center gap-4">
                    <div>
                        <h3 class="font-montserrat-48 font-bold text-[#0F044C]">Kalender</h3>
                        <span class="text-sm text-[#787A91]" id="calendar-month-name">{{ $monthNameCal }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="navigateCalendar(-1)" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-[#0F044C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button type="button" onclick="navigateCalendar(1)" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-[#0F044C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div id="calendar-grid" class="grid grid-cols-6 gap-2 text-xs select-none">
                @foreach(['Sen','Sel','Rab','Kam','Jum','Sab'] as $d)
                    <div class="text-center font-semibold text-[#0F044C]">{{ $d }}</div>
                @endforeach
                @for($i = 0; $i < $adjustedStartDow; $i++)
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

                        // Skip Sunday (dayOfWeek 0)
                        if ($dateObj->dayOfWeek === 0) {
                            continue;
                        }

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
    <div id="calendarTooltip" class="hidden pointer-events-none fixed z-[9999] w-72 max-w-sm bg-white border-2 border-gray-300 rounded-xl shadow-2xl px-4 py-3 text-xs text-gray-700"></div>

    <!-- Customer Data Table -->
    <div>
        <h2 class="text-lg sm:text-xl font-montserrat-48 text-gray-900 font-bold mb-4">ANTRIAN PELANGGAN</h2>
        <div class="bg-white border border-[#0F044C]/20 rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-[#0F044C]/5 to-[#1D2C90]/5 border-b border-[#0F044C]/20">
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Booking</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Kendaraan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-[#0F044C] uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @if(isset($recentCustomers) && $recentCustomers->count() > 0)
                            @foreach($recentCustomers as $customer)
                            @php
                                $statusBadge = match(strtolower($customer->status)) {
                                    'pending', 'harga_dari_admin' => 'bg-yellow-100 text-yellow-800',
                                    'dalam_antrian' => 'bg-blue-100 text-blue-800',
                                    'dalam_servisan' => 'bg-orange-100 text-orange-800',
                                    'selesai' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800'
                                };
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">#{{ $customer->nomor_booking }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ optional($customer->pelanggan)->nama ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ optional($customer->mobil)->nama_mobil ?? '-' }}
                                        <span class="text-gray-500">({{ optional($customer->mobil)->plat_nomor ?? '-' }})</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusBadge }}">
                                        {{ ucfirst(str_replace('_', ' ', $customer->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ optional($customer->tanggal_pesan)->format('d M Y') ?? '-' }}
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Belum ada data pelanggan
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
<script>
    let currentCalendarMonth = {{ $calendarStart->month }};
    let currentCalendarYear = {{ $calendarStart->year }};

    // Define calendar API URL using app URL
    window.calendarApiUrl = '{{ config("app.url") }}/admin/dashboard/calendar-data';

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

    window.navigateCalendar = function(direction) {
        currentCalendarMonth += direction;

        if (currentCalendarMonth > 12) {
            currentCalendarMonth = 1;
            currentCalendarYear++;
        } else if (currentCalendarMonth < 1) {
            currentCalendarMonth = 12;
            currentCalendarYear--;
        }

        loadCalendarData();
    };

    function loadCalendarData() {
        const url = `${window.calendarApiUrl}?month=${currentCalendarMonth}&year=${currentCalendarYear}`;

        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                updateCalendarDisplay(data);
            })
            .catch(error => {
                console.error('Error loading calendar data:', error);
                // Fallback to page refresh if AJAX fails
                window.location.href = `{{ route('admin.dashboard') }}?month=${currentCalendarMonth}&year=${currentCalendarYear}`;
            });
    }

    function updateCalendarDisplay(calendarData) {
        // Update month name
        document.getElementById('calendar-month-name').textContent = calendarData.month_name;

        // Clear and rebuild calendar grid
        const calendarGrid = document.getElementById('calendar-grid');
        calendarGrid.innerHTML = '';

        // Add day headers (Monday to Saturday)
        const dayHeaders = ['Sen','Sel','Rab','Kam','Jum','Sab'];
        dayHeaders.forEach(day => {
            const headerDiv = document.createElement('div');
            headerDiv.className = 'text-center font-semibold text-[#0F044C]';
            headerDiv.textContent = day;
            calendarGrid.appendChild(headerDiv);
        });

        // Add empty cells for start of month
        const adjustedStartDow = calendarData.adjusted_start_day || 0;

        for (let i = 0; i < adjustedStartDow; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.className = 'h-16';
            calendarGrid.appendChild(emptyDiv);
        }

        // Add day cells
        const monthStart = new Date(currentCalendarYear, currentCalendarMonth - 1, 1);
        for (let day = 1; day <= calendarData.days_in_month; day++) {
            const dateObj = new Date(currentCalendarYear, currentCalendarMonth - 1, day);

            // Skip Sunday (day 0)
            if (dateObj.getDay() === 0) continue;

            const dateKey = `${currentCalendarYear}-${String(currentCalendarMonth).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const dayInfo = calendarData.days[dateKey] || null;
            const isHoliday = dayInfo && dayInfo.holiday;
            const bookingCount = dayInfo ? dayInfo.booking_count : 0;

            let dayClasses = 'calendar-day h-16 border rounded-xl flex flex-col items-center justify-center text-gray-700 transition relative';
            if (isHoliday) {
                dayClasses += ' bg-red-50 border-red-300 text-red-700';
            } else if (bookingCount > 0) {
                dayClasses += ' bg-[#1D2C90]/5 border-[#1D2C90]/40 text-[#0F044C]';
            } else {
                dayClasses += ' border-gray-200';
            }

            const dayDiv = document.createElement('div');
            dayDiv.className = dayClasses;

            if (dayInfo) {
                dayDiv.setAttribute('data-day-info', JSON.stringify({
                    date: dayInfo.date || `${day} ${calendarData.month_name.split(' ')[0]} ${currentCalendarYear}`,
                    holiday: dayInfo.holiday || null,
                    bookings: dayInfo.bookings || []
                }));
            }

            const dayNumber = document.createElement('span');
            dayNumber.className = 'text-base font-semibold';
            dayNumber.textContent = day;
            dayDiv.appendChild(dayNumber);

            if (isHoliday) {
                const holidayLabel = document.createElement('span');
                holidayLabel.className = 'text-[10px] text-red-600 font-semibold mt-1';
                holidayLabel.textContent = 'Libur';
                dayDiv.appendChild(holidayLabel);
            } else if (bookingCount > 0) {
                const bookingLabel = document.createElement('span');
                bookingLabel.className = 'text-[10px] text-[#1D2C90] font-medium mt-1';
                bookingLabel.textContent = `${bookingCount} booking`;
                dayDiv.appendChild(bookingLabel);
            }

            calendarGrid.appendChild(dayDiv);
        }

        // Reattach tooltips after calendar update
        if (window.reattachCalendarTooltip) {
            window.reattachCalendarTooltip();
        }
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            window.toggleHolidayModal(false);
        }
    });
</script>
</div>
