    <x-user.dashboard-layout>
    <!-- Header Section -->
    <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
        <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 text-gray-900 mb-2">BOOKING ANTRIAN</h1>
        <p class="text-gray-600 defparagraf">Booking mobil Anda dengan mengambil tanggal yang tersedia pada kalender di sebelah kanan.</p>
    </div>

    <!-- Booking Form -->
    <div id="bookingForm">
        <div class="bg-white border-2 border-[#0F044C] shadow-sm p-6 mb-6">
            <form class="space-y-6">
                <!-- Date and Time Selection -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium defparagraf text-[#0F044C] mb-2">Tanggal Booking</label>
                        <input type="date" class="w-full h-10 px-3 py-2 border-2 border-[#0F044C] focus:outline-none focus:ring-2 focus:ring-[#141E61] defparagraf">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium defparagraf text-[#0F044C] mb-2">Jam Booking</label>
                        <select class="w-full h-10 px-3 py-2 border-2 border-[#0F044C] focus:outline-none focus:ring-2 focus:ring-[#141E61] defparagraf">
                            <option value="">Pilih jam...</option>
                            <option value="08:00">08:00</option>
                            <option value="08:30">08:30</option>
                            <option value="09:00">09:00</option>
                            <option value="09:30">09:30</option>
                            <option value="10:00">10:00</option>
                        </select>
                    </div>
                </div>

                <!-- Car Information -->
                <div>
                    <label class="block text-sm font-medium defparagraf text-[#0F044C] mb-2">Pilih Mobil Anda</label>
                    <select class="w-full h-10 px-3 py-2 border-2 border-[#0F044C] focus:outline-none focus:ring-2 focus:ring-[#141E61] defparagraf">
                        <option value="">Pilih mobil...</option>
                        <option value="mazda-mx5">Mazda MX-5 Miata Na (2020)</option>
                        <option value="toyota-avanza">Toyota Avanza (2018)</option>
                        <!-- Data akan diambil dari database user -->
                    </select>
                </div>

                <!-- Service Selection -->
                <div>
                    <label class="block text-sm font-medium defparagraf text-[#0F044C] mb-3">Layanan yang Dipilih (bisa lebih dari satu)</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label class="flex items-center space-x-3 p-3 border-2 border-[#787A91] hover:border-[#0F044C] transition-colors cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-[#0F044C] border-[#787A91] focus:ring-[#141E61]">
                            <span class="defparagraf text-[#0F044C]">Service AC Mobil</span>
                        </label>
                        <label class="flex items-center space-x-3 p-3 border-2 border-[#787A91] hover:border-[#0F044C] transition-colors cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-[#0F044C] border-[#787A91] focus:ring-[#141E61]">
                            <span class="defparagraf text-[#0F044C]">Cuci AC Mobil</span>
                        </label>
                        <label class="flex items-center space-x-3 p-3 border-2 border-[#787A91] hover:border-[#0F044C] transition-colors cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-[#0F044C] border-[#787A91] focus:ring-[#141E61]">
                            <span class="defparagraf text-[#0F044C]">Isi Freon</span>
                        </label>
                        <label class="flex items-center space-x-3 p-3 border-2 border-[#787A91] hover:border-[#0F044C] transition-colors cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-[#0F044C] border-[#787A91] focus:ring-[#141E61]">
                            <span class="defparagraf text-[#0F044C]">Perbaikan AC</span>
                        </label>
                        <label class="flex items-center space-x-3 p-3 border-2 border-[#787A91] hover:border-[#0F044C] transition-colors cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-[#0F044C] border-[#787A91] focus:ring-[#141E61]">
                            <span class="defparagraf text-[#0F044C]">Ganti Filter AC</span>
                        </label>
                        <label class="flex items-center space-x-3 p-3 border-2 border-[#787A91] hover:border-[#0F044C] transition-colors cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-[#0F044C] border-[#787A91] focus:ring-[#141E61]">
                            <span class="defparagraf text-[#0F044C]">Tune Up AC</span>
                        </label>
                    </div>
                </div>

                <!-- Pickup/Delivery Address -->
                <div>
                    <label class="block text-sm font-medium defparagraf text-[#0F044C] mb-2">Alamat Rumah (untuk pickup/delivery)</label>
                    <textarea rows="3" placeholder="Masukkan alamat lengkap jika ingin mobil diambil dan diantar ke rumah..." class="w-full px-3 py-2 border-2 border-[#0F044C] focus:outline-none focus:ring-2 focus:ring-[#141E61] defparagraf"></textarea>
                    <p class="text-xs defparagraf text-[#787A91] mt-1">*Kosongkan jika ingin datang langsung ke bengkel</p>
                    <p class="text-xs defparagraf text-[#0F044C] mt-1 font-medium">*Layanan pickup/delivery akan dikenakan tarif tambahan sesuai jarak</p>
                </div>

                <!-- Additional Notes -->
                <div>
                    <label class="block text-sm font-medium defparagraf text-[#0F044C] mb-2">Catatan Tambahan</label>
                    <textarea rows="3" placeholder="Ceritakan kondisi AC mobil Anda atau keluhan yang dialami..." class="w-full px-3 py-2 border-2 border-[#0F044C] focus:outline-none focus:ring-2 focus:ring-[#141E61] defparagraf"></textarea>
                </div>

                <!-- Price Confirmation Notice -->
                <div class="bg-[#EEEEEE] border-2 border-[#787A91] p-4">
                    <h4 class="text-sm font-medium defparagraf text-[#0F044C] mb-2">📋 Informasi Harga</h4>
                    <p class="text-xs defparagraf text-[#787A91] leading-relaxed">
                        Setelah booking dikirim, Anda akan menerima konfirmasi harga layanan berdasarkan jenis mobil dan sparepart yang dibutuhkan. 
                        Harga final akan ditampilkan pada detail struk setelah inspeksi awal.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3">
                    <button type="submit" class="px-6 py-2 bg-[#0F044C] text-white hover:bg-[#141E61] transition-colors defparagraf">
                        Kirim Booking
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Include Booking Receipt Modal Component -->
    <x-user.booking-receipt-modal />

    <script>
        // Store current booking data globally
        let currentBookingData = {};

        function acceptPrice() {
            // Show receipt modal with confirmed status
            const bookingData = getCurrentBookingData();
            bookingData.status = 'confirmed';
            showReceiptModal(bookingData);
            
            // In real app, this would send acceptance to backend
            console.log('Price accepted by user');
        }

        function declinePrice() {
            // Show receipt modal with cancelled status
            const bookingData = getCurrentBookingData();
            bookingData.status = 'cancelled';
            showReceiptModal(bookingData);
            
            // In real app, this would send decline to backend
            console.log('Price declined by user');
        }

        // Store current booking data globally
        let currentBookingData = {};

        function getCurrentBookingData() {
            return currentBookingData;
        }

        // Simulate mechanic sending price (for demo purposes)
        function simulatePriceConfirmation() {
            setTimeout(() => {
                // Close receipt modal first
                closeReceiptModal();
                
                // Update booking data with pricing information
                const bookingData = getCurrentBookingData();
                bookingData.pricing = {
                    serviceCost: 'Rp 150.000',
                    sparepartCost: 'Rp 75.000',
                    deliveryCost: 'Rp 25.000',
                    totalCost: 'Rp 250.000'
                };
                bookingData.mechanicNote = 'Filter AC perlu diganti dan freon sudah habis. Estimasi waktu pengerjaan 2-3 jam.';
                bookingData.status = 'price_confirmation';
                
                // Show receipt modal with price confirmation
                showReceiptModal(bookingData);
            }, 5000); // Simulate 5 second delay
        }


        // Handle form submission
        document.querySelector('#bookingForm form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const date = this.querySelector('input[type="date"]').value;
            const time = this.querySelector('select').value;
            const car = this.querySelectorAll('select')[1].value;
            const address = this.querySelector('textarea').value;
            const notes = this.querySelectorAll('textarea')[1].value;
            
            // Get selected services
            const selectedServices = [];
            this.querySelectorAll('input[type="checkbox"]:checked').forEach(checkbox => {
                selectedServices.push(checkbox.nextElementSibling.textContent);
            });

            // Generate booking ID (in real app, this would come from backend)
            const bookingId = 'BWK-' + new Date().getFullYear() + '-' + String(Math.floor(Math.random() * 1000)).padStart(3, '0');
            
            // Get car text from selected option
            const carSelect = this.querySelectorAll('select')[1];
            const carText = carSelect.options[carSelect.selectedIndex].text;
            
            // Store booking data globally
            currentBookingData = {
                id: bookingId,
                date: date ? new Date(date).toLocaleDateString('id-ID') : '-',
                time: time || '-',
                car: car ? carText : '-',
                services: selectedServices,
                address: address,
                notes: notes,
                status: 'waiting',
                isNewBooking: true
            };
            
            // Show receipt modal with waiting status
            showReceiptModal(currentBookingData);
            
            // Reset form and hide booking form
            this.reset();
            hideBookingForm();
            
            // Start price confirmation simulation
            simulatePriceConfirmation();
        });
    </script>
</x-user.dashboard-layout>