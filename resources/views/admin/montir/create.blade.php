<x-admin.dashboard-layout title="Tambah Montir - Dwi AC Mobil">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Tambah Montir Baru</h1>
                    <p class="text-gray-600">Masukkan informasi montir yang akan ditambahkan</p>
                </div>

                <!-- Form -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <form action="{{ route('admin.montir.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Error Messages -->
                        @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama *</label>
                                <input type="text" name="nama" value="{{ old('nama') }}" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <!-- Telepon -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Telepon *</label>
                                <input type="text" name="telepon" value="{{ old('telepon') }}" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <!-- Spesialisasi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Spesialisasi *</label>
                                <select name="spesialisasi" required 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Spesialisasi</option>
                                    <option value="Mesin" {{ old('spesialisasi') == 'Mesin' ? 'selected' : '' }}>Mesin</option>
                                    <option value="Transmisi" {{ old('spesialisasi') == 'Transmisi' ? 'selected' : '' }}>Transmisi</option>
                                    <option value="Rem" {{ old('spesialisasi') == 'Rem' ? 'selected' : '' }}>Rem</option>
                                    <option value="AC" {{ old('spesialisasi') == 'AC' ? 'selected' : '' }}>AC</option>
                                    <option value="Kelistrikan" {{ old('spesialisasi') == 'Kelistrikan' ? 'selected' : '' }}>Kelistrikan</option>
                                    <option value="Body" {{ old('spesialisasi') == 'Body' ? 'selected' : '' }}>Body</option>
                                    <option value="Umum" {{ old('spesialisasi') == 'Umum' ? 'selected' : '' }}>Umum</option>
                                </select>
                            </div>
                            
                            <!-- Pengalaman -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pengalaman (tahun) *</label>
                                <input type="number" name="pengalaman" value="{{ old('pengalaman') }}" min="0" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <!-- Rating -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Rating (0-5)</label>
                                <input type="number" name="rating" value="{{ old('rating', '0') }}" min="0" max="5" step="0.1" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        
                        <!-- Alamat -->
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <textarea name="alamat" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('alamat') }}</textarea>
                        </div>
                        
                        <!-- Foto -->
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                            <input type="file" name="foto" accept="image/*" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   onchange="previewImage(this)">
                            <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-4 hidden">
                                <img id="preview" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border">
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="mt-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" {{ old('is_active', true) ? 'checked' : '' }} 
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Aktif</span>
                            </label>
                        </div>
                        
                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-3 mt-8">
                            <a href="{{ route('admin.montir.index') }}" 
                               class="px-6 py-2 text-sm font-medium text-gray-700 bg-gray-200 border border-gray-300 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        };
        
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.classList.add('hidden');
    }
}
</script>
</x-admin.dashboard-layout>
