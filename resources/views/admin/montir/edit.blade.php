<x-admin.dashboard-layout title="Edit Montir - Dwi AC Mobil">
    <!-- Dashboard Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <div class="bg-gradient-to-br from-[#0F044C] via-[#1D2C90] to-[#192BC2] text-white rounded-2xl px-5 py-6 sm:px-7 sm:py-7 shadow-2xl relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="w-40 h-40 bg-white/10 rounded-full blur-3xl absolute -right-16 top-0"></div>
                    <div class="w-32 h-32 bg-white/5 rounded-full blur-3xl absolute -left-10 bottom-0"></div>
                </div>
                <div class="relative flex items-start sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-montserrat-48 font-bold leading-tight uppercase">Edit Data Montir</h1>
                        <p class="mt-1 text-sm sm:text-base text-white/85 defparagraf">Perbarui informasi profil montir {{ $montir->nama }}.</p>
                    </div>
                    <a href="{{ route('admin.montir.index') }}" class="px-5 py-3 bg-white/20 hover:bg-white/30 text-white rounded-xl font-semibold defparagraf inline-flex items-center gap-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-2xl border-2 border-[#0F044C]/20 shadow-lg p-6 sm:p-8">
            <form action="{{ route('admin.montir.update', $montir->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Current Photo Display -->
                @if($montir->foto)
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <img src="{{ asset('storage/montir/' . $montir->foto) }}"
                                 alt="{{ $montir->nama }}"
                                 class="h-32 w-32 object-cover rounded-full border-4 border-[#0F044C]">
                            <div class="absolute -bottom-2 -right-2 bg-[#0F044C] text-white text-xs px-2 py-1 rounded-full">
                                Foto Saat Ini
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Photo Upload -->
                <div>
                    <label for="foto" class="block text-sm font-bold text-[#0F044C] mb-2 defparagraf">
                        {{ $montir->foto ? 'Ganti Foto Profil' : 'Upload Foto Profil' }}
                    </label>
                    <input type="file" id="foto" name="foto" accept="image/*"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf">
                    <p class="mt-1 text-xs text-gray-500 defparagraf">PNG, JPG, JPEG hingga 2MB. Kosongkan jika tidak ingin mengubah foto.</p>
                    @error('foto')
                        <p class="mt-1 text-sm text-red-600 defparagraf">{{ $message }}</p>
                    @enderror
                    <!-- Preview -->
                    <div id="preview-container" class="mt-4 hidden">
                        <img id="preview-image" src="" alt="Preview" class="mx-auto h-32 w-32 object-cover rounded-full border-4 border-[#0F044C]">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-sm font-bold text-[#0F044C] mb-2 defparagraf">Nama Lengkap *</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $montir->nama) }}" required
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf"
                               placeholder="Masukkan nama lengkap">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600 defparagraf">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Peringkat -->
                    <div>
                        <label for="peringkat" class="block text-sm font-bold text-[#0F044C] mb-2 defparagraf">Peringkat/Jabatan *</label>
                        <input type="text" id="peringkat" name="peringkat" value="{{ old('peringkat', $montir->peringkat) }}" required
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf"
                               placeholder="Contoh: Senior Technician, Owner">
                        @error('peringkat')
                            <p class="mt-1 text-sm text-red-600 defparagraf">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-[#0F044C] mb-2 defparagraf">Email *</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $montir->email) }}" required
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf"
                               placeholder="contoh@email.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 defparagraf">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label for="nomor_telepon" class="block text-sm font-bold text-[#0F044C] mb-2 defparagraf">Nomor Telepon *</label>
                        <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $montir->nomor_telepon) }}" required
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf"
                               placeholder="+62 812-3456-7890">
                        @error('nomor_telepon')
                            <p class="mt-1 text-sm text-red-600 defparagraf">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kutipan -->
                <div>
                    <label for="kutipan" class="block text-sm font-bold text-[#0F044C] mb-2 defparagraf">Quotes/Motto *</label>
                    <textarea id="kutipan" name="kutipan" rows="4" required
                              class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf resize-none"
                              placeholder="Masukkan quotes atau motto yang menggambarkan dedikasi dalam bekerja">{{ old('kutipan', $montir->kutipan) }}</textarea>
                    @error('kutipan')
                        <p class="mt-1 text-sm text-red-600 defparagraf">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.montir.index') }}"
                       class="px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-[#0F044C] to-[#1D2C90] rounded-lg hover:opacity-95 transition-all shadow-sm">
                        Perbarui Montir
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview uploaded image
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        });
    </script>
</x-admin.dashboard-layout>
