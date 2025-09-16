<x-admin.dashboard-layout title="Admin Dashboard - Dwi AC Mobil">
    <!-- Dashboard Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 uppercase text-gray-900 mb-2">Admin Dashboard</h1>
            <p class="text-gray-600 defparagraf">Kelola sistem dan monitor aktivitas AC mobil.</p>
        </div>

        <!-- STATISTIK UTAMA Section -->
        <div class="space-y-4">
            {{-- <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-semibold">STATISTIK UTAMA</h2> --}}
            
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                <!-- Total Customers -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm h-[100px]">
                    <div class="flex items-center h-full px-4">
                        <div class="w-12 h-12 bg-[#141E61] rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2S7.5 4.019 7.5 6.5M20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-2xl font-bold defparagraf text-[#0F044C]">200</p>
                            <p class="text-xs defparagraf text-[#787A91]">Jumlah Pelanggan</p>
                        </div>
                    </div>
                </div>

                <!-- Services Today -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm h-[100px]">
                    <div class="flex items-center h-full px-4">
                        <div class="w-12 h-12 bg-[#141E61] rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M425.7 118.25A240 240 0 0 0 76.32 447l.18.2c.33.35.64.71 1 1.05c.74.84 1.58 1.79 2.57 2.78a41.17 41.17 0 0 0 60.36-.42a157.13 157.13 0 0 1 231.26 0a41.18 41.18 0 0 0 60.65.06l3.21-3.5l.18-.2a239.93 239.93 0 0 0-10-328.76ZM240 128a16 16 0 0 1 32 0v32a16 16 0 0 1-32 0ZM128 304H96a16 16 0 0 1 0-32h32a16 16 0 0 1 0 32m48.8-95.2a16 16 0 0 1-22.62 0l-22.63-22.62a16 16 0 0 1 22.63-22.63l22.62 22.63a16 16 0 0 1 0 22.62m149.3 23.1l-47.5 75.5a31 31 0 0 1-7 7a30.11 30.11 0 0 1-35-49l75.5-47.5a10.23 10.23 0 0 1 11.7 0a10.06 10.06 0 0 1 2.3 14m31.72-23.1a16 16 0 0 1-22.62-22.62l22.62-22.63a16 16 0 0 1 22.63 22.63ZM416 304h-32a16 16 0 0 1 0-32h32a16 16 0 0 1 0 32"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-2xl font-bold defparagraf text-[#0F044C]">15</p>
                            <p class="text-xs defparagraf text-[#787A91]">Total servis selama ini</p>
                        </div>
                    </div>
                </div>

                <!-- Rating -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm h-[100px]">
                    <div class="flex items-center h-full px-4">
                        <div class="w-12 h-12 bg-[#141E61] rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m12 18.26l-7.053 3.948l1.575-7.928L.588 8.792l8.027-.952L12 .5l3.385 7.34l8.027.952l-5.934 5.488l1.575 7.928z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-2xl font-bold defparagraf text-[#0F044C]">4.5/5</p>
                            <p class="text-xs defparagraf text-[#787A91]">Rating Pelanggan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MANAJEMEN ANTRIAN & KALENDER Section -->
        <div class="space-y-4">
            {{-- <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-semibold">MANAJEMEN ANTRIAN & KALENDER</h2> --}}
            
            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-5">
                <!-- Queue Management -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4">
                    <h3 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-semibold mb-4 uppercase">Antrian Hari Ini</h3>
                        
                    <!-- Service Cards -->
                    <div class="space-y-3">
                        <!-- Isi Freon Card -->
                        <div class="bg-white border-2 border-gray-800 shadow-sm p-3">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-semibold defparagraf text-[#0F044C] text-sm">Isi Freon</h4>
                                <span class="text-xs defparagraf text-[#787A91]">09:00-10:00</span>
                            </div>
                            <p class="text-xs defparagraf text-[#787A91] mb-2">10 Juni 2025</p>
                            <div class="mb-1">
                                <div class="text-xs defparagraf text-[#0F044C] font-medium">Ritsu Tainaka</div>
                                <div class="text-xs defparagraf text-[#787A91]">Mitsubishi Lancer</div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex space-x-2">
                                    <button class="px-3 py-1 bg-white border border-[#0F044C] defparagraf text-xs text-[#0F044C] hover:bg-[#EEEEEE] transition-colors">Selesai</button>
                                    <button
                                        class="px-3 py-1 bg-[#141E61] defparagraf text-xs text-white hover:bg-[#0F044C] transition-colors btn-detail-struk"
                                        data-receipt-id="BK-0001"
                                        data-receipt-date="10 Juni 2025"
                                        data-receipt-time="09:00-10:00"
                                        data-receipt-car="Mitsubishi Lancer"
                                        data-receipt-services='["Isi Freon"]'
                                        data-receipt-status="admin"
                                        data-edit-url="/admin/struk/edit/BK-0001"
                                    >Detail Struk</button>
                                </div>
                                <div class="text-sm defparagraf text-[#0F044C] font-semibold">Rp 350.000</div>
                            </div>
                        </div>

                        <!-- Second Service Card -->
                        <div class="bg-white border-2 border-gray-800 shadow-sm p-3">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-semibold defparagraf text-[#0F044C] text-sm">Ganti Evaporator</h4>
                                <span class="text-xs defparagraf text-[#787A91]">11:00-12:00</span>
                            </div>
                            <p class="text-xs defparagraf text-[#787A91] mb-2">10 Juni 2025</p>
                            <div class="mb-1">
                                <div class="text-xs defparagraf text-[#0F044C] font-medium">Mio Akiyama</div>
                                <div class="text-xs defparagraf text-[#787A91]">Dodge Charger 1970</div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex space-x-2">
                                    <button class="px-3 py-1 bg-white border border-[#0F044C] defparagraf text-xs text-[#0F044C] hover:bg-[#EEEEEE] transition-colors">Selesai</button>
                                    <button
                                        class="px-3 py-1 bg-[#141E61] defparagraf text-xs text-white hover:bg-[#0F044C] transition-colors btn-detail-struk"
                                        data-receipt-id="BK-0002"
                                        data-receipt-date="10 Juni 2025"
                                        data-receipt-time="11:00-12:00"
                                        data-receipt-car="Dodge Charger 1970"
                                        data-receipt-services='["Ganti Evaporator"]'
                                        data-receipt-status="admin"
                                        data-edit-url="/admin/struk/edit/BK-0002"
                                    >Detail Struk</button>
                                </div>
                                <div class="text-sm defparagraf text-[#0F044C] font-semibold">Rp 1.200.000</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar Widget -->
                <div class="bg-white border-2 border-[#0F044C] shadow-sm p-4">
                    <!-- Header: Month and Navigation (styling aligned with beranda) -->
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-semibold uppercase">SEPTEMBER 2025</h3>
                        <div class="flex items-center gap-3">
                            <button type="button" class="w-8 h-8 rounded-full bg-gray-300 hover:bg-gray-400 transition flex items-center justify-center">
                                <img src="/images/arrows_button/panahkiri.svg" alt="Sebelumnya" class="w-4 h-4" />
                            </button>
                            <button type="button" class="w-8 h-8 rounded-full bg-gray-300 hover:bg-gray-400 transition flex items-center justify-center">
                                <img src="/images/arrows_button/panahkanan.svg" alt="Selanjutnya" class="w-4 h-4" />
                            </button>
                        </div>
                    </div>

                    <!-- Calendar Grid (6 columns, same as beranda) -->
                    <div class="w-full">
                        <div class="grid grid-cols-6 gap-0.5">
                            <!-- Days of Week Header -->
                            <div class="h-10 bigparagraf flex items-center justify-center text-gray-700">Senin</div>
                            <div class="h-10 bigparagraf flex items-center justify-center text-gray-700">Selasa</div>
                            <div class="h-10 bigparagraf flex items-center justify-center text-gray-700">Rabu</div>
                            <div class="h-10 bigparagraf flex items-center justify-center text-gray-700">Kamis</div>
                            <div class="h-10 bigparagraf flex items-center justify-center text-gray-700">Jumat</div>
                            <div class="h-10 bigparagraf flex items-center justify-center text-gray-700">Sabtu</div>

                            @php
                                // Sample bookings detail keyed by date for the modal (contoh data)
                                $bookingsByDate = [
                                    2 => [
                                        ['time' => '09:00-10:00', 'service' => 'Isi Freon', 'customer' => 'Ritsu Tainaka', 'vehicle' => '2 Mtr Antrean NA'],
                                    ],
                                    3 => [
                                        ['time' => '11:00-12:00', 'service' => 'Ganti Evaporator', 'customer' => 'Mio Akiyama', 'vehicle' => 'Dodge Charger 1970'],
                                    ],
                                    12 => [
                                        ['time' => '08:30-09:30', 'service' => 'Ganti Evaporator', 'customer' => 'Kotobuki Tsumugi', 'vehicle' => 'Avanza 2014'],
                                        ['time' => '10:00-11:00', 'service' => 'Cek Kebocoran', 'customer' => 'Nakano Azusa', 'vehicle' => 'Jazz 2012'],
                                    ],
                                    20 => [
                                        ['time' => '13:00-14:00', 'service' => 'Pasang AC Baru', 'customer' => 'Yui Hirasawa', 'vehicle' => 'Yaris 2016'],
                                    ],
                                ];

                                // Penentuan status tanggal otomatis mengikuti data contoh di atas
                                $current = \Carbon\Carbon::now();
                                $currentYear = (int) $current->year;
                                $currentMonth = (int) $current->month;
                                $todayDay = (int) $current->day;

                                // Sesuaikan jika kalender ingin ditampilkan untuk bulan/tahun tertentu
                                // Untuk saat ini mengikuti bulan & tahun berjalan
                                $displayYear = $currentYear;
                                $displayMonth = $currentMonth;

                                $daysInMonth = \Carbon\Carbon::create($displayYear, $displayMonth, 1)->daysInMonth;
                                $holidays = [5, 29, 30]; // contoh hari libur

                                $dates = [];
                                for ($d = 1; $d <= $daysInMonth; $d++) {
                                    if (in_array($d, $holidays, true)) {
                                        $status = 'holiday';
                                    } elseif (!empty($bookingsByDate[$d] ?? [])) {
                                        $status = 'booked';
                                    } else {
                                        $status = 'available';
                                    }

                                    // Permintaan: banyakin status booked dari tanggal 1 hingga 20, kecuali tanggal 5
                                    if ($d >= 1 && $d <= 20 && !in_array($d, $holidays, true)) {
                                        $status = 'booked';
                                        // Pastikan tooltip/modal konsisten: isi 1 booking dummy jika belum ada
                                        if (empty($bookingsByDate[$d] ?? [])) {
                                            $bookingsByDate[$d] = [
                                                [
                                                    'time' => '-',
                                                    'service' => 'Slot terisi',
                                                    'customer' => '-',
                                                    'vehicle' => '-',
                                                ]
                                            ];
                                        }
                                    }
                                    $dates[] = [
                                        'date' => $d,
                                        'status' => $status,
                                        'is_today' => ($d === $todayDay && $displayMonth === $currentMonth && $displayYear === $currentYear),
                                    ];
                                }
                            @endphp

                            @foreach($dates as $dateInfo)
                                @php
                                    $bgColor = match($dateInfo['status']) {
                                        'available' => 'bg-white border border-gray-300',
                                        'booked' => 'bg-gray-400 border border-gray-500',
                                        'holiday' => 'bg-red-200 border border-red-300',
                                        default => 'bg-white border border-gray-300'
                                    };
                                    $textColor = match($dateInfo['status']) {
                                        'available' => 'text-black',
                                        'booked' => 'text-gray-700',
                                        'holiday' => 'text-red-800',
                                        default => 'text-black'
                                    };
                                    $date = $dateInfo['date'];
                                    $status = $dateInfo['status'];
                                    $isToday = $dateInfo['is_today'] ?? false;
                                    // Pastikan styling HARI INI menimpa status apapun (booked/available/holiday)
                                    $boxClasses = $isToday ? 'bg-[#141E61] border border-[#141E61]' : $bgColor;
                                    if ($isToday) { $textColor = 'text-white'; }
                                @endphp
                                <div
                                    class="h-20 p-2 {{ $boxClasses }} flex flex-col items-start justify-start cursor-pointer hover:opacity-80 transition admin-day-cell"
                                    data-date="{{ $date }}"
                                    data-status="{{ $status }}"
                                    data-bookings='@json($bookingsByDate[$date] ?? [])'
                                >
                                    <span class="text-base bigparagraf {{ $textColor }}">{{ $date }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Legend (optional for admin, mirrors beranda) -->
                    <div class="mt-4 flex items-center gap-6">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 bg-white border border-gray-300"></div>
                            <span class="defparagraf text-black text-xs">Bisa di-booking</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 bg-gray-400 border border-gray-500"></div>
                            <span class="defparagraf text-black text-xs">Sudah ada antrian</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 bg-red-200 border border-red-300"></div>
                            <span class="defparagraf text-black text-xs">Libur</span>
                        </div>
                    </div>
                </div>

                <!-- Hover Tooltip for calendar cells -->
                <div id="adminTooltip" class="fixed pointer-events-none hidden z-40 px-3 py-2 bg-white border border-gray-300 shadow-md text-xs defparagraf text-[#0F044C] max-w-xs"></div>

                <!-- Modal: Day Detail -->
                <div id="dayDetailModal" class="fixed inset-0 z-50 hidden">
                    <div class="absolute inset-0 bg-black/50" data-modal-overlay></div>
                    <div class="relative mx-auto mt-20 w-[90%] max-w-md bg-white border border-gray-300 shadow-lg">
                        <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                            <h4 id="modalDateTitle" class="bigparagraf text-black">Detail Hari</h4>
                            <button type="button" class="text-black hover:opacity-70" data-modal-close>&times;</button>
                        </div>
                        <div class="p-4 space-y-3" id="modalContent">
                            <!-- Content populated by JS -->
                        </div>
                        <div class="px-4 py-3 border-t border-gray-200 text-right">
                            <button type="button" class="px-4 py-2 border border-gray-300 hover:bg-gray-100 defparagraf text-sm" data-modal-close>Tutup</button>
                        </div>
                    </div>
                </div>

                <!-- Include the user booking receipt modal component so admin can reuse the same UI -->
                <x-user.booking-receipt-modal />

                <script>
                    (function(){
                        var cells = document.querySelectorAll('.admin-day-cell');
                        var modal = document.getElementById('dayDetailModal');
                        var modalTitle = document.getElementById('modalDateTitle');
                        var modalContent = document.getElementById('modalContent');
                        var tooltip = document.getElementById('adminTooltip');
                        function openModal(){ modal.classList.remove('hidden'); }
                        function closeModal(){ modal.classList.add('hidden'); }
                        function showTooltip(html){ if(!tooltip) return; tooltip.innerHTML = html; tooltip.classList.remove('hidden'); }
                        function moveTooltip(e){ if(!tooltip) return; var x = e.clientX + 12; var y = e.clientY + 12; tooltip.style.left = x + 'px'; tooltip.style.top = y + 'px'; }
                        function hideTooltip(){ if(!tooltip) return; tooltip.classList.add('hidden'); }
                        function buildTooltipContent(date, status, bookings){
                            if(status === 'holiday') {
                                return '<div class="text-red-700">Libur: tidak menerima booking.</div>';
                            }
                            if(!bookings || bookings.length === 0){
                                return '<div class="text-gray-700">Tidak ada booking. Tanggal tersedia.</div>';
                            }
                            var html = '<div class="font-semibold text-[#0F044C] mb-1">Booking (' + bookings.length + ')</div>';
                            html += bookings.map(function(b){
                                return '<div class="mb-1">'
                                    + '<div class="flex justify-between">'
                                    +   '<span class="text-[#0F044C]">' + (b.service || '-') + '</span>'
                                    +   '<span class="text-[#787A91]">' + (b.time || '-') + '</span>'
                                    + '</div>'
                                    + '<div class="text-[#787A91]">' + (b.customer || '-') + '</div>'
                                    + '<div class="text-[#787A91]">' + (b.vehicle || '-') + '</div>'
                                    + '</div>';
                            }).join('');
                            return html;
                        }
                        modal && modal.addEventListener('click', function(e){
                            if (e.target.matches('[data-modal-close]') || e.target.hasAttribute('data-modal-overlay')) {
                                closeModal();
                            }
                        });
                        cells.forEach(function(cell){
                            // Hover tooltip handlers
                            cell.addEventListener('mouseenter', function(e){
                                var date = this.getAttribute('data-date');
                                var status = this.getAttribute('data-status');
                                var bookings = [];
                                try { bookings = JSON.parse(this.getAttribute('data-bookings') || '[]'); } catch (err) { bookings = []; }
                                var html = buildTooltipContent(date, status, bookings);
                                showTooltip(html);
                                moveTooltip(e);
                            });
                            cell.addEventListener('mousemove', moveTooltip);
                            cell.addEventListener('mouseleave', hideTooltip);

                            cell.addEventListener('click', function(){
                                var date = this.getAttribute('data-date');
                                var status = this.getAttribute('data-status');
                                var bookings = [];
                                try { bookings = JSON.parse(this.getAttribute('data-bookings') || '[]'); } catch (e) { bookings = []; }
                                modalTitle.textContent = 'Detail Booking -  ' + date + ' September 2025';
                                modalContent.innerHTML = '';
                                if (status === 'holiday') {
                                    modalContent.innerHTML = '<div class="defparagraf text-red-700">Bengkel libur pada tanggal ini.</div>';
                                } else if (bookings.length === 0) {
                                    modalContent.innerHTML = '<div class="defparagraf text-gray-700">Tidak ada booking. Tanggal tersedia.</div>';
                                } else {
                                    bookings.forEach(function(b){
                                        var item = document.createElement('div');
                                        item.className = 'border border-gray-200 p-3';
                                        item.innerHTML = '<div class="flex items-center justify-between mb-1"'
                                            + '<div class="font-semibold defparagraf text-[#0F044C] text-sm">' + (b.service || '-') + '</div>'
                                            + '<span class="text-xs defparagraf text-[#787A91]">' + (b.time || '-') + '</span>'
                                            + '</div>'
                                            + '<div class="text-xs defparagraf text-[#787A91]">' + (b.customer || '-') + '</div>'
                                            + '<div class="text-xs defparagraf text-[#787A91]">' + (b.vehicle || '-') + '</div>';
                                        modalContent.appendChild(item);
                                    });
                                }
                                hideTooltip();
                                openModal();
                            });
                        });

                        // Admin queue: wire "Detail Struk" buttons to open the same receipt modal as user
                        var strukButtons = document.querySelectorAll('.btn-detail-struk');
                        strukButtons.forEach(function(btn){
                            btn.addEventListener('click', function(){
                                try {
                                    var services = [];
                                    try { services = JSON.parse(this.dataset.receiptServices || '[]'); } catch (e) { services = []; }
                                    var bookingData = {
                                        id: this.dataset.receiptId || '-',
                                        date: this.dataset.receiptDate || '-',
                                        time: this.dataset.receiptTime || '-',
                                        car: this.dataset.receiptCar || '-',
                                        services: services,
                                        status: this.dataset.receiptStatus || 'admin',
                                        context: 'admin',
                                        editUrl: this.dataset.editUrl || null,
                                        // Optional fields available in modal API:
                                        // address: '', notes: '', pricing: { serviceCost: '', sparepartCost: '', deliveryCost: '', totalCost: '' }
                                    };
                                    if (window.showReceiptModal) {
                                        window.showReceiptModal(bookingData);
                                        adaptReceiptForAdmin(bookingData);
                                    } else {
                                        console.warn('showReceiptModal not found');
                                    }
                                } catch (err) {
                                    console.error('Failed to open receipt modal', err);
                                }
                            });
                        });

                        // Adapt the user receipt modal for admin/mechanic use: hide status flow, add Edit Struk button
                        function adaptReceiptForAdmin(bookingData){
                            try {
                                // Update title/subtitle to mechanic context
                                var titleEl = document.getElementById('modalTitle');
                                var subtitleEl = document.getElementById('modalSubtitle');
                                if (titleEl) titleEl.textContent = 'DETAIL STRUK (Montir)';
                                if (subtitleEl) subtitleEl.textContent = 'Detail Struk Servis - Mode Montir';

                                // Hide status sections entirely
                                var statusSection = document.getElementById('receiptStatusSection');
                                if (statusSection) statusSection.classList.add('hidden');

                                // Add/Edit button in footer next to Tutup
                                var footer = document.querySelector('#bookingReceiptModal .flex.justify-center.mt-6');
                                if (footer && !document.getElementById('adminEditReceiptBtn')) {
                                    var btn = document.createElement('button');
                                    btn.id = 'adminEditReceiptBtn';
                                    btn.className = 'ml-2 px-6 py-2 bg-[#141E61] text-white hover:bg-[#0F044C] transition-colors defparagraf';
                                    btn.textContent = 'Edit Struk';
                                    btn.addEventListener('click', function(){
                                        if (bookingData.editUrl) {
                                            window.location.href = bookingData.editUrl;
                                        } else {
                                            alert('Edit Struk diklik untuk ID: ' + (bookingData.id || '-'));
                                        }
                                    });
                                    footer.appendChild(btn);
                                }
                            } catch (e) {
                                console.warn('Failed to adapt receipt modal for admin', e);
                            }
                        }
                    })();
                </script>
            </div>
        </div>

        <!-- DATA PELANGGAN Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-semibold">DATA PELANGGAN</h2>
            
            <!-- Customer Data Table -->
            <div class="bg-white border-2 border-[#0F044C] shadow-sm p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b-2 border-[#0F044C]">
                                <th class="text-left py-3 px-4 font-semibold defparagraf text-[#0F044C]">Nama</th>
                                <th class="text-left py-3 px-4 font-semibold defparagraf text-[#0F044C]">No HP</th>
                                <th class="text-left py-3 px-4 font-semibold defparagraf text-[#0F044C]">E-mail</th>
                                <th class="text-left py-3 px-6 font-semibold defparagraf text-[#0F044C] w-48">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200 hover:bg-[#EEEEEE]">
                                <td class="py-3 px-4 defparagraf text-[#0F044C]">Ritsu Tainaka</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">0812345678</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">R***@gmail.com</td>
                                <td class="py-3 px-6 font-medium defparagraf text-[#0F044C]">10 September 2025</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-[#EEEEEE]">
                                <td class="py-3 px-4 defparagraf text-[#0F044C]">Mio Akiyama</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">0814444359</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">M***@Gmail.com</td>
                                <td class="py-3 px-6 font-medium defparagraf text-[#0F044C]">11 September 2025</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-[#EEEEEE]">
                                <td class="py-3 px-4 defparagraf text-[#0F044C]">Tsumugi Kotobuki</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">0854646677</td>
                                <td class="py-3 px-4 defparagraf text-[#787A91]">S***@Gmail.com</td>
                                <td class="py-3 px-6 font-medium defparagraf text-[#0F044C]">12 September 2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin.dashboard-layout>