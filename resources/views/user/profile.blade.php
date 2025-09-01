<x-user.dashboard-layout>
    <!-- Profile Content -->
    <div class="space-y-8">
            <!-- PENGATURAN PROFIL Section -->
            <div class="space-y-6">
                <h1 class="sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-alt-48 text-gray-900 mb-8">PENGATURAN PROFIL</h1>
                
                <!-- Profile Photo and Basic Info -->
                <div class="flex flex-col lg:flex-row gap-8">
                <!-- Profile Photo Section -->
                <div class="flex flex-col items-center lg:items-start">
                    <div class="relative group w-[200px] h-[200px] rounded-full overflow-hidden">
                        <!-- Profile Image -->
                        <img src="{{ asset('images/user/yui.jpg') }}" alt="Profile Photo" 
                            class="w-full h-full object-cover" 
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                        <!-- Default Avatar (kalau img error) -->
                        <div class="w-full h-full bg-gray-400 flex items-center justify-center hidden">
                            <svg class="w-20 h-20 text-gray-600" xmlns="http://www.w3.org/2000/svg" 
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>

                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-[#787A91]/50 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center transition-opacity duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white mb-2" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M21 12a1 1 0 0 0-1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h6a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-6a1 1 0 0 0-1-1m-15 .76V17a1 1 0 0 0 1 1h4.24a1 1 0 0 0 .71-.29l6.92-6.93L21.71 8a1 1 0 0 0 0-1.42l-4.24-4.29a1 1 0 0 0-1.42 0l-2.82 2.83l-6.94 6.93a1 1 0 0 0-.29.71m10.76-8.35l2.83 2.83l-1.42 1.42l-2.83-2.83ZM8 13.17l5.93-5.93l2.83 2.83L10.83 16H8Z"/>
                            </svg>
                            <p class="text-white text-sm">Edit Foto Profil Anda</p>
                        </div>
                    </div>
                </div>


                    <!-- Basic Info Form -->
                    <div class="flex-1 space-y-6">
                        <!-- Name Field -->
                        <div>
                            <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Nama</label>
                            <div class="relative">
                                <input type="text" value="Yui Hirasawa" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 focus:outline-none focus:border-[#0F044C] transition-colors">
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Email</label>
                            <div class="relative">
                                <input type="email" value="yui******@gmail.com" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 focus:outline-none focus:border-[#0F044C] transition-colors">
                                <!-- Edit Icon -->
                                <button class="absolute right-3 top-1/2 transform -translate-y-1/2 w-6 h-6 flex items-center justify-center hover:bg-gray-100 transition-colors">
                                    <svg class="w-4 h-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Password</label>
                            <div class="relative">
                                <input type="password" value="••••••••" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 focus:outline-none focus:border-[#0F044C] transition-colors">
                                <!-- Lock Icon -->
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                        <circle cx="12" cy="16" r="1"/>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs defparagraf text-gray-600 mt-1">Ingin melihat password Anda? <a href="#" class="text-blue-600 hover:underline">konfigurasi kmail</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DETAIL MENGENAI PROFIL ANDA Section -->
            <div class="space-y-6">
                <h2 class="sm:text-xl md:text-xl lg:text-2xl font-montserrat-alt-48 text-gray-900">DETAIL MENGENAI PROFIL ANDA</h2>
                
                <div class="space-y-6">
                    <!-- WhatsApp Number Field -->
                    <div>
                        <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Nomor WhatsApp</label>
                        <div class="relative">
                            <input type="tel" placeholder="+62 ****345" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 placeholder-gray-500 focus:outline-none focus:border-[#0F044C] transition-colors">
                        </div>
                    </div>

                    <!-- Address Field -->
                    <div>
                        <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Alamat Anda</label>
                        <div class="relative">
                            <input type="text" placeholder="Tambahkan Alamat Anda" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 placeholder-gray-500 focus:outline-none focus:border-[#0F044C] transition-colors">
                            <!-- Edit Icon -->
                            <button class="absolute right-3 top-1/2 transform -translate-y-1/2 w-6 h-6 flex items-center justify-center hover:bg-gray-100 transition-colors">
                                <svg class="w-4 h-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end pt-6">
                <button class="px-8 py-3 bg-[#0F044C] text-white defparagraf font-medium hover:bg-[#141E61] transition-colors">
                    Simpan Perubahan
                </button>
            </div>
    </div>
</x-user.dashboard-layout>
