    <x-user.dashboard-layout>
    <!-- Header Section -->
    <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
        <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 uppercase text-gray-900 font-bold mb-2 tracking-tight">BOOKING ANTRIAN</h1>
        <p class="text-gray-600 defparagraf text-sm sm:text-base">Booking mobil Anda dengan mengambil tanggal yang tersedia pada kalender di sebelah kanan.</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-gradient-to-r from-green-50 to-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-xl shadow-sm">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Error Messages -->
    @if($errors->any())
        <div class="mb-6 bg-gradient-to-r from-red-50 to-red-100 border border-red-300 text-red-800 px-5 py-4 rounded-xl shadow-sm">
            <div class="flex items-start space-x-2">
                <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="font-medium">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <style>
        input[type="date"].no-native-datepicker::-webkit-calendar-picker-indicator{opacity:0;display:none;}
        input[type="date"].no-native-datepicker::-webkit-inner-spin-button,
        input[type="date"].no-native-datepicker::-webkit-clear-button{display:none;}
        input[type="date"].no-native-datepicker{-webkit-appearance:none;-moz-appearance:textfield;appearance:none;}
    </style>
    <!-- Booking Form -->
    <div id="bookingForm">
        <div class="bg-white border border-[#0F044C]/20 shadow-md rounded-2xl p-6 sm:p-8 mb-6">
            <form method="POST" action="{{ route('booking.store') }}" class="space-y-6 sm:space-y-8">
                @csrf
                
                <!-- Date and Time Selection -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2.5">Tanggal Booking</label>
                        <div class="relative">
                            <input id="tanggalBookingInput" type="text" name="tanggal_booking" value="{{ old('tanggal_booking') }}" min="{{ date('Y-m-d') }}" data-blocked-dates='@json($blockedDates ?? [])' data-booked-dates='@json($partiallyBookedDates ?? [])' data-holidays='@json($holidays ?? [])' data-skip-sunday="1" placeholder="YYYY-MM-DD"
                            class="w-full h-12 px-4 py-2 border border-[#0F044C]/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] defparagraf transition-all duration-200 appearance-none pr-10 no-native-datepicker" required readonly inputmode="none" autocomplete="off">
                            <button type="button" id="openDatePickerBtn" class="absolute right-3 top-1/2 -translate-y-1/2 p-1 rounded-md hover:bg-[#1D2C90]/10 focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30">
                                <svg class="w-5 h-5 text-[#1D2C90]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 14a1 1 0 1 0-1-1a1 1 0 0 0 1 1m5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1m-5 4a1 1 0 1 0-1-1a1 1 0 0 0 1 1m5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1M7 14a1 1 0 1 0-1-1a1 1 0 0 0 1 1M19 4h-1V3a1 1 0 0 0-2 0v1H8V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9h16Zm0-11H4V7a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1ZM7 18a1 1 0 1 0-1-1a1 1 0 0 0 1 1"/>
                                </svg>
                            </button>
                            <p id="dateBlockedMsg" class="mt-1 text-xs text-red-600 hidden">Tanggal penuh. Silakan pilih tanggal lain.</p>
                            <div id="bookingDatePopover" class="absolute right-0 top-[110%] z-50 hidden"></div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2.5">Jam Booking</label>
                        <div class="relative">
                            <select name="jam_booking" class="w-full h-12 px-4 py-2 border border-[#0F044C]/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] defparagraf appearance-none transition-all duration-200 bg-white" required>
                                <option value="">Pilih jam...</option>
                                <option value="08:00" {{ old('jam_booking') == '08:00' ? 'selected' : '' }}>08:00</option>
                                <option value="08:30" {{ old('jam_booking') == '08:30' ? 'selected' : '' }}>08:30</option>
                                <option value="09:00" {{ old('jam_booking') == '09:00' ? 'selected' : '' }}>09:00</option>
                                <option value="09:30" {{ old('jam_booking') == '09:30' ? 'selected' : '' }}>09:30</option>
                                <option value="10:00" {{ old('jam_booking') == '10:00' ? 'selected' : '' }}>10:00</option>
                                <option value="10:30" {{ old('jam_booking') == '10:30' ? 'selected' : '' }}>10:30</option>
                                <option value="11:00" {{ old('jam_booking') == '11:00' ? 'selected' : '' }}>11:00</option>
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car Selection -->
                <div>
                    <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2.5">Pilih Mobil Anda</label>
                    <div class="relative">
                        <select name="id_mobil" class="w-full h-12 px-4 py-2 border border-[#0F044C]/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] defparagraf appearance-none transition-all duration-200 bg-white" required>
                            <option value="">Pilih mobil...</option>
                            @php
                                $prefCar = old('id_mobil', request('car_id'));
                            @endphp
                            @foreach($mobils as $mobil)
                                <option value="{{ $mobil->id_mobil }}" {{ (string)$prefCar === (string)$mobil->id_mobil ? 'selected' : '' }}>
                                    {{ $mobil->nama_mobil }} ({{ $mobil->plat_nomor }})
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <svg class="w-5 h-5 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Service Selection with Category Filter -->
                <div class="space-y-4">
                    <label class="block text-sm font-semibold defparagraf text-[#0F044C]">Layanan yang Dipilih (bisa lebih dari satu)</label>
                    
                    <!-- Category Filter -->
                    <div class="mb-4">
                        <label class="block text-xs defparagraf text-gray-600 mb-2.5 font-medium">Filter berdasarkan kategori:</label>
                        <div class="relative inline-block w-full sm:w-auto">
                            <select id="categoryFilter" class="w-full sm:w-auto min-w-[200px] px-4 py-2.5 border border-[#0F044C]/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] defparagraf appearance-none transition-all duration-200 bg-white">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama }}</option>
                                @endforeach
                                <option value="null">Tanpa Kategori</option>
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="servicesContainer">
                        @foreach($layanans as $layanan)
                            <label class="service-item flex items-center space-x-3 p-4 border border-[#0F044C]/20 rounded-xl hover:border-[#1D2C90] hover:bg-[#1D2C90]/5 hover:shadow-md transition-all duration-200 cursor-pointer group" 
                                   data-category="{{ $layanan->id_kategori ?? 'null' }}">
                                <input type="checkbox" name="layanan_ids[]" value="{{ $layanan->id_layanan }}" 
                                       {{ in_array($layanan->id_layanan, old('layanan_ids', [])) ? 'checked' : '' }}
                                       class="w-5 h-5 text-[#1D2C90] border-[#0F044C]/30 rounded focus:ring-2 focus:ring-[#1D2C90]/30 cursor-pointer transition-all duration-200">
                                <div class="flex-1 min-w-0">
                                    <span class="defparagraf text-[#0F044C] font-semibold group-hover:text-[#1D2C90] transition-colors">{{ $layanan->nama }}</span>
                                    @if($layanan->kategori)
                                        <span class="text-xs text-gray-500 block mt-0.5">{{ $layanan->kategori->nama }}</span>
                                    @else
                                        <span class="text-xs text-orange-600 block italic mt-0.5">Tanpa Kategori</span>
                                    @endif
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <!-- Pagination Controls -->
                    <div class="mt-5 flex items-center justify-center gap-2 flex-wrap" id="servicesPagination"></div>
                </div>

                <!-- Pickup/Delivery Options -->
                <div class="bg-gradient-to-br from-gray-50 to-gray-100/50 border border-[#0F044C]/20 rounded-xl p-5 sm:p-6 space-y-5 shadow-sm">
                    <h4 class="text-sm font-semibold defparagraf text-[#0F044C] flex items-center space-x-2">
                        <svg class="w-5 h-5 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                        <span>Layanan Antar Jemput (Opsional)</span>
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                        <!-- Pickup Option -->
                        <div class="space-y-3">
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="checkbox" name="pengambilan" value="1" id="pengambilanCheckbox" 
                                       {{ old('pengambilan') ? 'checked' : '' }}
                                       class="w-5 h-5 text-[#1D2C90] border-[#0F044C]/30 rounded focus:ring-2 focus:ring-[#1D2C90]/30 cursor-pointer transition-all duration-200">
                                <span class="defparagraf text-[#0F044C] font-semibold group-hover:text-[#1D2C90] transition-colors">Jemput mobil di rumah</span>
                            </label>
                            <textarea name="alamat_pengambilan" id="pengambilanAddress" rows="4" 
                                      placeholder="Masukkan alamat lengkap untuk penjemputan mobil..."
                                      class="w-full px-4 py-3 border border-[#0F044C]/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] defparagraf disabled:bg-gray-100/50 disabled:cursor-not-allowed transition-all duration-200 resize-none"
                                      {{ old('pengambilan') ? '' : 'disabled' }}>{{ old('alamat_pengambilan') }}</textarea>
                        </div>

                        <!-- Delivery Option -->
                        <div class="space-y-3">
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="checkbox" name="pengiriman" value="1" id="pengirimanCheckbox"
                                       {{ old('pengiriman') ? 'checked' : '' }}
                                       class="w-5 h-5 text-[#1D2C90] border-[#0F044C]/30 rounded focus:ring-2 focus:ring-[#1D2C90]/30 cursor-pointer transition-all duration-200">
                                <span class="defparagraf text-[#0F044C] font-semibold group-hover:text-[#1D2C90] transition-colors">Antar mobil setelah selesai</span>
                            </label>
                            <textarea name="alamat_pengiriman" id="pengirimanAddress" rows="4"
                                      placeholder="Masukkan alamat lengkap untuk pengantaran mobil..."
                                      class="w-full px-4 py-3 border border-[#0F044C]/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] defparagraf disabled:bg-gray-100/50 disabled:cursor-not-allowed transition-all duration-200 resize-none"
                                      {{ old('pengiriman') ? '' : 'disabled' }}>{{ old('alamat_pengiriman') }}</textarea>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-300/50 rounded-xl p-4 shadow-sm">
                        <div class="flex items-start space-x-2">
                            <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-xs defparagraf text-gray-700 leading-relaxed">
                                <strong class="text-yellow-800">Catatan:</strong> Layanan antar jemput akan dikenakan biaya tambahan sesuai jarak. 
                                Jika tidak dicentang, silakan datang langsung ke bengkel kami.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Notes -->
                <div>
                    <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2.5">Catatan Tambahan (Opsional)</label>
                    <textarea name="catatan" rows="4" placeholder="Tuliskan catatan khusus untuk layanan Anda..." 
                              class="w-full px-4 py-3 border border-[#0F044C]/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] defparagraf transition-all duration-200 resize-none">{{ old('catatan') }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-2">
                    <button type="submit" class="bg-gradient-to-r from-[#1D2C90] to-[#0F044C] hover:from-[#0F044C] hover:to-[#1D2C90] text-white px-8 py-3.5 defparagraf font-semibold flex items-center space-x-2 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Buat Booking</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Category filter: show/hide services and uncheck hidden ones
        document.addEventListener('DOMContentLoaded', function() {
            var filter = document.getElementById('categoryFilter');
            var items = document.querySelectorAll('#servicesContainer .service-item');
            var container = document.getElementById('servicesContainer');
            var pager = document.getElementById('servicesPagination');
            var perPage = 4;
            var currentPage = 1;

            function applyFilter() {
                var val = filter.value;
                items.forEach(function(item) {
                    var cat = item.getAttribute('data-category');
                    var match = (val === '' || val === cat);
                    if (match) {
                        item.classList.remove('hidden'); // visible for pagination consideration
                    } else {
                        // Uncheck when hidden
                        var cb = item.querySelector('input[type="checkbox"]');
                        if (cb) cb.checked = false;
                        item.classList.add('hidden');
                    }
                });
                // After filtering, reset to first page and paginate
                currentPage = 1;
                paginate();
            }

            function getVisibleItems() {
                return Array.prototype.filter.call(items, function(item){
                    return !item.classList.contains('hidden');
                });
            }

            function renderPaginationControls(totalVisible) {
                if (!pager) return;
                pager.innerHTML = '';
                var totalPages = Math.max(1, Math.ceil(totalVisible / perPage));
                // Prev
                var prevBtn = document.createElement('button');
                prevBtn.type = 'button';
                prevBtn.textContent = 'Kembali';
                prevBtn.className = 'px-4 py-2 rounded-lg border transition-all duration-200 font-medium ' + (currentPage > 1 ? 'border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white hover:shadow-md' : 'border-gray-300 text-gray-400 cursor-not-allowed');
                prevBtn.disabled = currentPage === 1;
                prevBtn.addEventListener('click', function(){ if (currentPage > 1) { currentPage--; paginate(); }});
                pager.appendChild(prevBtn);

                // Pages (compact if many)
                for (var p = 1; p <= totalPages; p++) {
                    var btn = document.createElement('button');
                    btn.type = 'button';
                    btn.textContent = p;
                    btn.className = 'px-4 py-2 rounded-lg border transition-all duration-200 font-medium ' + (p === currentPage ? 'bg-gradient-to-r from-[#1D2C90] to-[#0F044C] border-[#0F044C] text-white shadow-md' : 'border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white hover:shadow-md');
                    (function(page){ btn.addEventListener('click', function(){ currentPage = page; paginate(); }); })(p);
                    pager.appendChild(btn);
                }

                // Next
                var nextBtn = document.createElement('button');
                nextBtn.type = 'button';
                nextBtn.textContent = 'Selanjutnya';
                nextBtn.className = 'px-4 py-2 rounded-lg border transition-all duration-200 font-medium ' + (currentPage < totalPages ? 'border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white hover:shadow-md' : 'border-gray-300 text-gray-400 cursor-not-allowed');
                nextBtn.disabled = currentPage === totalPages;
                nextBtn.addEventListener('click', function(){ if (currentPage < totalPages) { currentPage++; paginate(); }});
                pager.appendChild(nextBtn);
            }

            function paginate() {
                var visible = getVisibleItems();
                var total = visible.length;
                var totalPages = Math.max(1, Math.ceil(total / perPage));
                if (currentPage > totalPages) currentPage = totalPages;

                // Hide all visible first (pagination-wise)
                visible.forEach(function(item){ item.style.display = 'none'; });

                var start = (currentPage - 1) * perPage;
                var end = start + perPage;
                for (var i = start; i < end && i < total; i++) {
                    visible[i].style.display = '';
                }

                renderPaginationControls(total);
            }

            if (filter) {
                filter.addEventListener('change', applyFilter);
            }
            // Initial setup: apply filter state if exists, then paginate
            applyFilter();

            // Pickup/Delivery responsive address toggling
            var pickupCb = document.getElementById('pengambilanCheckbox');
            var pickupAddr = document.getElementById('pengambilanAddress');
            var deliveryCb = document.getElementById('pengirimanCheckbox');
            var deliveryAddr = document.getElementById('pengirimanAddress');

            function toggleField(cb, ta) {
                if (!cb || !ta) return;
                if (cb.checked) {
                    ta.removeAttribute('disabled');
                    ta.classList.remove('disabled:bg-gray-100');
                    ta.focus();
                } else {
                    ta.setAttribute('disabled', 'disabled');
                }
            }

            if (pickupCb && pickupAddr) {
                pickupCb.addEventListener('change', function(){ toggleField(pickupCb, pickupAddr); });
                toggleField(pickupCb, pickupAddr);
            }
            if (deliveryCb && deliveryAddr) {
                deliveryCb.addEventListener('change', function(){ toggleField(deliveryCb, deliveryAddr); });
                toggleField(deliveryCb, deliveryAddr);
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            var blockedDates = @json($blockedDates ?? []);
            var bookedDates = @json($partiallyBookedDates ?? []);
            var holidays = @json($holidays ?? []);
            var skipSunday = true;
            var dateInput = document.getElementById('tanggalBookingInput');
            var msg = document.getElementById('dateBlockedMsg');
            function isSunday(dateStr){
                var d = new Date(dateStr + 'T00:00:00');
                return d.getDay() === 0;
            }
            function handleDate(){
                if (!dateInput) return;
                var v = dateInput.value;
                if (!v) { if (msg) msg.classList.add('hidden'); return; }
                var invalid = false;
                if (blockedDates.indexOf(v) !== -1) invalid = true; // kuota penuh
                if (bookedDates.indexOf(v) !== -1) invalid = true;   // sudah dibooking
                if (holidays.indexOf(v) !== -1) invalid = true;      // libur
                if (skipSunday && isSunday(v)) invalid = true;       // minggu
                if (invalid) {
                    if (msg) msg.classList.remove('hidden');
                    dateInput.value = '';
                    dateInput.classList.add('border-red-400','focus:ring-red-200','focus:border-red-400');
                    dateInput.focus();
                } else {
                    if (msg) msg.classList.add('hidden');
                    dateInput.classList.remove('border-red-400','focus:ring-red-200','focus:border-red-400');
                }
            }
            if (dateInput) {
                dateInput.addEventListener('change', handleDate);
                dateInput.addEventListener('blur', handleDate);
            }
        });
    </script>
</x-user.dashboard-layout>