<x-admin.dashboard-layout title="Manajemen Artikel - Dwi AC Mobil">
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 text-gray-900 uppercase mb-2">Manajemen Artikel</h1>
                    <p class="text-gray-600 defparagraf">Kelola artikel layanan untuk edukasi pelanggan.</p>
                </div>
                <a href="{{ route('admin.artikel.create') }}" class="bg-[#0F044C] hover:bg-[#141E61] text-white px-6 py-3 defparagraf font-medium flex items-center space-x-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah Artikel</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="p-3 bg-green-100 border border-green-300 text-green-800 defparagraf">{{ session('success') }}</div>
        @endif

        <!-- PENCARIAN Section -->
        <div class="space-y-4">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <form method="GET" class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul atau slug..." class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] transition-colors defparagraf" disabled>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- DAFTAR ARTIKEL Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900">DAFTAR ARTIKEL</h2>

            <div class="bg-white border-2 border-[#0F044C] shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#141E61]">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Gambar</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Slug</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold defparagraf text-white uppercase tracking-wider">Diperbarui</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold defparagraf text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($items as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm">
                                        <div class="w-14 h-14 rounded-xl overflow-hidden bg-gray-100">
                                            @if($item->foto)
                                                <img src="{{ asset($item->foto) }}" alt="{{ $item->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class="hidden w-full h-full items-center justify-center text-xs text-gray-600">No Img</div>
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-xs text-gray-600">No Img</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="text-gray-900 font-medium">{{ $item->title }}</div>
                                        <div class="text-xs text-gray-500 defparagraf line-clamp-1">{{ \Illuminate\Support\Str::limit($item->description ?? '', 80) }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->slug }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->updated_at?->format('d M Y, H:i') }}</td>
                                    <td class="px-6 py-4 text-right text-sm">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="#" class="px-3 py-1 border-2 border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white transition-colors cursor-not-allowed" title="Belum tersedia">Lihat</a>
                                            <a href="{{ route('admin.artikel.edit', $item->id) }}" class="px-3 py-1 border-2 border-[#0F044C] text-[#0F044C] hover:bg-[#0F044C] hover:text-white transition-colors">Edit</a>
                                            <button type="button" class="px-3 py-1 border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white transition-colors cursor-not-allowed" title="Belum tersedia">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-6 text-center text-sm text-gray-600">Belum ada data artikel.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($items->hasPages())
                <div class="mt-4">
                    {{ $items->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin.dashboard-layout>
