<x-layout :showHeader="true" :showHero="true" title="Beranda - Dwi AC Mobil">
    <!-- Content Section -->
    <section class="py-16 bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Layanan Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold mb-4">Service AC Mobil</h3>
                        <p class="text-gray-600">Layanan perbaikan dan maintenance AC mobil profesional</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold mb-4">Pemasangan AC</h3>
                        <p class="text-gray-600">Pemasangan AC mobil baru dengan garansi</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold mb-4">Konsultasi</h3>
                        <p class="text-gray-600">Konsultasi gratis untuk masalah AC mobil Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Dummy anchor sections for header links --}}
    <section id="galeri" class="py-16 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="text-2xl font-bold">Galeri</h2>
            <p class="text-gray-600">Konten galeri dummy.</p>
        </div>
    </section>

    <section id="kontak" class="py-16 bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="text-2xl font-bold">Kontak</h2>
            <p class="text-gray-600">Konten kontak dummy.</p>
        </div>
    </section>

    <section id="review" class="py-16 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="text-2xl font-bold">Review</h2>
            <p class="text-gray-600">Konten review dummy.</p>
        </div>
    </section>
</x-layout>