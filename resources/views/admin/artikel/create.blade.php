<x-admin.dashboard-layout title="Tambah Artikel - Dwi AC Mobil">
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <x-admin.page-indicator
            :title="'Tambah Artikel'"
            :desc="'Buat artikel layanan baru untuk edukasi pelanggan.'"
            :ctaLabel="'Kembali'"
            :ctaHref="route('admin.artikel.index')"
        />

        @if ($errors->any())
            <div class="p-3 bg-red-100 border border-red-300 text-red-800 defparagraf">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-4 sm:p-6">
            <form method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-700 defparagraf mb-2 font-medium">Judul Artikel</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-[#1D2C90]/40 focus:border-[#1D2C90] defparagraf"
                               required placeholder="Contoh: Isi Freon AC Mobil">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 defparagraf mb-2 font-medium">Slug URL</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-[#1D2C90]/40 focus:border-[#1D2C90] defparagraf"
                               required placeholder="isi-freon-ac-mobil">
                        <p class="text-xs text-gray-500 mt-1">URL artikel: /layanan/<span id="slug-preview">isi-freon-ac-mobil</span></p>
                    </div>
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-2 font-medium">Gambar Artikel</label>
                    <input type="file" name="foto" id="foto" accept="image/*"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 defparagraf">
                    <p class="text-xs text-gray-500 mt-1">Ukuran optimal: 800x600px. Format: JPG, PNG, WebP</p>
                </div>

                <!-- Price, Duration, and Warranty -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm text-gray-700 defparagraf mb-2 font-medium">Harga Mulai (Rp)</label>
                        <input type="hidden" name="harga" id="harga" value="{{ old('harga') }}">
                        <input type="text" id="harga_display" inputmode="numeric" autocomplete="off"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 defparagraf"
                               value="{{ old('harga') }}" placeholder="150000">
                        <p class="text-xs text-gray-500 mt-1">Harga dasar layanan</p>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 defparagraf mb-2 font-medium">Durasi Minimum</label>
                        <div class="flex gap-2">
                            <input type="number" id="durasi_min_display" min="0"
                                   class="flex-1 border border-gray-300 rounded-md px-3 py-2 defparagraf"
                                   value="{{ old('durasi_min') }}" placeholder="60">
                            <select id="durasi_min_unit" class="border border-gray-300 rounded-md px-2 py-2 defparagraf text-sm">
                                <option value="minute" selected>Menit</option>
                                <option value="hour">Jam</option>
                                <option value="day">Hari</option>
                            </select>
                        </div>
                        <input type="hidden" name="durasi_min" id="durasi_min" value="{{ old('durasi_min') }}">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 defparagraf mb-2 font-medium">Durasi Maksimum</label>
                        <div class="flex gap-2">
                            <input type="number" id="durasi_maks_display" min="0"
                                   class="flex-1 border border-gray-300 rounded-md px-3 py-2 defparagraf"
                                   value="{{ old('durasi_maks') }}" placeholder="120">
                            <select id="durasi_maks_unit" class="border border-gray-300 rounded-md px-2 py-2 defparagraf text-sm">
                                <option value="minute" selected>Menit</option>
                                <option value="hour">Jam</option>
                                <option value="day">Hari</option>
                            </select>
                        </div>
                        <input type="hidden" name="durasi_maks" id="durasi_maks" value="{{ old('durasi_maks') }}">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 defparagraf mb-2 font-medium">Garansi (hari)</label>
                        <input type="number" name="garansi_hari" id="garansi_hari" value="{{ old('garansi_hari') }}" min="0"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 defparagraf" placeholder="7">
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-2 font-medium">Deskripsi Layanan</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 defparagraf"
                              placeholder="Jelaskan apa itu layanan ini, mengapa penting, dan manfaatnya untuk pelanggan...">{{ old('deskripsi') }}</textarea>
                </div>

                <!-- Points -->
                <div>
                    <label class="block text-sm text-gray-700 defparagraf mb-2 font-medium">Perlu Diketahui</label>
                    <p class="text-xs text-gray-500 mb-3">Tambahkan poin-poin penting yang perlu diketahui pelanggan</p>
                    <div id="points_container" class="space-y-2">
                        @php
                            $oldPoints = old('poin');
                            $pointsArray = is_array($oldPoints) ? $oldPoints : [];
                        @endphp
                        @if (!empty($pointsArray))
                            @foreach ($pointsArray as $p)
                                <div class="flex gap-2">
                                    <input type="text" name="poin[]" class="w-full border border-gray-300 rounded-md px-3 py-2 defparagraf point-input"
                                           value="{{ $p }}" placeholder="Contoh: Selalu cek kebocoran sebelum isi freon">
                                    <button type="button" class="px-3 py-2 border border-red-300 text-red-600 hover:bg-red-50 rounded-md remove-point">Hapus</button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex gap-2">
                                <input type="text" name="poin[]" class="w-full border border-gray-300 rounded-md px-3 py-2 defparagraf point-input"
                                       placeholder="Contoh: Selalu cek kebocoran sebelum isi freon">
                                <button type="button" class="px-3 py-2 border border-red-300 text-red-600 hover:bg-red-50 rounded-md remove-point">Hapus</button>
                            </div>
                        @endif
                    </div>
                    <div class="mt-3">
                        <button type="button" id="add_point" class="px-4 py-2 bg-[#0F044C] hover:bg-[#141E61] text-white rounded-md defparagraf transition-colors">
                            + Tambah Poin
                        </button>
                    </div>
                </div>

                <!-- Hidden tanggal_publikasi field with current time -->
                <input type="hidden" name="tanggal_publikasi" value="{{ now()->format('Y-m-d\TH:i') }}">

                <!-- Form Actions -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.artikel.index') }}"
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 defparagraf transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-[#0F044C] hover:bg-[#141E61] text-white rounded-md defparagraf transition-colors">
                        Simpan Artikel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        (function(){
            // Form elements
            const titleInput = document.getElementById('judul');
            const slugInput = document.getElementById('slug');
            const priceHidden = document.getElementById('harga');
            const priceDisplay = document.getElementById('harga_display');
            const pointsContainer = document.getElementById('points_container');
            const addPointBtn = document.getElementById('add_point');
            const slugPreview = document.getElementById('slug-preview');

            // Utility functions
            const nfID = new Intl.NumberFormat('id-ID');

            function slugify(text) {
                return text.toString()
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            }

            // Auto-generate slug from title
            if (titleInput && slugInput) {
                titleInput.addEventListener('input', function() {
                    if (!slugInput.value) {
                        const newSlug = slugify(this.value);
                        slugInput.value = newSlug;
                        if (slugPreview) slugPreview.textContent = newSlug;
                    }
                });
            }

            // Update slug preview
            if (slugInput && slugPreview) {
                slugInput.addEventListener('input', function() {
                    slugPreview.textContent = this.value || 'isi-freon-ac-mobil';
                });
            }

            // Price formatting
            function syncPrice() {
                const digits = (priceDisplay.value || '').replace(/\D+/g,'');
                priceHidden.value = digits || '';
                priceDisplay.value = digits ? nfID.format(parseInt(digits,10)) : '';
            }

            if (priceDisplay && priceHidden) {
                if (priceHidden.value) {
                    priceDisplay.value = nfID.format(parseInt(priceHidden.value,10));
                }
                priceDisplay.addEventListener('input', syncPrice);
                priceDisplay.addEventListener('blur', syncPrice);
            }

            // Duration converters
            function initDuration(prefix) {
                const input = document.getElementById(prefix + '_display');
                const unit = document.getElementById(prefix + '_unit');
                const hidden = document.getElementById(prefix);

                if (!input || !unit || !hidden) return;

                const factors = { minute: 1, hour: 60, day: 1440 };

                function updateHidden() {
                    const val = parseInt(input.value || '0', 10);
                    const factor = factors[unit.value] || 1;
                    const minutes = isNaN(val) ? '' : String(val * factor);
                    hidden.value = minutes;
                }

                input.addEventListener('input', updateHidden);
                unit.addEventListener('change', updateHidden);
                updateHidden();
            }

            initDuration('durasi_min');
            initDuration('durasi_maks');

            // Dynamic points management
            function makeRow(value = '') {
                const wrap = document.createElement('div');
                wrap.className = 'flex gap-2';
                wrap.innerHTML = `
                    <input type="text" name="poin[]" class="w-full border border-gray-300 rounded-md px-3 py-2 defparagraf point-input"
                           value="${value.replace(/"/g,'&quot;')}" placeholder="Contoh: Selalu cek kebocoran sebelum isi freon">
                    <button type="button" class="px-3 py-2 border border-red-300 text-red-600 hover:bg-red-50 rounded-md remove-point">Hapus</button>
                `;
                return wrap;
            }

            if (addPointBtn && pointsContainer) {
                addPointBtn.addEventListener('click', function() {
                    const newRow = makeRow('');
                    pointsContainer.appendChild(newRow);
                });

                pointsContainer.addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('remove-point')) {
                        const row = e.target.closest('div');
                        if (pointsContainer.children.length > 1) {
                            row.remove();
                        }
                    }
                });
            }
        })();
    </script>
</x-admin.dashboard-layout>
