<x-admin.dashboard-layout title="Manajemen Galeri - Dwi AC Mobil">
    <!-- Dashboard Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        @if(session('success'))
            <div class="bg-green-100 border-2 border-green-400 text-green-700 px-4 py-3 defparagraf">
                {{ session('success') }}
            </div>
        @endif

        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-alt-48 text-gray-900 mb-2">Manajemen Galeri</h1>
                    <p class="text-gray-600 defparagraf">Kelola foto galeri AC mobil.</p>
                </div>
                <button onclick="openCreateModal()" class="bg-[#141E61] hover:bg-[#0F044C] text-white px-6 py-3 defparagraf font-medium flex items-center space-x-2 transition-colors rounded-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah Galeri</span>
                </button>
            </div>
        </div>

        <!-- GALERI FOTO Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-alt-48 text-gray-900 font-semibold">GALERI FOTO</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($galeris as $galeri)
                    <div class="bg-white border-2 border-[#0F044C] shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="aspect-square overflow-hidden">
                            <img src="{{ $galeri->gambar ? asset('storage/' . $galeri->gambar) : 'https://via.placeholder.com/300x300?text=No+Image' }}" 
                                 alt="{{ $galeri->judul }}" 
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium defparagraf bg-[#141E61]/10 text-[#141E61]">
                                    {{ ucfirst($galeri->kategori) }}
                                </span>
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium defparagraf {{ $galeri->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $galeri->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                            <h3 class="text-sm font-semibold defparagraf text-[#0F044C] mb-2">{{ $galeri->judul }}</h3>
                            @if($galeri->deskripsi)
                                <p class="text-xs defparagraf text-[#787A91] mb-3">{{ Str::limit($galeri->deskripsi, 50) }}</p>
                            @endif
                            <div class="flex space-x-2">
                                <button onclick="editGaleri({{ $galeri->id }})" class="flex-1 text-center px-3 py-2 text-xs font-medium defparagraf text-[#141E61] bg-[#141E61]/10 hover:bg-[#141E61] hover:text-white transition-all duration-200">
                                    Edit
                                </button>
                                <button onclick="deleteGaleri({{ $galeri->id }})" class="flex-1 text-center px-3 py-2 text-xs font-medium defparagraf text-red-600 bg-red-50 hover:bg-red-600 hover:text-white transition-all duration-200">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-[#787A91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
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

    <!-- Create/Edit Modal -->
    <div id="galeriModal" class="fixed inset-0 bg-black bg-opacity-60 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4">
        <div class="relative w-full max-w-2xl bg-white shadow-2xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">Tambah Galeri Baru</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="galeriForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="galeriId">
                    <input type="hidden" id="formMethod" value="POST">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Galeri</label>
                            <input type="text" id="galeriJudul" name="judul" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-[#3B2A7A]" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea id="galeriDeskripsi" name="deskripsi" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-[#3B2A7A]"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                            <input type="file" id="galeriGambar" name="gambar" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select id="galeriKategori" name="kategori" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-[#3B2A7A]" required>
                                <option value="">Pilih Kategori</option>
                                <option value="umum">Umum</option>
                                <option value="before-after">Before After</option>
                                <option value="promo">Promo</option>
                            </select>
                        </div>
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" id="galeriIsActive" name="is_active" value="1" class="mr-2">
                                <span class="text-sm text-gray-700">Aktifkan galeri</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded hover:bg-gray-200">Batal</button>
                        <button type="submit" class="px-4 py-2 text-white bg-[#3B2A7A] rounded hover:bg-[#2D1B69]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg bg-white rounded">
            <div class="text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Hapus Galeri</h3>
                <p class="text-sm text-gray-500 mb-4">Yakin ingin menghapus galeri ini?</p>
                <div class="flex justify-center space-x-3">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded">Batal</button>
                    <button onclick="confirmDelete()" class="px-4 py-2 text-white bg-red-600 rounded">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteId = null;

        function openCreateModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Galeri Baru';
            document.getElementById('galeriForm').reset();
            document.getElementById('galeriId').value = '';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('galeriModal').classList.remove('hidden');
        }

        function editGaleri(id) {
            // Fetch galeri data and populate form
            document.getElementById('modalTitle').textContent = 'Edit Galeri';
            document.getElementById('galeriId').value = id;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('galeriModal').classList.remove('hidden');
        }

        function deleteGaleri(id) {
            currentDeleteId = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('galeriModal').classList.add('hidden');
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

        document.getElementById('galeriForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData();
            const method = document.getElementById('formMethod').value;
            const galeriId = document.getElementById('galeriId').value;
            
            formData.append('judul', document.getElementById('galeriJudul').value);
            formData.append('deskripsi', document.getElementById('galeriDeskripsi').value);
            formData.append('kategori', document.getElementById('galeriKategori').value);
            formData.append('_token', '{{ csrf_token() }}');
            
            if (document.getElementById('galeriIsActive').checked) {
                formData.append('is_active', '1');
            }
            
            const imageFile = document.getElementById('galeriGambar').files[0];
            if (imageFile) {
                formData.append('gambar', imageFile);
            }
            
            if (method === 'PUT') {
                formData.append('_method', 'PUT');
            }
            
            const url = method === 'PUT' ? `/admin/galeri/${galeriId}` : '/admin/galeri';
            
            fetch(url, {
                method: 'POST',
                body: formData
            }).then(response => {
                if (response.ok) {
                    location.reload();
                }
            });
        });
    </script>
</x-admin.dashboard-layout>
