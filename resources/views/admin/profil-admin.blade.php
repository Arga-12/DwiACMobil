<x-admin.dashboard-layout>
    <div class="space-y-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- PROFILE FORM -->
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 uppercase text-gray-900 mb-2">PENGATURAN PROFIL</h1>
                <p class="text-gray-600 defparagraf">Kelola informasi akun admin Anda.</p>

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Photo -->
                    <div class="flex flex-col items-center lg:items-start">
                        <div class="relative group w-[200px] h-[200px] rounded-full overflow-hidden">
                            @php $foto = $admin->foto ? asset($admin->foto) : null; @endphp
                            <img src="{{ $foto }}" alt="Profile Photo" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <!-- Default Avatar -->
                            <div class="w-full h-full bg-gray-400 flex items-center justify-center hidden">
                                <svg class="w-20 h-20 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-[#787A91]/50 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center transition-opacity duration-300 cursor-pointer" onclick="document.getElementById('admin_profile_photo_input').click()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white mb-2" viewBox="0 0 24 24"><path fill="currentColor" d="M21 12a1 1 0 0 0-1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h6a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-6a1 1 0 0 0-1-1m-15 .76V17a1 1 0 0 0 1 1h4.24a1 1 0 0 0 .71-.29l6.92-6.93L21.71 8a1 1 0 0 0 0-1.42l-4.24-4.29a1 1 0 0 0-1.42 0l-2.82 2.83l-6.94 6.93a1 1 0 0 0-.29.71m10.76-8.35l2.83 2.83l-1.42 1.42l-2.83-2.83ZM8 13.17l5.93-5.93l2.83 2.83L10.83 16H8Z"/></svg>
                                <p class="text-white text-sm">Edit Foto Profil</p>
                            </div>
                            <input type="file" id="admin_profile_photo_input" name="foto" accept="image/*" class="hidden">
                        </div>
                    </div>

                    <!-- Fields -->
                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Nama</label>
                            <div class="relative">
                                <input type="text" name="nama" value="{{ old('nama', $admin->nama) }}" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 focus:outline-none focus:border-[#0F044C] transition-colors" required>
                            </div>
                            @error('nama')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Email</label>
                            <div class="relative">
                                <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 focus:outline-none focus:border-[#0F044C] transition-colors" required>
                            </div>
                            @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Peran</label>
                            <div class="relative">
                                <input type="text" value="{{ ucfirst(old('peran', $admin->peran)) }}" class="w-full px-4 py-3 border-2 border-gray-800 bg-gray-100 defparagraf text-gray-900 focus:outline-none cursor-not-allowed" readonly>
                                <input type="hidden" name="peran" value="{{ old('peran', $admin->peran) }}">
                            </div>
                            @error('peran')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium defparagraf text-gray-900 mb-2">Password Baru (Opsional)</label>
                            <div class="relative">
                                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" class="w-full px-4 py-3 border-2 border-gray-800 bg-white defparagraf text-gray-900 focus:outline-none focus:border-[#0F044C] transition-colors">
                            </div>
                            @error('password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-6">
                    <button type="submit" class="px-8 py-3 bg-[#0F044C] text-white defparagraf font-medium hover:bg-[#141E61] transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>

        {{-- MONTIR TABLE + ADD MODAL TRIGGER (removed) --}}
        {{-- 
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold">Daftar Montir</h2>
                <button type="button" onclick="document.getElementById('addMontirModal').classList.remove('hidden')" class="px-4 py-2 bg-[#787A91] text-white rounded-xl hover:opacity-90">Tambah Montir</button>
            </div>

            <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peran</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($montirs as $m)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    @php $img = $m->foto ? asset($m->foto) : null; @endphp
                                    <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-200">
                                        @if($img)
                                            <img src="{{ $img }}" alt="{{ $m->nama }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="hidden w-full h-full items-center justify-center text-xs text-gray-600">No Img</div>
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-xs text-gray-600">No Img</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3">{{ $m->nama }}</td>
                                <td class="px-4 py-3">{{ $m->email }}</td>
                                <td class="px-4 py-3 capitalize">{{ $m->peran }}</td>
                                <td class="px-4 py-3">
                                    @if($m->is_active)
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded-full">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada montir.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ADD MONTIR MODAL (removed) --}}
        {{-- 
        <div id="addMontirModal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black/50" onclick="document.getElementById('addMontirModal').classList.add('hidden')"></div>
            <div class="relative bg-white rounded-xl w-full max-w-lg mx-4 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Tambah Montir</h3>
                    <button class="text-gray-500 hover:text-gray-700" onclick="document.getElementById('addMontirModal').classList.add('hidden')">✕</button>
                </div>
                <form action="{{ route('admin.montir.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm text-gray-700 mb-2">Nama</label>
                        <input type="text" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#787A91]" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#787A91]" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-2">Peran</label>
                        <select name="peran" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#787A91]" required>
                            <option value="montir">Montir</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#787A91]" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-2">Foto (opsional)</label>
                        <input type="file" name="foto" accept="image/*" class="w-full">
                    </div>
                    <div class="pt-2 flex justify-end gap-2">
                        <button type="button" class="px-4 py-2 rounded-xl border" onclick="document.getElementById('addMontirModal').classList.add('hidden')">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-[#0F044C] text-white rounded-xl hover:bg-[#141E61]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        --}}
    </div>
</x-admin.dashboard-layout>