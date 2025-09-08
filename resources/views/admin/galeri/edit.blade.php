<x-admin.dashboard-layout title="Edit Galeri - Dwi AC Mobil">
                <div class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
                    <a href="{{ route('admin.galeri.index') }}" class="hover:text-[#3B2A7A]">Galeri</a>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-gray-900">Edit Galeri</span>
                </div>

                <div class="bg-white shadow-sm border border-gray-200 p-6">
                    <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Galeri</label>
                                    <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}" placeholder="Masukkan judul galeri" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors @error('judul') border-red-500 @enderror" required>
                                    @error('judul')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                                    <select name="kategori" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors @error('kategori') border-red-500 @enderror" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="umum" {{ old('kategori', $galeri->kategori) == 'umum' ? 'selected' : '' }}>Umum</option>
                                        <option value="before-after" {{ old('kategori', $galeri->kategori) == 'before-after' ? 'selected' : '' }}>Before After</option>
                                        <option value="promo" {{ old('kategori', $galeri->kategori) == 'promo' ? 'selected' : '' }}>Promo</option>
                                    </select>
                                    @error('kategori')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                                <textarea name="deskripsi" placeholder="Masukkan deskripsi galeri (opsional)" rows="4" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors resize-none @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar</label>
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1">
                                        <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#3B2A7A] focus:border-transparent transition-colors @error('gambar') border-red-500 @enderror" onchange="previewImage(this)">
                                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB) - Kosongkan jika tidak ingin mengubah gambar</p>
                                        @error('gambar')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="w-32 h-32 border border-gray-300 flex items-center justify-center bg-gray-50">
                                        @if($galeri->gambar)
                                            <img id="imagePreview" src="{{ asset('storage/' . $galeri->gambar) }}" alt="Current Image" class="w-full h-full object-cover">
                                        @else
                                            <img id="imagePreview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                                        @endif
                                        <svg id="imagePlaceholder" class="w-8 h-8 text-gray-400 {{ $galeri->gambar ? 'hidden' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $galeri->is_active) ? 'checked' : '' }} class="w-4 h-4 text-[#3B2A7A] border-gray-300 focus:ring-[#3B2A7A]">
                                    <span class="ml-2 text-sm text-gray-700">Aktifkan galeri</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.galeri.index') }}" class="px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 hover:bg-gray-200 transition-colors">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-[#3B2A7A] border border-transparent hover:bg-[#2D1B69] transition-colors shadow-sm">
                                Update
                            </button>
                        </div>
                    </form>
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
            }
        }
    </script>
</x-admin.dashboard-layout>
