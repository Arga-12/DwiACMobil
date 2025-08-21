<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Antrian - Dwi AC Mobil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/custom-fonts.css">
</head>
<body class="bg-gray-50">
    <x-user.dashboard-layout>
        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-alt-48 text-gray-900 mb-2">BOOKING ANTRIAN</h1>
            <p class="text-gray-600 defparagraf">Booking mobil Anda dengan mengambil tanggal yang tersedia pada kalender di sebelah kanan.</p>
        </div>

        <!-- Add Booking Button -->
        <div class="flex justify-center mb-8" id="addBookingSection">
            <button onclick="showBookingForm()" class="bg-[#0F044C] hover:bg-[#141E61] transition-colors duration-200 rounded-full p-4 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m-7-7h14"/>
                </svg>
            </button>
            <div class="ml-4 flex items-center">
                <span class="text-lg font-medium defparagraf text-[#0F044C]">Tambahkan Antrian Anda!</span>
            </div>
        </div>

        <!-- Booking Form (Hidden Initially) -->
        <div id="bookingForm" class="hidden">
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
                        <button type="button" onclick="hideBookingForm()" class="px-6 py-2 bg-white border-2 border-[#787A91] text-[#787A91] hover:bg-[#EEEEEE] transition-colors defparagraf">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2 bg-[#0F044C] text-white hover:bg-[#141E61] transition-colors defparagraf">
                            Kirim Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function showBookingForm() {
                document.getElementById('addBookingSection').classList.add('hidden');
                document.getElementById('bookingForm').classList.remove('hidden');
            }

            function hideBookingForm() {
                document.getElementById('addBookingSection').classList.remove('hidden');
                document.getElementById('bookingForm').classList.add('hidden');
            }
        </script>
    </x-user.dashboard-layout>
</body>
</html>