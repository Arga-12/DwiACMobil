<x-admin.dashboard-layout title="Edit Artikel - Dwi AC Mobil">
    <div class="space-y-6 sm:space-y-8">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-montserrat-48 text-gray-900 uppercase">Edit Artikel</h1>
            <a href="{{ route('admin.artikel.index') }}" class="px-4 py-2 border-2 border-gray-300 text-gray-700 hover:bg-gray-100">Kembali</a>
        </div>

        @if ($errors->any())
            <div class="p-3 bg-red-100 border border-red-300 text-red-800 defparagraf">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white border-2 border-[#0F044C] p-5">
            <form method="POST" action="{{ route('admin.artikel.update', $item->id) }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $item->title) }}" class="w-full border-2 border-gray-300 px-3 py-2 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C]" required>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $item->slug) }}" class="w-full border-2 border-gray-300 px-3 py-2 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C]" required>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Gambar</label>
                    <input type="file" name="foto" accept="image/*" class="w-full border-2 border-gray-300 px-3 py-2">
                    @if($item->foto)
                        <div class="mt-2 text-xs text-gray-600">Gambar saat ini:</div>
                        <div class="mt-1 w-24 h-24 rounded-xl overflow-hidden bg-gray-100">
                            <img src="{{ asset($item->foto) }}" alt="{{ $item->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'">
                        </div>
                    @endif
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Harga Mulai (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $item->price) }}" min="0" class="w-full border-2 border-gray-300 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Durasi Min (menit)</label>
                    <input type="number" name="duration_min" value="{{ old('duration_min', $item->duration_min) }}" min="0" class="w-full border-2 border-gray-300 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Durasi Max (menit)</label>
                    <input type="number" name="duration_max" value="{{ old('duration_max', $item->duration_max) }}" min="0" class="w-full border-2 border-gray-300 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Garansi (hari)</label>
                    <input type="number" name="guarantee_days" value="{{ old('guarantee_days', $item->guarantee_days) }}" min="0" class="w-full border-2 border-gray-300 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Tanggal Publikasi</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at', optional($item->published_at)->format('Y-m-d\TH:i')) }}" class="w-full border-2 border-gray-300 px-3 py-2">
                </div>
                <div class="md:col-span-2 flex items-center gap-3">
                    <input id="is_published" type="checkbox" name="is_published" value="1" {{ old('is_published', (bool)($item->is_published ?? false)) ? 'checked' : '' }} class="w-4 h-4 border-2 border-gray-300">
                    <label for="is_published" class="text-sm text-gray-700 defparagraf">Tampilkan ke publik</label>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full border-2 border-gray-300 px-3 py-2">{{ old('description', $item->description) }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Perlu Diketahui (satu poin per baris)</label>
                    <textarea name="points" rows="3" class="w-full border-2 border-gray-300 px-3 py-2" placeholder="Contoh:
Cek kebocoran dulu
Gunakan refrigerant sesuai spesifikasi">{{ old('points', is_array($item->points ?? null) ? implode("\n", $item->points) : ($item->points ?? '') ) }}</textarea>
                </div>
                <div class="md:col-span-2 flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('admin.artikel.index') }}" class="px-4 py-2 border-2 border-gray-300 text-gray-700">Batal</a>
                    <button type="submit" class="px-5 py-2 bg-[#0F044C] hover:bg-[#141E61] text-white">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function(){
            const title = document.querySelector('input[name="title"]');
            const slug = document.querySelector('input[name="slug"]');
            function slugify(s){ return s.toString().toLowerCase().trim().replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-'); }
            if(title && slug){ title.addEventListener('input', ()=>{ if(!slug.value){ slug.value = slugify(title.value); } }); }
        })();
    </script>
</x-admin.dashboard-layout>
