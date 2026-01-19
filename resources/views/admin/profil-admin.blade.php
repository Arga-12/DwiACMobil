<x-admin.dashboard-layout>
    <!-- Header Section -->
    <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
        <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 uppercase text-gray-900 font-bold mb-2 tracking-tight">PENGATURAN PROFIL</h1>
    </div>

    <!-- Profile Content -->
    <div class="space-y-8">
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-xl shadow-sm mb-6">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif
        
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- PENGATURAN PROFIL Section -->
            <div class="bg-white border border-[#0F044C]/20 shadow-md rounded-2xl p-6 sm:p-8 mb-6">
                <div class="space-y-6 sm:space-y-8">
                    <!-- Profile Photo and Basic Info -->
                    <div class="flex flex-col lg:flex-row gap-8">
                        <!-- Profile Photo Section -->
                        <div class="flex flex-col items-center lg:items-start">
                            <div class="relative group w-[200px] h-[200px] rounded-full overflow-hidden shadow-lg border-4 border-white ring-2 ring-[#0F044C]/10">
                                <!-- Profile Image -->
                                @php 
                                    $foto = $admin->foto ? asset($admin->foto) : null;
                                @endphp
                                <img src="{{ $foto }}" alt="Profile Photo" 
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" 
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                <!-- Default Avatar (kalau img error) -->
                                <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center hidden">
                                    <svg class="w-24 h-24 text-gray-600" xmlns="http://www.w3.org/2000/svg" 
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                </div>

                                <!-- Hover Overlay with File Input -->
                                <div class="absolute inset-0 bg-gradient-to-br from-[#1D2C90]/80 to-[#0F044C]/80 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center transition-all duration-300 cursor-pointer rounded-full" onclick="document.getElementById('admin_profile_photo_input').click()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white mb-2 drop-shadow-lg" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M21 12a1 1 0 0 0-1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h6a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-6a1 1 0 0 0-1-1m-15 .76V17a1 1 0 0 0 1 1h4.24a1 1 0 0 0 .71-.29l6.92-6.93L21.71 8a1 1 0 0 0 0-1.42l-4.24-4.29a1 1 0 0 0-1.42 0l-2.82 2.83l-6.94 6.93a1 1 0 0 0-.29.71m10.76-8.35l2.83 2.83l-1.42 1.42l-2.83-2.83ZM8 13.17l5.93-5.93l2.83 2.83L10.83 16H8Z"/>
                                    </svg>
                                    <p class="text-white text-sm font-semibold drop-shadow-lg">Edit Foto</p>
                                </div>
                                
                                <!-- Hidden File Input -->
                                <input type="file" id="admin_profile_photo_input" name="foto" accept="image/*" class="hidden" onchange="previewImage(this)">
                            </div>
                            <p class="text-xs defparagraf text-gray-600 mt-3 text-center lg:text-left px-2">
                                @if($admin->created_at)
                                    Bergabung pada {{ $admin->created_at->format('d F Y') }}
                                @endif
                            </p>
                            @error('foto')
                                <p class="text-red-500 text-xs mt-1 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Basic Info Form -->
                        <div class="flex-1 space-y-5">
                            <!-- Name Field -->
                            <div>
                                <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2.5">Nama</label>
                                <div class="relative">
                                    <input type="text" name="nama" value="{{ old('nama', $admin->nama) }}" 
                                           class="w-full h-12 px-4 py-2 border border-[#0F044C]/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] defparagraf text-gray-900 transition-all duration-200 bg-white" 
                                           required>
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                        <svg class="w-5 h-5 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    @error('nama')
                                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2.5">Email</label>
                                <div class="relative">
                                    <input type="email" name="email" value="{{ old('email', $admin->email) }}" 
                                           class="w-full h-12 px-4 py-2 border border-[#0F044C]/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] defparagraf text-gray-900 transition-all duration-200 bg-white" 
                                           required>
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                        <svg class="w-5 h-5 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Peran Field (Read-only) -->
                            <div>
                                <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2.5">Peran</label>
                                <div class="relative">
                                    <input type="text" value="{{ ucfirst(old('peran', $admin->peran)) }}" 
                                           class="w-full h-12 px-4 py-2 border border-[#0F044C]/30 rounded-xl bg-gray-100 defparagraf text-gray-900 focus:outline-none cursor-not-allowed" 
                                           readonly>
                                    <input type="hidden" name="peran" value="{{ old('peran', $admin->peran) }}">
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                        <svg class="w-5 h-5 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                    @error('peran')
                                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div>
                                <label class="block text-sm font-semibold defparagraf text-[#0F044C] mb-2.5">Password Baru (Opsional)</label>
                                <div class="relative">
                                    <input type="password" name="password" 
                                           placeholder="Kosongkan jika tidak ingin mengubah password" 
                                           class="w-full h-12 px-4 py-2 border border-[#0F044C]/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/30 focus:border-[#1D2C90] defparagraf text-gray-900 placeholder-gray-400 transition-all duration-200 bg-white">
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                        <svg class="w-5 h-5 text-[#1D2C90]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                        </svg>
                                    </div>
                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-gradient-to-r from-[#1D2C90] to-[#0F044C] hover:from-[#0F044C] hover:to-[#1D2C90] text-white px-8 py-3.5 defparagraf font-semibold flex items-center space-x-2 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const profileImg = document.querySelector('.relative.group img');
                    if (profileImg) {
                        profileImg.src = e.target.result;
                        profileImg.style.display = 'block';
                        const defaultAvatar = profileImg.nextElementSibling;
                        if (defaultAvatar) {
                            defaultAvatar.style.display = 'none';
                        }
                    }
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-admin.dashboard-layout>
