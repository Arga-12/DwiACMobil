<x-admin.dashboard-layout title="Manajemen Montir - Dwi AC Mobil">
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
                        <h1 class="text-2xl sm:text-3xl font-montserrat-48 font-bold leading-tight uppercase">Manajemen Montir</h1>
                        <p class="mt-1 text-sm sm:text-base text-white/85 defparagraf">Kelola data profil montir bengkel.</p>
                    </div>
                    <a href="{{ route('admin.montir.create') }}" class="px-5 py-3 bg-white text-[#0F044C] rounded-xl font-semibold defparagraf inline-flex items-center gap-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Tambah Montir</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- DAFTAR MONTIR Section -->
        <div class="space-y-4">
            <h2 class="text-lg sm:text-xl md:text-xl lg:text-2xl font-montserrat-48 text-gray-900 font-bold uppercase">Daftar Montir</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($bioMontir as $montir)
                    <div class="bg-white border-2 border-[#0F044C]/20 rounded-2xl shadow-md overflow-hidden hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        <div class="aspect-square overflow-hidden">
                            @if($montir->foto)
                                <img src="{{ asset('storage/montir/' . $montir->foto) }}"
                                     alt="{{ $montir->nama }}"
                                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-bold defparagraf text-[#0F044C] mb-1">{{ $montir->nama }}</h3>
                            <p class="text-sm defparagraf text-blue-600 font-semibold mb-2">{{ $montir->peringkat }}</p>
                            <div class="space-y-1 mb-3">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-xs defparagraf text-gray-600">{{ $montir->email }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span class="text-xs defparagraf text-gray-600">{{ $montir->nomor_telepon }}</span>
                                </div>
                            </div>
                            <p class="text-xs defparagraf text-gray-600 italic mb-3 line-clamp-3">"{{ $montir->quotes }}"</p>
                            <p class="text-xs defparagraf text-[#787A91] mb-3">{{ $montir->created_at->format('d M Y, H:i') }}</p>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.montir.edit', $montir->id) }}" class="flex-1 text-center px-3 py-2 text-xs font-medium defparagraf text-[#141E61] bg-[#141E61]/10 hover:bg-[#141E61] hover:text-white transition-all duration-200 rounded">
                                    Edit
                                </a>
                                <form action="{{ route('admin.montir.destroy', $montir->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data montir ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-3 py-2 text-xs font-medium defparagraf text-red-600 bg-red-50 hover:bg-red-100 transition-all duration-200 rounded">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-12">
                            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium defparagraf text-gray-900">Belum ada data montir</h3>
                            <p class="mt-1 text-sm defparagraf text-gray-500">Mulai dengan menambahkan data montir pertama Anda.</p>
                            <div class="mt-6">
                                <a href="{{ route('admin.montir.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium defparagraf rounded-md text-white bg-[#0F044C] hover:bg-[#0F044C]/90">
                                    <svg class="mr-2 -ml-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Tambah Montir
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin.dashboard-layout>
