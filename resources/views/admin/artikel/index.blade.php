<x-admin.dashboard-layout title="Manajemen Artikel - Dwi AC Mobil">
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">


        <x-admin.page-indicator
            :title="'Manajemen Artikel'"
            :desc="'Kelola artikel layanan untuk edukasi pelanggan.'"
            :ctaLabel="'Tambah Artikel'"
            :ctaHref="route('admin.artikel.create')"
        />

        @if(session('success'))
            <div class="p-3 bg-green-100 border border-green-300 text-green-800 defparagraf">{{ session('success') }}</div>
        @endif

        <!-- Toolbar -->
        <div class="bg-white border border-gray-200 p-3 sm:p-4 rounded-xl">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-center">
                <div class="md:col-span-2 relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19zM9.5 14A4.5 4.5 0 1 1 14 9.5A4.505 4.505 0 0 1 9.5 14"/></svg>
                    <input type="text" placeholder="Cari judul atau slug..." class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1D2C90]/40 focus:border-[#1D2C90] defparagraf" disabled>
                </div>
                <div class="flex gap-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50 defparagraf w-full">Reset</button>
                    <button class="px-4 py-2 bg-[#0F044C] hover:bg-[#141E61] text-white rounded-md defparagraf w-full">Filter</button>
                </div>
            </div>
        </div>

        <!-- DAFTAR ARTIKEL Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900">DAFTAR ARTIKEL</h2>

            <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-4 sm:p-5">
                @if($items->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5">
                        @foreach($items as $item)
                            <div class="group border border-gray-200 rounded-xl overflow-hidden bg-white hover:shadow-md transition-shadow flex flex-col">
                                <div class="relative bg-gray-100 aspect-[16/9]">
                                    @php
                                        // Handle foto path with priority: uploaded > static > default
                                        $imgSrc = null;
                                        if (!empty($item->foto)) {
                                            if (str_starts_with($item->foto, 'http')) {
                                                $imgSrc = $item->foto;
                                            } elseif (str_contains($item->foto, '/') && file_exists(storage_path('app/public/' . $item->foto))) {
                                                $imgSrc = asset('storage/' . $item->foto);
                                            } elseif (file_exists(public_path($item->foto))) {
                                                $imgSrc = asset($item->foto);
                                            }
                                        }
                                    @endphp
                                    @if($imgSrc)
                                        <img src="{{ $imgSrc }}" alt="{{ $item->judul }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="hidden absolute inset-0 items-center justify-center text-xs text-gray-600">No Img</div>
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center text-xs text-gray-600">No Img</div>
                                    @endif
                                </div>
                                <div class="p-4 flex-1 flex flex-col gap-2">
                                    <div class="flex items-start justify-between gap-3">
                                        <h3 class="text-sm sm:text-base font-semibold text-gray-900 leading-snug line-clamp-2">{{ $item->judul }}</h3>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[11px] sm:text-xs px-2 py-0.5 rounded-md bg-gray-100 text-gray-700">{{ $item->slug }}</span>
                                        <span class="text-[11px] sm:text-xs text-gray-500">{{ $item->updated_at?->format('d M Y, H:i') }}</span>
                                    </div>
                                    <p class="text-xs text-gray-600 defparagraf line-clamp-2">{{ \Illuminate\Support\Str::limit($item->deskripsi ?? '', 120) }}</p>
                                    <div class="mt-auto pt-2 flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.artikel.edit', $item->id) }}" class="px-3 py-1.5 border border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white rounded-md text-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.artikel.destroy', $item->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 border border-red-600 text-red-600 hover:bg-red-600 hover:text-white rounded-md text-sm">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white border-2 border-[#0F044C]/20 rounded-3xl p-12 text-center">
                        <div class="flex flex-col items-center justify-center space-y-6">
                            <!-- SVG Icon -->
                            <div class="w-24 h-24 text-[#0F044C]/40">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24">
                                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M3 10c0-3.771 0-5.657 1.172-6.828S7.229 2 11 2h2c3.771 0 5.657 0 6.828 1.172S21 6.229 21 10v4c0 3.771 0 5.657-1.172 6.828S16.771 22 13 22h-2c-3.771 0-5.657 0-6.828-1.172S3 17.771 3 14z"/>
                                        <path d="M6 12c0-1.414 0-2.121.44-2.56C6.878 9 7.585 9 9 9h6c1.414 0 2.121 0 2.56.44c.44.439.44 1.146.44 2.56v4c0 1.414 0 2.121-.44 2.56c-.439.44-1.146.44-2.56.44H9c-1.414 0-2.121 0-2.56-.44C6 18.122 6 17.415 6 16z"/>
                                        <path stroke-linecap="round" d="M7 6h5"/>
                                    </g>
                                </svg>
                            </div>

                            <!-- Empty State Text -->
                            <div class="space-y-2">
                                <h3 class="bigparagraf font-bold text-[#0F044C]">Belum Ada Artikel Layanan</h3>
                                <p class="defparagraf text-[#0F044C]/70 max-w-md">
                                    Mulai buat artikel layanan pertama untuk memberikan informasi kepada pelanggan.
                                </p>
                            </div>

                            <!-- Create Button -->
                            <a href="{{ route('admin.artikel.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#0F044C] text-white rounded-xl font-semibold hover:bg-[#141E61] transition-colors">
                                <span class="defparagraf">Buat Artikel</span>
                                <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            @if($items->hasPages())
                <div class="mt-4 flex justify-center">
                    {{ $items->onEachSide(1)->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin.dashboard-layout>
