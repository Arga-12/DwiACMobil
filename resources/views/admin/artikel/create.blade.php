<x-admin.dashboard-layout title="Tambah Artikel - Dwi AC Mobil">
    <div class="space-y-6 sm:space-y-8">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-montserrat-48 text-gray-900 uppercase">Tambah Artikel</h1>
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
            <form method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Judul</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="w-full border-2 border-gray-300 px-3 py-2 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C]" required>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" class="w-full border-2 border-gray-300 px-3 py-2 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C]" required>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Gambar</label>
                    <input type="file" name="foto" accept="image/*" class="w-full border-2 border-gray-300 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Harga Mulai (Rp)</label>
                    <input type="hidden" name="price" id="price" value="{{ old('price') }}">
                    <input type="text" id="price_display" inputmode="numeric" autocomplete="off" class="w-full border-2 border-gray-300 px-3 py-2" value="{{ old('price') }}">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Durasi Min</label>
                    <div class="flex gap-2">
                        <input type="number" id="duration_min_display" min="0" class="w-full border-2 border-gray-300 px-3 py-2" value="{{ old('duration_min') }}">
                        <select id="duration_min_unit" class="border-2 border-gray-300 px-3 py-2">
                            <option value="minute" selected>Menit</option>
                            <option value="hour">Jam</option>
                            <option value="day">Hari</option>
                        </select>
                    </div>
                    <input type="hidden" name="duration_min" id="duration_min" value="{{ old('duration_min') }}">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Durasi Max</label>
                    <div class="flex gap-2">
                        <input type="number" id="duration_max_display" min="0" class="w-full border-2 border-gray-300 px-3 py-2" value="{{ old('duration_max') }}">
                        <select id="duration_max_unit" class="border-2 border-gray-300 px-3 py-2">
                            <option value="minute" selected>Menit</option>
                            <option value="hour">Jam</option>
                            <option value="day">Hari</option>
                        </select>
                    </div>
                    <input type="hidden" name="duration_max" id="duration_max" value="{{ old('duration_max') }}">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Garansi (hari)</label>
                    <input type="number" name="guarantee_days" value="{{ old('guarantee_days') }}" min="0" class="w-full border-2 border-gray-300 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Tanggal Publikasi</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="w-full border-2 border-gray-300 px-3 py-2">
                </div>
                <div class="md:col-span-2 flex items-center gap-3">
                    <input id="is_published" type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="w-4 h-4 border-2 border-gray-300">
                    <label for="is_published" class="text-sm text-gray-700 defparagraf">Tampilkan ke publik</label>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full border-2 border-gray-300 px-3 py-2">{{ old('description') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-700 defparagraf mb-1">Perlu Diketahui</label>
                    <div id="points_container" class="space-y-2">
                        @php
                            $oldPoints = old('points');
                            $pointsArray = is_array($oldPoints) ? $oldPoints : [];
                        @endphp
                        @if (!empty($pointsArray))
                            @foreach ($pointsArray as $p)
                                <div class="flex gap-2">
                                    <input type="text" name="points[]" class="w-full border-2 border-gray-300 px-3 py-2" value="{{ $p }}">
                                    <button type="button" class="px-3 py-2 border-2 border-gray-300 text-gray-700 remove-point">-</button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex gap-2">
                                <input type="text" name="points[]" class="w-full border-2 border-gray-300 px-3 py-2" placeholder="Contoh: Cek kebocoran dulu">
                                <button type="button" class="px-3 py-2 border-2 border-gray-300 text-gray-700 remove-point">-</button>
                            </div>
                        @endif
                    </div>
                    <div class="mt-2">
                        <button type="button" id="add_point" class="px-3 py-2 bg-[#0F044C] hover:bg-[#141E61] text-white">+ Tambah Poin</button>
                    </div>
                </div>
                <div class="md:col-span-2 flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('admin.artikel.index') }}" class="px-4 py-2 border-2 border-gray-300 text-gray-700">Batal</a>
                    <button type="submit" class="px-5 py-2 bg-[#0F044C] hover:bg-[#141E61] text-white">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function(){
            // Slug auto-fill
            const title = document.querySelector('input[name="title"]');
            const slug = document.querySelector('input[name="slug"]');
            function slugify(s){ return s.toString().toLowerCase().trim().replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-'); }
            if(title && slug){ title.addEventListener('input', ()=>{ if(!slug.value){ slug.value = slugify(title.value); } }); }

            // Price formatting (thousand separators) with hidden integer field
            const priceHidden = document.getElementById('price');
            const priceDisplay = document.getElementById('price_display');
            const nfID = new Intl.NumberFormat('id-ID');
            function syncPrice(){
                const digits = (priceDisplay.value || '').replace(/\D+/g,'');
                priceHidden.value = digits || '';
                priceDisplay.value = digits ? nfID.format(parseInt(digits,10)) : '';
            }
            if(priceDisplay && priceHidden){
                // initialize
                if(priceHidden.value){ priceDisplay.value = nfID.format(parseInt(priceHidden.value,10)); }
                priceDisplay.addEventListener('input', syncPrice);
                priceDisplay.addEventListener('blur', syncPrice);
            }

            // Duration converters (Menit/Jam/Hari) for min/max
            function initDuration(prefix){
                const input = document.getElementById(prefix + '_display');
                const unit = document.getElementById(prefix + '_unit');
                const hidden = document.getElementById(prefix);
                const factors = { minute: 1, hour: 60, day: 1440 };
                function updateHidden(){
                    const val = parseInt(input.value || '0', 10);
                    const factor = factors[unit.value] || 1;
                    const minutes = isNaN(val) ? '' : String(val * factor);
                    hidden.value = minutes;
                }
                if(input && unit && hidden){
                    input.addEventListener('input', updateHidden);
                    unit.addEventListener('change', updateHidden);
                    updateHidden();
                }
            }
            initDuration('duration_min');
            initDuration('duration_max');

            // Dynamic points rows
            const pointsContainer = document.getElementById('points_container');
            const addPointBtn = document.getElementById('add_point');
            function makeRow(value=''){
                const wrap = document.createElement('div');
                wrap.className = 'flex gap-2';
                wrap.innerHTML = `<input type="text" name="points[]" class="w-full border-2 border-gray-300 px-3 py-2" value="${value.replace(/"/g,'&quot;')}">`+
                                 `<button type="button" class="px-3 py-2 border-2 border-gray-300 text-gray-700 remove-point">-</button>`;
                return wrap;
            }
            if(addPointBtn && pointsContainer){
                addPointBtn.addEventListener('click', ()=>{
                    pointsContainer.appendChild(makeRow(''));
                });
                pointsContainer.addEventListener('click', (e)=>{
                    if(e.target && e.target.classList.contains('remove-point')){
                        const row = e.target.closest('div');
                        if(pointsContainer.children.length > 1){ row.remove(); }
                    }
                });
            }
        })();
    </script>
</x-admin.dashboard-layout>
