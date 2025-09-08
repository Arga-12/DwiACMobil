<x-admin.dashboard-layout title="Manajemen Montir - Dwi AC Mobil">
    <!-- Dashboard Content -->
    <div class="space-y-6 sm:space-y-8 md:space-y-10 lg:space-y-12">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border-2 border-green-400 text-green-700 px-4 py-3 defparagraf">
                {{ session('success') }}
            </div>
        @endif

        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-xl sm:text-2xl md:text-2xl lg:text-3xl font-montserrat-alt-48 text-gray-900 mb-2">Manajemen Montir</h1>
                    <p class="text-gray-600 defparagraf">Kelola data montir dan informasi mereka.</p>
                </div>
                <a href="{{ route('admin.montir.create') }}" class="bg-[#141E61] hover:bg-[#0F044C] text-white px-6 py-3 defparagraf font-medium flex items-center space-x-2 transition-colors rounded-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah Montir</span>
                </a>
            </div>
        </div>

        <!-- DAFTAR MONTIR Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-alt-48 text-gray-900 font-semibold">DAFTAR MONTIR</h2>
            
            <!-- Montir Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($montirs as $montir)
                <div class="bg-white border-2 border-[#0F044C] shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <!-- Photo -->
                        <div class="flex justify-center mb-4">
                            <div class="w-20 h-20 rounded-full overflow-hidden bg-[#141E61]/10 border-2 border-[#141E61]">
                                @if($montir->foto)
                                    <img src="{{ asset('storage/' . $montir->foto) }}" alt="{{ $montir->nama }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[#141E61] text-2xl font-bold defparagraf">
                                        {{ substr($montir->nama, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="text-center mb-4">
                            <h3 class="text-lg font-semibold defparagraf text-[#0F044C]">{{ $montir->nama }}</h3>
                        </div>

                        <!-- Status -->
                        <div class="flex justify-center mb-4">
                            <span class="px-2 py-1 text-xs defparagraf rounded-full {{ $montir->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $montir->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>

                        <!-- Contact Info -->
                        <div class="text-sm defparagraf text-[#787A91] mb-4">
                            <p class="flex items-center justify-center mb-1">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ $montir->email }}
                            </p>
                            <p class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ $montir->telepon }}
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.montir.edit', $montir) }}" class="flex-1 bg-[#141E61] hover:bg-[#0F044C] text-white px-3 py-2 text-sm text-center defparagraf transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('admin.montir.destroy', $montir) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus montir ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 text-sm defparagraf transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-[#787A91]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium defparagraf text-[#0F044C]">Belum ada montir</h3>
                    <p class="mt-1 text-sm defparagraf text-[#787A91]">Mulai dengan menambahkan montir pertama.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.montir.create') }}" class="inline-flex items-center px-4 py-2 border-2 border-transparent shadow-sm text-sm font-medium defparagraf text-white bg-[#141E61] hover:bg-[#0F044C] transition-colors">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Montir
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($montirs->hasPages())
            <div class="flex justify-center">
                <div class="defparagraf text-[#787A91]">{{ $montirs->links() }}</div>
            </div>
        @endif
    </div>
</x-admin.dashboard-layout>
