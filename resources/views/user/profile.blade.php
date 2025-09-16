<x-user.dashboard-layout>
    <!-- Profile Content -->
    <div class="space-y-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- PENGATURAN PROFIL Section -->
            <div class="space-y-6">
                <h1 class="sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 text-gray-900 mb-8">PENGATURAN PROFIL</h1>
                
                <!-- Profile Photo and Basic Info -->
                <div class="flex flex-col lg:flex-row gap-8">
                <!-- Profile Photo Section -->
                <div class="flex flex-col items-center lg:items-start">
                    <div class="relative group w-[200px] h-[200px] rounded-full overflow-hidden">
                        <!-- Profile Image -->
                        <img src="{{ asset($profileData['profile_image']) }}" alt="Profile Photo" 
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

                        <!-- Hover Overlay with File Input -->
                        <div class="absolute inset-0 bg-[#787A91]/50 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center transition-opacity duration-300 cursor-pointer" onclick="document.getElementById('profile_photo_input').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white mb-2" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M21 12a1 1 0 0 0-1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h6a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-6a1 1 0 0 0-1-1m-15 .76V17a1 1 0 0 0 1 1h4.24a1 1 0 0 0 .71-.29l6.92-6.93L21.71 8a1 1 0 0 0 0-1.42l-4.24-4.29a1 1 0 0 0-1.42 0l-2.82 2.83l-6.94 6.93a1 1 0 0 0-.29.71m10.76-8.35l2.83 2.83l-1.42 1.42l-2.83-2.83ZM8 13.17l5.93-5.93l2.83 2.83L10.83 16H8Z"/>
                            </svg>
                            <p class="text-white text-sm">Edit Foto Profil Anda</p>
                        </div>
                        
                        <!-- Hidden File Input -->
                        <input type="file" id="profile_photo_input" name="profile_photo" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </div>
                    <p class="text-xs defparagraf text-gray-600 mt-2 text-center">Bergabung pada {{ $profileData['join_date'] }}</p>
                    @error('profile_photo')
                        <p class="text-red-500 text-xs mt-1 text-center">{{ $message }}</p>
                    @enderror
                </div>


                    <!-- Basic Info Form -->
                    <div class="flex-1 space-y-6">
                        <!-- Name Field -->
                        <div>
                            <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Nama</label>
                            <div class="relative">
                                <input type="text" name="nama" value="{{ $profileData['nama'] }}" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 focus:outline-none focus:border-[#0F044C] transition-colors" required>
                                @error('nama')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Email</label>
                            <div class="relative">
                                <input type="email" name="email" value="{{ $profileData['email'] }}" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 focus:outline-none focus:border-[#0F044C] transition-colors" required>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <p class="text-xs defparagraf text-gray-600 mt-1">Email terlihat sebagai: {{ $profileData['masked_email'] }}</p>
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Password Baru (Opsional)</label>
                            <div class="relative">
                                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 focus:outline-none focus:border-[#0F044C] transition-colors">
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                            
                        <!-- Confirm Password Field -->
                        <div>
                            <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Konfirmasi Password</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" placeholder="Konfirmasi password baru" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 focus:outline-none focus:border-[#0F044C] transition-colors">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DETAIL MENGENAI PROFIL ANDA Section -->
            <div class="space-y-6 mt-8">
                <h2 class="sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900">DETAIL MENGENAI PROFIL ANDA</h2>
                
                <div class="space-y-6">
                    <!-- WhatsApp Number Field -->
                    <div>
                        <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Nomor WhatsApp</label>
                        <div class="relative">
                            <input type="tel" name="no_wa" value="{{ $profileData['no_wa'] }}" placeholder="+62 81234567890" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 placeholder-gray-500 focus:outline-none focus:border-[#0F044C] transition-colors">
                            @error('no_wa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Address Field -->
                    <div>
                        <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Alamat Anda</label>
                        <div class="relative">
                            <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap Anda" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 placeholder-gray-500 focus:outline-none focus:border-[#0F044C] transition-colors resize-none">{{ $profileData['alamat'] }}</textarea>
                            @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end pt-6">
                <button type="submit" class="px-8 py-3 bg-[#0F044C] text-white defparagraf font-medium hover:bg-[#141E61] transition-colors">
                    Simpan Perubahan
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
                    profileImg.src = e.target.result;
                    profileImg.style.display = 'block';
                    profileImg.nextElementSibling.style.display = 'none';
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-user.dashboard-layout>
