<x-user.dashboard-layout>
    <div class="bg-white border-2 border-[#0F044C] p-6">
        <!-- Header Section (match admin style) -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-montserrat-48 text-gray-900">
                {{ isset($car) ? 'EDIT MOBIL' : 'TAMBAH MOBIL' }}
            </h1>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 border-2 border-gray-400 text-gray-700 hover:bg-gray-100 rounded-sm defparagraf">Kembali</a>
        </div>

        @if ($errors->any())
            <div class="mb-4 border border-red-300 bg-red-50 text-red-700 p-3">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ isset($car) ? route('user.mobil.update', $car->id_mobil) : route('user.mobil.store') }}" 
              method="POST" class="space-y-5">
            @csrf
            @if(isset($car))
                @method('PUT')
            @endif

            <!-- Nama Mobil -->
            <div>
                <label for="nama_mobil" class="block defparagraf mb-1">
                    Nama Mobil <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama_mobil" 
                       name="nama_mobil" 
                       value="{{ old('nama_mobil', $car->nama_mobil ?? '') }}"
                       class="w-full border-2 border-gray-300 px-3 py-2 rounded-none defparagraf @error('nama_mobil') border-red-500 @enderror"
                       placeholder="Contoh: Toyota Avanza, Honda Civic, dll"
                       required>
                @error('nama_mobil')
                    <p class="mt-1 text-sm text-red-600 defparagraf">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jenis Mobil -->
            <div>
                <label for="jenis_mobil" class="block defparagraf mb-1">
                    Jenis Mobil <span class="text-red-500">*</span>
                </label>
                <select id="jenis_mobil" 
                        name="jenis_mobil" 
                        class="w-full border-2 border-gray-300 px-3 py-2 rounded-none defparagraf @error('jenis_mobil') border-red-500 @enderror"
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
                <label for="plat_nomor" class="block defparagraf mb-1">
                    Plat Nomor <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="plat_nomor" 
                       name="plat_nomor" 
                       value="{{ old('plat_nomor', $car->plat_nomor ?? '') }}"
                       class="w-full border-2 border-gray-300 px-3 py-2 rounded-none defparagraf font-mono text-lg @error('plat_nomor') border-red-500 @enderror"
                       placeholder="Contoh: B 1234 ABC"
                       style="text-transform: uppercase;"
                       required>
                <p class="mt-1 text-sm text-gray-500 defparagraf">Format: B 1234 ABC (akan otomatis diubah ke huruf besar)</p>
                @error('plat_nomor')
                    <p class="mt-1 text-sm text-red-600 defparagraf">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons (match admin style) -->
            <div class="pt-3 flex gap-3">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 border-2 border-gray-400 text-gray-700 rounded-none">Batal</a>
                @if(isset($car))
                    <form action="{{ route('user.mobil.destroy', $car->id_mobil) }}" method="POST" onsubmit="return confirm('Hapus mobil ini? Tindakan tidak dapat dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white rounded-none">Hapus</button>
                    </form>
                @endif
                <button type="submit" class="px-4 py-2 bg-[#141E61] text-white hover:bg-[#0F044C] rounded-none">
                    {{ isset($car) ? 'Perbarui Mobil' : 'Simpan Mobil' }}
                </button>
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
