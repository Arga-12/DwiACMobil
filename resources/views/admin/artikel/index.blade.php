<x-admin.dashboard-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-48 text-gray-900">Artikel Layanan</h1>
            <div class="flex items-center gap-2">
                <a href="#" class="px-4 py-2 bg-[#0F044C] text-white rounded-xl opacity-60 cursor-not-allowed" title="Form tambah belum tersedia">
                    Tambah Artikel
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <p class="text-sm text-gray-600">Total: {{ $items->total() }} artikel</p>
                    <div class="w-full md:w-64">
                        <input type="text" placeholder="Cari judul atau slug..." class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#787A91]" disabled>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diperbarui</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($items as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <div class="w-14 h-14 rounded-xl overflow-hidden bg-gray-100">
                                        @if($item->image)
                                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="hidden w-full h-full items-center justify-center text-xs text-gray-600">No Img</div>
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-xs text-gray-600">No Img</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900">{{ $item->title }}</div>
                                    <div class="text-xs text-gray-500 line-clamp-1">{{ Str::limit($item->quote ?? '', 80) }}</div>
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $item->slug }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $item->updated_at?->format('d M Y, H:i') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="#" class="px-3 py-1.5 text-xs border rounded-xl text-gray-700 hover:bg-gray-50 cursor-not-allowed" title="Belum tersedia">Lihat</a>
                                        <a href="#" class="px-3 py-1.5 text-xs border rounded-xl text-gray-700 hover:bg-gray-50 cursor-not-allowed" title="Belum tersedia">Edit</a>
                                        <button type="button" class="px-3 py-1.5 text-xs border rounded-xl text-red-600 hover:bg-red-50 cursor-not-allowed" title="Belum tersedia">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">Belum ada data artikel. (Tabel: artike_layanan)</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($items->hasPages())
                <div class="p-4 border-t border-gray-200">
                    {{ $items->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin.dashboard-layout>
