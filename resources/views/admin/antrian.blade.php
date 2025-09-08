<x-admin.dashboard-layout title="Manajemen Antrian - Dwi AC Mobil">
    <!-- Dashboard Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-alt-48 text-gray-900 mb-2">Manajemen Antrian</h1>
                    <p class="text-gray-600 defparagraf">Kelola antrian pelanggan untuk layanan AC mobil.</p>
                </div>
                <button onclick="openCreateModal()" class="bg-[#141E61] hover:bg-[#0F044C] text-white px-6 py-3 defparagraf font-medium flex items-center space-x-2 transition-colors rounded-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah Antrian</span>
                </button>
            </div>
        </div>

        <!-- PENCARIAN & FILTER Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-alt-48 text-gray-900 font-semibold">PENCARIAN & FILTER</h2>
            
            <!-- Search and Filter -->
            <div class="bg-white border-2 border-[#0F044C] shadow-sm p-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" placeholder="Cari nama pelanggan..." class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf">
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <select class="px-4 py-3 border-2 border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf">
                            <option value="">Semua Status</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="sedang_dikerjakan">Sedang Dikerjakan</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        <select class="px-4 py-3 border-2 border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf">
                            <option value="">Semua Layanan</option>
                            <option value="isi_freon">Isi Freon</option>
                            <option value="service_ac">Service AC</option>
                            <option value="ganti_filter">Ganti Filter</option>
                            <option value="cuci_evaporator">Cuci Evaporator</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- DAFTAR ANTRIAN Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-alt-48 text-gray-900 font-semibold">DAFTAR ANTRIAN</h2>
            
            <!-- Queue Table -->
            <div class="bg-white border-2 border-[#0F044C] shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#141E61]">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">No. Antrian</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Pelanggan</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Layanan</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Waktu</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Montir</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#0F044C]/10">
                            <!-- Sample Data -->
                            <tr class="hover:bg-[#EEEEEE] transition-colors">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-[#141E61] text-white rounded-full flex items-center justify-center text-xs font-semibold defparagraf">A1</div>
                                        <span class="ml-3 text-sm font-medium defparagraf text-[#0F044C]">A001</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-[#141E61] rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium defparagraf text-[#0F044C]">John Doe</div>
                                            <div class="text-sm defparagraf text-[#787A91]">Honda Civic 2020</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium defparagraf bg-[#141E61]/10 text-[#141E61]">
                                        Isi Freon
                                    </span>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm defparagraf text-[#0F044C] font-medium">09:00 - 10:00</td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold defparagraf rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <div class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-2"></div>
                                        Menunggu
                                    </span>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm defparagraf text-[#787A91]">-</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button onclick="editQueue(1)" class="p-2 text-[#141E61] hover:bg-[#141E61] hover:text-white rounded-lg transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button onclick="deleteQueue(1)" class="p-2 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-[#EEEEEE] transition-colors">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-[#141E61] text-white rounded-full flex items-center justify-center text-xs font-semibold defparagraf">A2</div>
                                        <span class="ml-3 text-sm font-medium defparagraf text-[#0F044C]">A002</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-[#141E61] rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium defparagraf text-[#0F044C]">Jane Smith</div>
                                            <div class="text-sm defparagraf text-[#787A91]">Toyota Camry 2019</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium defparagraf bg-[#141E61]/10 text-[#141E61]">
                                        Service AC
                                    </span>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm defparagraf text-[#0F044C] font-medium">10:00 - 12:00</td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold defparagraf rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                        <div class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-2 animate-pulse"></div>
                                        Sedang Dikerjakan
                                    </span>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm defparagraf text-[#0F044C]">Brian O'Connor</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button onclick="editQueue(2)" class="p-2 text-[#141E61] hover:bg-[#141E61] hover:text-white rounded-lg transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button onclick="deleteQueue(2)" class="p-2 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-[#EEEEEE] transition-colors">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-[#141E61] text-white rounded-full flex items-center justify-center text-xs font-semibold defparagraf">A3</div>
                                        <span class="ml-3 text-sm font-medium defparagraf text-[#0F044C]">A003</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-[#141E61] rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium defparagraf text-[#0F044C]">Mike Johnson</div>
                                            <div class="text-sm defparagraf text-[#787A91]">BMW X5 2021</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium defparagraf bg-[#141E61]/10 text-[#141E61]">
                                        Ganti Filter
                                    </span>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm defparagraf text-[#0F044C] font-medium">08:00 - 09:00</td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold defparagraf rounded-full bg-green-100 text-green-800 border border-green-200">
                                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></div>
                                        Selesai
                                    </span>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm defparagraf text-[#0F044C]">Brian O'Connor</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button onclick="editQueue(3)" class="p-2 text-[#141E61] hover:bg-[#141E61] hover:text-white rounded-lg transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button onclick="deleteQueue(3)" class="p-2 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGINATION Section -->
        <div class="flex items-center justify-between">
            <div class="text-sm defparagraf text-[#787A91]">
                Menampilkan <span class="font-medium text-[#0F044C]">1</span> sampai <span class="font-medium text-[#0F044C]">3</span> dari <span class="font-medium text-[#0F044C]">3</span> hasil
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-2 text-sm font-medium defparagraf text-[#787A91] bg-white border-2 border-gray-300 hover:bg-[#EEEEEE] disabled:opacity-50" disabled>
                    Sebelumnya
                </button>
                <button class="px-3 py-2 text-sm font-medium defparagraf text-white bg-[#141E61] border-2 border-transparent">
                    1
                </button>
                <button class="px-3 py-2 text-sm font-medium defparagraf text-[#787A91] bg-white border-2 border-gray-300 hover:bg-[#EEEEEE] disabled:opacity-50" disabled>
                    Selanjutnya
                </button>
                    </div>
                </div>
            </div>

            <!-- Create/Edit Modal -->
            <div id="createModal" class="fixed inset-0 bg-black bg-opacity-60 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4">
                <div class="relative w-full max-w-md bg-white rounded-xl shadow-2xl transform transition-all">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-[#3B2A7A] rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">Tambah Antrian Baru</h3>
                            </div>
                            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <form id="queueForm">
                            <div class="space-y-5">
                                <div class="grid grid-cols-1 gap-5">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pelanggan</label>
                                        <input type="text" id="customerName" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kendaraan</label>
                                        <input type="text" id="vehicle" placeholder="Contoh: Honda Civic 2020" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" required>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Layanan</label>
                                        <select id="service" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" required>
                                            <option value="">Pilih Layanan</option>
                                            <option value="isi_freon">Isi Freon</option>
                                            <option value="service_ac">Service AC</option>
                                            <option value="ganti_filter">Ganti Filter</option>
                                            <option value="cuci_evaporator">Cuci Evaporator</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu</label>
                                        <input type="text" id="time" placeholder="09:00 - 10:00" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" required>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                                        <select id="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" required>
                                            <option value="menunggu">Menunggu</option>
                                            <option value="sedang_dikerjakan">Sedang Dikerjakan</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Montir</label>
                                        <select id="montir" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors">
                                            <option value="">Belum Ditentukan</option>
                                            <option value="brian">Brian O'Connor</option>
                                            <option value="dom">Dominic Toretto</option>
                                            <option value="roman">Roman Pearce</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                                <button type="button" onclick="closeModal()" class="px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 transition-colors">
                                    Batal
                                </button>
                                <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-[#3B2A7A] border border-transparent rounded-lg hover:bg-[#2D1B69] transition-colors shadow-sm">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3 text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Antrian</h3>
                        <p class="text-sm text-gray-500 mb-4">Apakah Anda yakin ingin menghapus antrian ini? Tindakan ini tidak dapat dibatalkan.</p>
                        <div class="flex justify-center space-x-3">
                            <button onclick="closeDeleteModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">
                                Batal
                            </button>
                            <button onclick="confirmDelete()" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                let currentDeleteId = null;

                function openCreateModal() {
                    document.getElementById('createModal').classList.remove('hidden');
                }

                function closeModal() {
                    document.getElementById('createModal').classList.add('hidden');
                }

                // Close modal when clicking outside
                document.getElementById('createModal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeModal();
                    }
                });

                // Form submission
                document.getElementById('queueForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = {
                        customerName: document.getElementById('customerName').value,
                        vehicle: document.getElementById('vehicle').value,
                        service: document.getElementById('service').value,
                        time: document.getElementById('time').value,
                        status: document.getElementById('status').value,
                        montir: document.getElementById('montir').value
                    };
                    
                    console.log('Form Data:', formData);
                    alert('Data berhasil disimpan!');
                    closeModal();
                });
            </script>
        </x-admin.dashboard-layout>
