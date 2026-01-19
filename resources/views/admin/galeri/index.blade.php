<x-admin.dashboard-layout title="Manajemen Galeri - Dwi AC Mobil">
    <!-- Dashboard Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 defparagraf rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <div class="bg-gradient-to-br from-[#0F044C] via-[#1D2C90] to-[#192BC2] text-white rounded-2xl px-5 py-6 sm:px-7 sm:py-7 shadow-2xl relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="w-40 h-40 bg-white/10 rounded-full blur-3xl absolute -right-16 top-0"></div>
                    <div class="w-32 h-32 bg-white/5 rounded-full blur-3xl absolute -left-10 bottom-0"></div>
                </div>
                <div class="relative flex items-start sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-montserrat-48 font-bold leading-tight uppercase">Manajemen Galeri</h1>
                        <p class="mt-1 text-sm sm:text-base text-white/85 defparagraf">Kelola foto galeri AC mobil.</p>
                    </div>
                    <a href="{{ route('admin.galeri.create') }}" class="px-5 py-3 bg-white text-[#0F044C] rounded-xl font-semibold defparagraf inline-flex items-center gap-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Tambah Galeri</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- GALERI FOTO Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-bold uppercase">Galeri Foto</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($galeris as $galeri)
                    <div class="bg-white border-2 border-[#0F044C]/20 rounded-2xl shadow-md overflow-hidden hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        <div class="aspect-square overflow-hidden">
                            <img src="{{ $galeri->foto ? asset('storage/galeri/' . $galeri->foto) : 'https://via.placeholder.com/300x300?text=No+Image' }}"
                                 alt="{{ $galeri->nama_foto }}"
                                 class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold defparagraf text-[#0F044C] mb-2 line-clamp-2">{{ $galeri->nama_foto }}</h3>
                            <p class="text-xs defparagraf text-[#787A91] mb-3">{{ $galeri->created_at->format('d M Y, H:i') }}</p>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.galeri.edit', $galeri->id_galeri) }}" class="flex-1 text-center px-3 py-2 text-xs font-medium defparagraf text-[#141E61] bg-[#141E61]/10 hover:bg-[#141E61] hover:text-white transition-all duration-200 rounded">
                                    Edit
                                </a>
                                <button onclick="deleteGaleri({{ $galeri->id_galeri }})" class="flex-1 text-center px-3 py-2 text-xs font-medium defparagraf text-red-600 bg-red-50 hover:bg-red-600 hover:text-white transition-all duration-200 rounded">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-[#787A91]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M2 14c0-3.771 0-5.657 1.172-6.828S6.229 6 10 6h4c3.771 0 5.657 0 6.828 1.172S22 10.229 22 14s0 5.657-1.172 6.828S17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.172S2 17.771 2 14Z"/>
                                <path d="m4 7l-.012-1c.112-.931.347-1.574.837-2.063C5.765 3 7.279 3 10.307 3h3.211c3.028 0 4.541 0 5.482.937c.49.489.725 1.132.837 2.063v1"/>
                                <circle cx="17.5" cy="10.5" r="1.5"/>
                                <path stroke-linecap="round" d="m2 14.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 20.5"/>
                            </g>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium defparagraf text-[#0F044C]">Belum ada galeri</h3>
                        <p class="mt-1 text-sm defparagraf text-[#787A91]">Mulai dengan menambahkan foto galeri pertama.</p>
                    </div>
                @endforelse
            </div>
        </div>

        @if($galeris->hasPages())
            <div class="flex justify-center">
                <div class="defparagraf text-[#787A91]">{{ $galeris->links() }}</div>
            </div>
        @endif
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-5">
            <div class="text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Hapus Galeri</h3>
                <p class="text-sm text-gray-500 mb-4">Yakin ingin menghapus foto galeri ini?</p>
                <div class="flex justify-center space-x-3">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</button>
                    <button onclick="confirmDelete()" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteId = null;

        function deleteGaleri(id) {
            currentDeleteId = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            currentDeleteId = null;
        }

        function confirmDelete() {
            if (currentDeleteId) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/galeri/${currentDeleteId}`;

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</x-admin.dashboard-layout>
