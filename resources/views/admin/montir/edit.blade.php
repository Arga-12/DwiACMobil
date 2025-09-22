<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Montir - Dwi AC Mobil</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
<div class="min-h-screen bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg min-h-screen">
            <!-- Profile Section -->
            <div class="p-4 bg-gray-200">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-gray-300 rounded-full overflow-hidden mb-2">
                        <img src="/images/user/admin-avatar.png" alt="Admin" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                        <div class="w-full h-full bg-gray-400 flex items-center justify-center text-white font-semibold" style="display:none;">A</div>
                    </div>
                    <h3 class="font-semibold text-sm text-gray-800 text-center">Admin</h3>
                    <p class="text-xs text-gray-600 text-center">Administrator</p>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 px-4">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard.main') }}" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-300 border border-gray-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                            </svg>
                            <span class="text-sm">Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.antrian') }}" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-300 border border-gray-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm">Antrian</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.layanan') }}" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-300 border border-gray-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                            </svg>
                            <span class="text-sm">Layanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.galeri.index') }}" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-300 border border-gray-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm">Galeri</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.montir.index') }}" class="flex items-center space-x-3 p-3 bg-[#3B2A7A] text-white cursor-default">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <span class="text-sm">Montir</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Edit Montir</h1>
                    <p class="text-gray-600">Perbarui informasi montir {{ $montir->nama }}</p>
                </div>

                <!-- Form -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <form action="{{ route('admin.montir.update', $montir) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
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
                                <input type="text" name="nama" value="{{ old('nama', $montir->nama) }}" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" value="{{ old('email', $montir->email) }}" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <!-- Telepon -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Telepon *</label>
                                <input type="text" name="telepon" value="{{ old('telepon', $montir->telepon) }}" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <!-- Spesialisasi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Spesialisasi *</label>
                                <select name="spesialisasi" required 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Spesialisasi</option>
                                    <option value="Mesin" {{ old('spesialisasi', $montir->spesialisasi) == 'Mesin' ? 'selected' : '' }}>Mesin</option>
                                    <option value="Transmisi" {{ old('spesialisasi', $montir->spesialisasi) == 'Transmisi' ? 'selected' : '' }}>Transmisi</option>
                                    <option value="Rem" {{ old('spesialisasi', $montir->spesialisasi) == 'Rem' ? 'selected' : '' }}>Rem</option>
                                    <option value="AC" {{ old('spesialisasi', $montir->spesialisasi) == 'AC' ? 'selected' : '' }}>AC</option>
                                    <option value="Kelistrikan" {{ old('spesialisasi', $montir->spesialisasi) == 'Kelistrikan' ? 'selected' : '' }}>Kelistrikan</option>
                                    <option value="Body" {{ old('spesialisasi', $montir->spesialisasi) == 'Body' ? 'selected' : '' }}>Body</option>
                                    <option value="Umum" {{ old('spesialisasi', $montir->spesialisasi) == 'Umum' ? 'selected' : '' }}>Umum</option>
                                </select>
                            </div>
                            
                            <!-- Pengalaman -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pengalaman (tahun) *</label>
                                <input type="number" name="pengalaman" value="{{ old('pengalaman', $montir->pengalaman) }}" min="0" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <!-- Rating -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Rating (0-5)</label>
                                <input type="number" name="rating" value="{{ old('rating', $montir->rating) }}" min="0" max="5" step="0.1" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        
                        <!-- Alamat -->
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <textarea name="alamat" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('alamat', $montir->alamat) }}</textarea>
                        </div>
                        
                        <!-- Foto -->
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                            
                            <!-- Current Photo -->
                            @if($montir->foto)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                                <img src="{{ asset('storage/' . $montir->foto) }}" alt="{{ $montir->nama }}" class="w-32 h-32 object-cover rounded-lg border">
                            </div>
                            @endif
                            
                            <input type="file" name="foto" accept="image/*" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   onchange="previewImage(this)">
                            <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</p>
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">Preview foto baru:</p>
                                <img id="preview" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border">
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="mt-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" {{ old('is_active', $montir->is_active) ? 'checked' : '' }} 
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
                                Perbarui
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
</body>
</html>
