    <x-user.dashboard-layout>
    <!-- Header Section -->
    <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
        <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 text-gray-900 mb-2">BOOKING ANTRIAN</h1>
        <p class="text-gray-600 defparagraf">Booking mobil Anda dengan mengambil tanggal yang tersedia pada kalender di sebelah kanan.</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Messages -->
    @if($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Booking Form -->
    <div id="bookingForm">
        <div class="bg-white border-2 border-[#0F044C] shadow-sm p-6 mb-6">
            <form method="POST" action="{{ route('booking.store') }}" class="space-y-6">
                @csrf
                
                <!-- Date and Time Selection -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium defparagraf text-[#0F044C] mb-2">Tanggal Booking</label>
                        <input type="date" name="tanggal_booking" value="{{ old('tanggal_booking') }}" min="{{ date('Y-m-d') }}" class="w-full h-10 px-3 py-2 border-2 border-[#0F044C] focus:outline-none focus:ring-2 focus:ring-[#141E61] defparagraf" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium defparagraf text-[#0F044C] mb-2">Jam Booking</label>
                        <select name="jam_booking" class="w-full h-10 px-3 py-2 border-2 border-[#0F044C] focus:outline-none focus:ring-2 focus:ring-[#141E61] defparagraf" required>
                            <option value="">Pilih jam...</option>
                            <option value="08:00" {{ old('jam_booking') == '08:00' ? 'selected' : '' }}>08:00</option>
                            <option value="08:30" {{ old('jam_booking') == '08:30' ? 'selected' : '' }}>08:30</option>
                            <option value="09:00" {{ old('jam_booking') == '09:00' ? 'selected' : '' }}>09:00</option>
                            <option value="09:30" {{ old('jam_booking') == '09:30' ? 'selected' : '' }}>09:30</option>
                            <option value="10:00" {{ old('jam_booking') == '10:00' ? 'selected' : '' }}>10:00</option>
                            <option value="10:30" {{ old('jam_booking') == '10:30' ? 'selected' : '' }}>10:30</option>
                            <option value="11:00" {{ old('jam_booking') == '11:00' ? 'selected' : '' }}>11:00</option>
                        </select>
                    </div>
                </div>

                <!-- Car Selection -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-medium defparagraf text-[#0F044C]">Pilih Mobil Anda</label>
                    </div>
                    <select name="id_mobil" class="w-full h-10 px-3 py-2 border-2 border-[#0F044C] focus:outline-none focus:ring-2 focus:ring-[#141E61] defparagraf" required>
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
                </div>

                <!-- Service Selection with Category Filter -->
                <div>
                    <label class="block text-sm font-medium defparagraf text-[#0F044C] mb-3">Layanan yang Dipilih (bisa lebih dari satu)</label>
                    
                    <!-- Category Filter -->
                    <div class="mb-4">
                        <label class="block text-xs defparagraf text-gray-600 mb-2">Filter berdasarkan kategori:</label>
                        <select id="categoryFilter" class="w-full sm:w-auto px-3 py-2 border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#141E61] defparagraf">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama }}</option>
                            @endforeach
                            <option value="null">Tanpa Kategori</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="servicesContainer">
                        @foreach($layanans as $layanan)
                            <label class="service-item flex items-center space-x-3 p-3 border-2 border-[#787A91] hover:border-[#0F044C] transition-colors cursor-pointer" 
                                   data-category="{{ $layanan->id_kategori ?? 'null' }}">
                                <input type="checkbox" name="layanan_ids[]" value="{{ $layanan->id_layanan }}" 
                                       {{ in_array($layanan->id_layanan, old('layanan_ids', [])) ? 'checked' : '' }}
                                       class="w-4 h-4 text-[#0F044C] border-[#787A91] focus:ring-[#141E61]">
                                <div class="flex-1">
                                    <span class="defparagraf text-[#0F044C] font-medium">{{ $layanan->nama }}</span>
                                    @if($layanan->kategori)
                                        <span class="text-xs text-gray-500 block">{{ $layanan->kategori->nama }}</span>
                                    @else
                                        <span class="text-xs text-orange-600 block italic">Tanpa Kategori</span>
                                    @endif
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <!-- Pagination Controls -->
                    <div class="mt-4 flex items-center justify-center gap-2" id="servicesPagination"></div>
                </div>

                <!-- Pickup/Delivery Options -->
                <div class="bg-gray-50 border-2 border-gray-200 p-4 space-y-4">
                    <h4 class="text-sm font-medium defparagraf text-[#0F044C]">Layanan Antar Jemput (Opsional)</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Pickup Option -->
                        <div>
                            <label class="flex items-center space-x-2 mb-2">
                                <input type="checkbox" name="pengambilan" value="1" id="pengambilanCheckbox" 
                                       {{ old('pengambilan') ? 'checked' : '' }}
                                       class="w-4 h-4 text-[#0F044C] border-gray-300 focus:ring-[#141E61]">
                                <span class="defparagraf text-[#0F044C] font-medium">Jemput mobil di rumah</span>
                            </label>
                            <textarea name="alamat_pengambilan" id="pengambilanAddress" rows="3" 
                                      placeholder="Masukkan alamat lengkap untuk penjemputan mobil..."
                                      class="w-full px-3 py-2 border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#141E61] defparagraf disabled:bg-gray-100"
                                      {{ old('pengambilan') ? '' : 'disabled' }}>{{ old('alamat_pengambilan') }}</textarea>
                        </div>

                        <!-- Delivery Option -->
                        <div>
                            <label class="flex items-center space-x-2 mb-2">
                                <input type="checkbox" name="pengiriman" value="1" id="pengirimanCheckbox"
                                       {{ old('pengiriman') ? 'checked' : '' }}
                                       class="w-4 h-4 text-[#0F044C] border-gray-300 focus:ring-[#141E61]">
                                <span class="defparagraf text-[#0F044C] font-medium">Antar mobil setelah selesai</span>
                            </label>
                            <textarea name="alamat_pengiriman" id="pengirimanAddress" rows="3"
                                      placeholder="Masukkan alamat lengkap untuk pengantaran mobil..."
                                      class="w-full px-3 py-2 border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#141E61] defparagraf disabled:bg-gray-100"
                                      {{ old('pengiriman') ? '' : 'disabled' }}>{{ old('alamat_pengiriman') }}</textarea>
                        </div>
                    </div>

                    <div class="text-xs defparagraf text-gray-600 bg-yellow-50 border border-yellow-200 p-3">
                        <strong>Catatan:</strong> Layanan antar jemput akan dikenakan biaya tambahan sesuai jarak. 
                        Jika tidak dicentang, silakan datang langsung ke bengkel kami.
                    </div>
                </div>

                <!-- Additional Notes -->
                <div>
                    <label class="block text-sm font-medium defparagraf text-[#0F044C] mb-2">Catatan Tambahan (Opsional)</label>
                    <textarea name="catatan" rows="4" placeholder="Tuliskan catatan khusus untuk layanan Anda..." 
                              class="w-full px-3 py-2 border-2 border-[#0F044C] focus:outline-none focus:ring-2 focus:ring-[#141E61] defparagraf">{{ old('catatan') }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-[#141E61] hover:bg-[#0F044C] text-white px-8 py-3 defparagraf font-medium flex items-center space-x-2 transition-colors">
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
                prevBtn.className = 'px-3 py-1 border-2 ' + (currentPage > 1 ? 'border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white' : 'border-gray-300 text-gray-400 cursor-not-allowed');
                prevBtn.disabled = currentPage === 1;
                prevBtn.addEventListener('click', function(){ if (currentPage > 1) { currentPage--; paginate(); }});
                pager.appendChild(prevBtn);

                // Pages (compact if many)
                for (var p = 1; p <= totalPages; p++) {
                    var btn = document.createElement('button');
                    btn.type = 'button';
                    btn.textContent = p;
                    btn.className = 'px-3 py-1 border-2 ' + (p === currentPage ? 'bg-[#0F044C] border-[#0F044C] text-white' : 'border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white');
                    (function(page){ btn.addEventListener('click', function(){ currentPage = page; paginate(); }); })(p);
                    pager.appendChild(btn);
                }

                // Next
                var nextBtn = document.createElement('button');
                nextBtn.type = 'button';
                nextBtn.textContent = 'Selanjutnya';
                nextBtn.className = 'px-3 py-1 border-2 ' + (currentPage < totalPages ? 'border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white' : 'border-gray-300 text-gray-400 cursor-not-allowed');
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
</x-user.dashboard-layout>