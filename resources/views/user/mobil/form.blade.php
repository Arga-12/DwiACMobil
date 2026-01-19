<x-user.dashboard-layout>
    <!-- Header Section with Gradient -->
    <div class="mb-8">
        <div class="bg-gradient-to-br from-[#0F044C] via-[#1D2C90] to-[#192BC2] text-white rounded-2xl px-6 py-6 shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <div class="w-40 h-40 bg-white/10 rounded-full blur-3xl absolute -right-16 top-0"></div>
                <div class="w-32 h-32 bg-white/5 rounded-full blur-3xl absolute -left-10 bottom-0"></div>
            </div>
            <div class="relative flex items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-montserrat-48 font-bold leading-tight uppercase">
                        {{ isset($car) ? 'EDIT DATA MOBIL' : 'TAMBAH MOBIL BARU' }}
                    </h1>
                    <p class="mt-1 text-sm text-white/85 defparagraf">
                        {{ isset($car) ? 'Perbarui informasi mobil Anda' : 'Daftarkan mobil Anda untuk kemudahan booking' }}
                    </p>
                </div>
                <a href="{{ route('dashboard') }}" class="px-5 py-3 bg-white/20 hover:bg-white/30 text-white rounded-xl font-semibold defparagraf inline-flex items-center gap-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
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

        @if ($errors->any())
            <div class="mb-6 border-2 border-red-300 bg-red-50 text-red-700 p-4 rounded-xl">
                <ul class="list-disc list-inside text-sm space-y-1 defparagraf">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ isset($car) ? route('user.mobil.update', $car->id_mobil) : route('user.mobil.store') }}" 
              method="POST" class="space-y-6">
            @csrf
            @if(isset($car))
                @method('PUT')
            @endif

            <!-- Nama Mobil -->
            <div>
                <label for="nama_mobil" class="block text-sm font-bold text-[#0F044C] mb-2 defparagraf">
                    Nama Mobil <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama_mobil" 
                       name="nama_mobil" 
                       value="{{ old('nama_mobil', $car->nama_mobil ?? '') }}"
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf @error('nama_mobil') border-red-500 @enderror"
                       placeholder="Contoh: Toyota Avanza, Honda Civic, dll"
                       required>
                @error('nama_mobil')
                    <p class="mt-1 text-sm text-red-600 defparagraf">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jenis Mobil -->
            <div>
                <label for="jenis_mobil" class="block text-sm font-bold text-[#0F044C] mb-2 defparagraf">
                    Jenis Mobil <span class="text-red-500">*</span>
                </label>
                <select id="jenis_mobil" 
                        name="jenis_mobil" 
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf @error('jenis_mobil') border-red-500 @enderror"
                        required>
                    <option value="">Pilih jenis mobil</option>
                    <option value="Sedan" {{ old('jenis_mobil', $car->jenis_mobil ?? '') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                    <option value="Hatchback" {{ old('jenis_mobil', $car->jenis_mobil ?? '') == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                    <option value="SUV" {{ old('jenis_mobil', $car->jenis_mobil ?? '') == 'SUV' ? 'selected' : '' }}>SUV</option>
                    <option value="MPV" {{ old('jenis_mobil', $car->jenis_mobil ?? '') == 'MPV' ? 'selected' : '' }}>MPV</option>
                    <option value="Pick Up" {{ old('jenis_mobil', $car->jenis_mobil ?? '') == 'Pick Up' ? 'selected' : '' }}>Pick Up</option>
                    <option value="Convertible" {{ old('jenis_mobil', $car->jenis_mobil ?? '') == 'Convertible' ? 'selected' : '' }}>Convertible</option>
                    <option value="Coupe" {{ old('jenis_mobil', $car->jenis_mobil ?? '') == 'Coupe' ? 'selected' : '' }}>Coupe</option>
                    <option value="Wagon" {{ old('jenis_mobil', $car->jenis_mobil ?? '') == 'Wagon' ? 'selected' : '' }}>Wagon</option>
                    <option value="Lainnya" {{ old('jenis_mobil', $car->jenis_mobil ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('jenis_mobil')
                    <p class="mt-1 text-sm text-red-600 defparagraf">{{ $message }}</p>
                @enderror
            </div>

            <!-- Plat Nomor -->
            <div>
                <label for="plat_nomor" class="block text-sm font-bold text-[#0F044C] mb-2 defparagraf">
                    Plat Nomor <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="plat_nomor" 
                       name="plat_nomor" 
                       value="{{ old('plat_nomor', $car->plat_nomor ?? '') }}"
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf font-mono text-lg @error('plat_nomor') border-red-500 @enderror"
                       placeholder="Contoh: B 1234 ABC"
                       style="text-transform: uppercase;"
                       required>
                <p class="mt-1 text-xs text-gray-500 defparagraf">Format: B 1234 ABC (akan otomatis diubah ke huruf besar)</p>
                @error('plat_nomor')
                    <p class="mt-1 text-sm text-red-600 defparagraf">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center {{ isset($car) ? 'justify-between' : 'justify-end' }} pt-6 mt-8 border-t border-gray-200 gap-3">
                @if(isset($car))
                    <!-- Delete Button (Left) -->
                    <form action="{{ route('user.mobil.destroy', $car->id_mobil) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mobil ini? Tindakan tidak dapat dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-6 py-3 border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition-colors defparagraf font-medium">
                            Hapus Mobil
                        </button>
                    </form>
                @endif

                <!-- Action Buttons (Right) -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 border-2 border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors defparagraf font-medium">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#0F044C] to-[#1D2C90] text-white hover:opacity-95 rounded-lg transition-all shadow-sm defparagraf font-medium">
                        {{ isset($car) ? 'Perbarui Mobil' : 'Simpan Mobil' }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Auto uppercase plat nomor input
        document.getElementById('plat_nomor').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
    </script>
</x-user.dashboard-layout>
