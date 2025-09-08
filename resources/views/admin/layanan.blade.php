<x-admin.dashboard-layout title="Manajemen Layanan - Dwi AC Mobil">
    <!-- Dashboard Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-alt-48 text-gray-900 mb-2">Manajemen Layanan</h1>
                    <p class="text-gray-600 defparagraf">Kelola layanan AC mobil yang tersedia.</p>
                </div>
                <button onclick="openCreateModal()" class="bg-[#141E61] hover:bg-[#0F044C] text-white px-6 py-3 defparagraf font-medium flex items-center space-x-2 transition-colors rounded-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah Layanan</span>
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
                            <input type="text" placeholder="Cari nama layanan..." class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf">
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <select class="px-4 py-3 border-2 border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf">
                            <option value="">Semua Kategori</option>
                            <option value="perawatan">Perawatan</option>
                            <option value="perbaikan">Perbaikan</option>
                            <option value="penggantian">Penggantian</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- DAFTAR LAYANAN Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-alt-48 text-gray-900 font-semibold">DAFTAR LAYANAN</h2>
            
            <!-- Services Table -->
            <div class="bg-white border-2 border-[#0F044C] shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#141E61]">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Nama Layanan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Penjelasan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#0F044C]/10">
                            <!-- Sample Data -->
                            <tr class="hover:bg-[#EEEEEE] transition-colors">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-[#141E61] text-white flex items-center justify-center text-xs font-semibold defparagraf">1</div>
                                        <span class="ml-3 text-sm font-medium defparagraf text-[#0F044C]">L001</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="w-16 h-16 bg-[#141E61]/10 border-2 border-[#141E61] flex items-center justify-center overflow-hidden">
                                        <img src="/images/detail_layanan/image 1.png" alt="Isi Freon AC" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                                        <svg class="w-8 h-8 text-[#141E61]" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-[#141E61] flex items-center justify-center rounded-full">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium defparagraf text-[#0F044C]">Isi Freon AC</div>
                                            <div class="text-sm defparagraf text-[#787A91]">Pengisian ulang freon untuk AC mobil</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="text-sm defparagraf text-[#787A91] max-w-xs">
                                        <div class="truncate">Proses pengisian freon AC meliputi pengecekan tekanan, pembersihan sistem, dan pengisian freon sesuai spesifikasi kendaraan</div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium defparagraf bg-[#141E61]/10 text-[#141E61]">
                                        Perawatan
                                    </span>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm defparagraf text-[#0F044C] font-medium">Rp 150.000</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button onclick="editService(1)" class="p-2 text-[#141E61] hover:bg-[#141E61] hover:text-white rounded-lg transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button onclick="deleteService(1)" class="p-2 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition-all duration-200">
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
                                        <div class="w-8 h-8 bg-[#141E61] text-white flex items-center justify-center text-xs font-semibold defparagraf">2</div>
                                        <span class="ml-3 text-sm font-medium defparagraf text-[#0F044C]">L002</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="w-16 h-16 bg-[#141E61]/10 border-2 border-[#141E61] flex items-center justify-center overflow-hidden">
                                        <img src="https://images.unsplash.com/photo-1584714268709-c3dd3a8d8b32?q=80&w=200&auto=format&fit=crop" alt="Service AC" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-purple-100 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">Service AC Lengkap</div>
                                                <div class="text-sm text-gray-500">Service menyeluruh sistem AC mobil</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="text-sm text-gray-700 max-w-xs">
                                            <div class="truncate">Pembersihan evaporator, penggantian filter cabin, pengecekan kompresor, dan perbaikan kebocoran sistem AC</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium bg-purple-100 text-purple-800">
                                            Perbaikan
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-900 font-medium">Rp 300.000</td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <button onclick="editService(2)" class="p-2 text-[#3B2A7A] hover:bg-[#3B2A7A] hover:text-white transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <button onclick="deleteService(2)" class="p-2 text-red-600 hover:bg-red-600 hover:text-white transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-[#3B2A7A] text-white flex items-center justify-center text-xs font-semibold">3</div>
                                            <span class="ml-3 text-sm font-medium text-gray-900">L003</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="w-16 h-16 bg-gray-200 flex items-center justify-center overflow-hidden">
                                            <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=200&auto=format&fit=crop" alt="Ganti Filter" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-orange-100 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">Ganti Filter AC</div>
                                                <div class="text-sm text-gray-500">Penggantian filter udara AC mobil</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="text-sm text-gray-700 max-w-xs">
                                            <div class="truncate">Penggantian filter cabin dengan filter berkualitas tinggi untuk sirkulasi udara yang lebih bersih dan sehat</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium bg-orange-100 text-orange-800">
                                            Penggantian
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-900 font-medium">Rp 75.000</td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <button onclick="editService(3)" class="p-2 text-[#3B2A7A] hover:bg-[#3B2A7A] hover:text-white transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <button onclick="deleteService(3)" class="p-2 text-red-600 hover:bg-red-600 hover:text-white transition-all duration-200">
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

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">3</span> dari <span class="font-medium">3</span> hasil
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 disabled:opacity-50" disabled>
                            Sebelumnya
                        </button>
                        <button class="px-3 py-2 text-sm font-medium text-white bg-[#3B2A7A] border border-transparent">
                            1
                        </button>
                        <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 disabled:opacity-50" disabled>
                            Selanjutnya
                        </button>
                    </div>
                </div>
            </div>

    <!-- Create/Edit Modal -->
    <div id="serviceModal" class="fixed inset-0 bg-black bg-opacity-60 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4">
        <div class="relative w-full max-w-2xl bg-white shadow-2xl transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-[#3B2A7A] flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">Tambah Layanan Baru</h3>
                    </div>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="serviceForm" enctype="multipart/form-data">
                    <div class="space-y-5">
                        <div class="grid grid-cols-1 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Layanan</label>
                                <input type="text" id="serviceName" placeholder="Masukkan nama layanan" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                                <textarea id="serviceDescription" placeholder="Masukkan deskripsi layanan" rows="3" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors resize-none" required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Penjelasan Detail</label>
                                <textarea id="serviceExplanation" placeholder="Masukkan penjelasan detail layanan, prosedur, atau informasi tambahan" rows="4" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors resize-none"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Layanan</label>
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1">
                                        <input type="file" id="serviceImage" accept="image/*" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" onchange="previewImage(this)">
                                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                                    </div>
                                    <div class="w-20 h-20 border border-gray-300 flex items-center justify-center bg-gray-50">
                                        <img id="imagePreview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                                        <svg id="imagePlaceholder" class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                                <select id="serviceCategory" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="perawatan">Perawatan</option>
                                    <option value="perbaikan">Perbaikan</option>
                                    <option value="penggantian">Penggantian</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga</label>
                                <input type="number" id="servicePrice" placeholder="150000" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors" required>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                        <button type="button" onclick="closeModal()" class="px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 hover:bg-gray-200 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-[#3B2A7A] border border-transparent hover:bg-[#2D1B69] transition-colors shadow-sm">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Layanan</h3>
                <p class="text-sm text-gray-500 mb-4">Apakah Anda yakin ingin menghapus layanan ini? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex justify-center space-x-3">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 hover:bg-gray-200">
                        Batal
                    </button>
                    <button onclick="confirmDelete()" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent hover:bg-red-700">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteId = null;

        function openCreateModal() {
            document.getElementById('serviceModal').classList.remove('hidden');
            document.getElementById('modalTitle').textContent = 'Tambah Layanan Baru';
            document.getElementById('serviceForm').reset();
            resetImagePreview();
        }

        function previewImage(input) {
            const file = input.files[0];
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('imagePlaceholder');
            
            if (file) {
                // Check file size (2MB limit)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB.');
                    input.value = '';
                    return;
                }
                
                // Check file type
                if (!file.type.match('image.*')) {
                    alert('File harus berupa gambar!');
                    input.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                resetImagePreview();
            }
        }

        function resetImagePreview() {
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('imagePlaceholder');
            
            preview.src = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }

        function editService(id) {
            document.getElementById('serviceModal').classList.remove('hidden');
            document.getElementById('modalTitle').textContent = 'Edit Layanan';
            
            // Sample data loading for demo
            if (id === 1) {
                document.getElementById('serviceName').value = 'Isi Freon AC';
                document.getElementById('serviceDescription').value = 'Pengisian ulang freon untuk AC mobil';
                document.getElementById('serviceExplanation').value = 'Proses pengisian freon AC meliputi pengecekan tekanan, pembersihan sistem, dan pengisian freon sesuai spesifikasi kendaraan';
                document.getElementById('serviceCategory').value = 'perawatan';
                document.getElementById('servicePrice').value = '150000';
            } else if (id === 2) {
                document.getElementById('serviceName').value = 'Service AC Lengkap';
                document.getElementById('serviceDescription').value = 'Service menyeluruh sistem AC mobil';
                document.getElementById('serviceExplanation').value = 'Pembersihan evaporator, penggantian filter cabin, pengecekan kompresor, dan perbaikan kebocoran sistem AC';
                document.getElementById('serviceCategory').value = 'perbaikan';
                document.getElementById('servicePrice').value = '300000';
            } else if (id === 3) {
                document.getElementById('serviceName').value = 'Ganti Filter AC';
                document.getElementById('serviceDescription').value = 'Penggantian filter udara AC mobil';
                document.getElementById('serviceExplanation').value = 'Penggantian filter cabin dengan filter berkualitas tinggi untuk sirkulasi udara yang lebih bersih dan sehat';
                document.getElementById('serviceCategory').value = 'penggantian';
                document.getElementById('servicePrice').value = '75000';
            }
        }

        function deleteService(id) {
            currentDeleteId = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('serviceModal').classList.add('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            currentDeleteId = null;
        }

        function confirmDelete() {
            if (currentDeleteId) {
                // Here you would typically make an AJAX call to delete the service
                console.log('Deleting service with ID:', currentDeleteId);
                alert('Layanan berhasil dihapus!');
                closeDeleteModal();
            }
        }

        // Handle form submission
        document.getElementById('serviceForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData();
            formData.append('name', document.getElementById('serviceName').value);
            formData.append('description', document.getElementById('serviceDescription').value);
            formData.append('explanation', document.getElementById('serviceExplanation').value);
            formData.append('category', document.getElementById('serviceCategory').value);
            formData.append('price', document.getElementById('servicePrice').value);
            
            // Add image file if selected
            const imageFile = document.getElementById('serviceImage').files[0];
            if (imageFile) {
                formData.append('image', imageFile);
            }
            
            // Here you would typically make an AJAX call to save the service with image
            console.log('Saving service with image:', {
                name: formData.get('name'),
                description: formData.get('description'),
                category: formData.get('category'),
                price: formData.get('price'),
                hasImage: !!imageFile
            });
            
            alert('Layanan berhasil disimpan!');
            closeModal();
        });
    </script>
</x-admin.dashboard-layout>
