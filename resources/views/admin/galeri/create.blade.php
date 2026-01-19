<x-admin.dashboard-layout title="Tambah Galeri - Dwi AC Mobil">
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 text-sm text-gray-600">
            <a href="{{ route('admin.galeri.index') }}" class="hover:text-[#0F044C] transition-colors">Galeri</a>
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-gray-900 font-medium">Tambah Galeri</span>
        </div>

        <!-- Header Section -->
        <div class="bg-gradient-to-br from-[#0F044C] via-[#1D2C90] to-[#192BC2] text-white rounded-2xl px-5 py-6 sm:px-7 sm:py-7 shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <div class="w-40 h-40 bg-white/10 rounded-full blur-3xl absolute -right-16 top-0"></div>
                <div class="w-32 h-32 bg-white/5 rounded-full blur-3xl absolute -left-10 bottom-0"></div>
            </div>
            <div class="relative">
                <h1 class="text-2xl sm:text-3xl font-montserrat-48 font-bold leading-tight uppercase">Tambah Galeri Baru</h1>
                <p class="mt-1 text-sm sm:text-base text-white/85 defparagraf">Tambahkan foto baru ke galeri AC mobil.</p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white border-2 border-[#0F044C]/20 rounded-2xl shadow-md p-6">
            @if($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 defparagraf rounded mb-6">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <!-- Nama Foto -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Foto</label>
                        <input type="text"
                               name="nama_foto"
                               value="{{ old('nama_foto') }}"
                               placeholder="Masukkan nama foto galeri"
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1D2C90] focus:border-[#1D2C90] transition-colors @error('nama_foto') border-red-500 @enderror"
                               required>
                        @error('nama_foto')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Upload Foto -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Foto</label>
                        <div class="flex items-start space-x-4">
                            <div class="flex-1">
                                <input type="file"
                                       name="foto"
                                       accept="image/*"
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1D2C90] focus:border-[#1D2C90] transition-colors @error('foto') border-red-500 @enderror"
                                       onchange="previewImage(this)"
                                       required>
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Maksimal: 2MB)</p>
                                @error('foto')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-32 h-32 border-2 border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 overflow-hidden">
                                <img id="imagePreview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                                <div id="imagePlaceholder" class="text-center">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M2 14c0-3.771 0-5.657 1.172-6.828S6.229 6 10 6h4c3.771 0 5.657 0 6.828 1.172S22 10.229 22 14s0 5.657-1.172 6.828S17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.172S2 17.771 2 14Z"/>
                                            <path d="m4 7l-.012-1c.112-.931.347-1.574.837-2.063C5.765 3 7.279 3 10.307 3h3.211c3.028 0 4.541 0 5.482.937c.49.489.725 1.132.837 2.063v1"/>
                                            <circle cx="17.5" cy="10.5" r="1.5"/>
                                            <path stroke-linecap="round" d="m2 14.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 20.5"/>
                                        </g>
                                    </svg>
                                    <p class="text-xs text-gray-500">Preview</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.galeri.index') }}"
                       class="px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-[#0F044C] to-[#1D2C90] rounded-lg hover:opacity-95 transition-all shadow-sm">
                        Simpan Galeri
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('imagePlaceholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }
        }
    </script>
</x-admin.dashboard-layout>
