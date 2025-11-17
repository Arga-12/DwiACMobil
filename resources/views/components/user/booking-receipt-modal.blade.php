@php
    $booking = $selectedBooking ?? null;
    $shouldShowModal = !is_null($booking);
@endphp

<!-- Booking Receipt Modal -->
<div id="bookingReceiptModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 {{ $shouldShowModal ? '' : 'hidden' }}">
    <div class="bg-white max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto relative">
        <!-- Modal Header -->
        <div class="bg-[#0F044C] text-white p-4 text-center">
            <h2 class="text-lg font-montserrat-48 uppercase">DETAIL STRUK</h2>
            <p class="text-sm defparagraf opacity-90">Detail Booking Antrian</p>
        </div>

        <!-- Modal Content -->
        <div class="p-6">
            @if($shouldShowModal)
                <!-- Booking Information -->
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="defparagraf text-[#787A91]">ID Booking:</span>
                        <span class="defparagraf text-[#0F044C] font-medium">{{ $booking->nomor_booking ?? $booking->id_antri_struk }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="defparagraf text-[#787A91]">Tanggal:</span>
                        <span class="defparagraf text-[#0F044C]">{{ optional($booking->tanggal_pesan)->setTimezone('Asia/Jakarta')->format('d/m/Y') ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="defparagraf text-[#787A91]">Jam:</span>
                        <span class="defparagraf text-[#0F044C]">
                            {{ optional($booking->tanggal_pesan)->setTimezone('Asia/Jakarta')->format('H.i') ?? '-' }} - 
                            {{ $booking->tanggal_selesai ? optional($booking->tanggal_selesai)->setTimezone('Asia/Jakarta')->format('H.i') : '...' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="defparagraf text-[#787A91]">Status Antrian:</span>
                        <span class="defparagraf text-[#0F044C] font-medium">
                            @switch(strtolower($booking->status ?? ''))
                                @case('pending') Menunggu Konfirmasi Harga @break
                                @case('harga_dari_admin') Harga dari Admin @break
                                @case('dalam_antrian') Dalam Antrian @break
                                @case('dalam_servisan') Dalam Servisan @break
                                @case('selesai') Selesai @break
                                @case('cancelled') Dibatalkan @break
                                @default {{ ucfirst($booking->status ?? '-') }}
                            @endswitch
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="defparagraf text-[#787A91]">Menginap:</span>
                        <span class="defparagraf text-[#0F044C]">{{ $booking->menginap ? 'Ya' : 'Tidak' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="defparagraf text-[#787A91]">Mobil:</span>
                        <span class="defparagraf text-[#0F044C]">
                            {{ optional($booking->mobil)->nama_mobil ?? '-' }}
                            @if(optional($booking->mobil)->plat_nomor)
                                ({{ optional($booking->mobil)->plat_nomor }})
                            @endif
                        </span>
                    </div>
                    
                    @if($booking->montir)
                        <div class="flex justify-between">
                            <span class="defparagraf text-[#787A91]">Montir:</span>
                            <span class="defparagraf text-[#0F044C]">{{ $booking->montir->nama }}</span>
                        </div>
                    @endif
                </div>

                <!-- Services -->
                <div class="mt-6">
                    <h4 class="defparagraf text-[#0F044C] font-medium mb-2">Layanan Dipilih:</h4>
                    <ul class="space-y-1">
                        @if($booking->details && $booking->details->count() > 0)
                            @foreach($booking->details as $detail)
                                <li class="defparagraf text-[#0F044C] text-sm">• {{ $detail->deskripsi }}</li>
                            @endforeach
                        @else
                            <li class="defparagraf text-[#787A91] text-sm">Tidak ada layanan dipilih</li>
                        @endif
                    </ul>
                </div>

                <!-- Address -->
                @php
                    $address = '';
                    if ($booking->pengambilan && $booking->alamat_pengambilan) {
                        $address .= 'Jemput: ' . $booking->alamat_pengambilan;
                    }
                    if ($booking->pengiriman && $booking->alamat_pengiriman) {
                        if ($address) $address .= ' | ';
                        $address .= 'Antar: ' . $booking->alamat_pengiriman;
                    }
                    if (!$address) $address = 'Datang langsung ke bengkel';
                @endphp
                <div class="mt-6">
                    <h4 class="defparagraf text-[#0F044C] font-medium mb-2">Alamat pickup/Delivery:</h4>
                    <p class="defparagraf text-[#0F044C] text-sm">{{ $address }}</p>
                </div>

                <!-- Notes -->
                @if($booking->catatan)
                    <div class="mt-6">
                        <h4 class="defparagraf text-[#0F044C] font-medium mb-2">Catatan:</h4>
                        <p class="defparagraf text-[#0F044C] text-sm">{{ $booking->catatan }}</p>
                    </div>
                @endif

                <!-- Price Section -->
                @php
                    $showPrice = $booking->harga_keseluruhan && 
                                 in_array(strtolower($booking->status ?? ''), ['harga_dari_admin', 'dalam_antrian', 'dalam_servisan', 'confirmed', 'selesai', 'completed']);
                @endphp
                @if($showPrice)
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <h4 class="defparagraf text-[#0F044C] font-medium mb-3">Detail Harga:</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="defparagraf text-[#787A91]">Biaya Layanan:</span>
                                <span class="defparagraf text-[#0F044C]">Rp {{ number_format($booking->harga_keseluruhan, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t border-gray-200 pt-2 flex justify-between font-medium">
                                <span class="defparagraf text-[#0F044C]">Total:</span>
                                <span class="defparagraf text-[#0F044C]">Rp {{ number_format($booking->harga_keseluruhan, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Status Section with Action Buttons -->
                @php $status = strtolower($booking->status ?? ''); @endphp
                
                @if($status === 'harga_dari_admin')
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <div class="bg-yellow-50 border-2 border-yellow-500 p-4">
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-yellow-800 mr-2">
                                    <defs><path id="SVGgvnbobcx" d="M21.5 11v10h-19V11z"/></defs>
                                    <g fill="none">
                                        <use href="#SVGgvnbobcx"/>
                                        <path d="M12 13.5a2.5 2.5 0 1 1 0 5a2.5 2.5 0 0 1 0-5m5.136-7.209L19 5.67l1.824 5.333H3.002L3 11.004L14.146 2.1z"/>
                                        <path stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M21 11.003h-.176L19.001 5.67L3.354 11.003L3 11m-.5.004H3L14.146 2.1l2.817 3.95"/>
                                        <g stroke="currentColor" stroke-linecap="square" stroke-width="2">
                                            <path d="M14.5 16a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0Z"/>
                                            <use href="#SVGgvnbobcx"/>
                                            <path d="M2.5 11h2a2 2 0 0 1-2 2zm19 0h-2a2 2 0 0 0 2 2zm-19 10h2.002A2 2 0 0 0 2.5 18.998zm19 0h-2a2 2 0 0 1 2-2z"/>
                                        </g>
                                    </g>
                                </svg>
                                <h4 class="text-sm font-medium defparagraf text-yellow-800">Harga dari Admin</h4>
                            </div>
                            <p class="text-xs defparagraf text-yellow-700 leading-relaxed mb-3">
                                Admin telah menetapkan harga. Silakan konfirmasi untuk melanjutkan booking ini.
                            </p>
                            <div class="flex gap-2 justify-center">
                                <form method="POST" action="{{ route('user.antrian.confirm_price', $booking->nomor_booking ?? $booking->id_antri_struk) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-[#141E61] text-white text-xs defparagraf hover:bg-[#0F044C] transition-colors border-2 border-[#141E61] hover:border-[#0F044C]">
                                        Konfirmasi Harga
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('user.antrian.cancel', $booking->nomor_booking ?? $booking->id_antri_struk) }}" class="inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Yakin ingin membatalkan booking ini?')" class="px-4 py-2 bg-white text-[#0F044C] text-xs defparagraf hover:bg-[#0F044C] hover:text-white transition-colors border-2 border-[#0F044C]">
                                        Batalkan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @elseif($status === 'pending')
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <div class="bg-blue-50 border-2 border-blue-500 p-4">
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-blue-800 mr-2">
                                    <g fill="none">
                                        <path d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12"/>
                                        <path stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12Z"/>
                                        <path stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M12 6.5V12l3 3"/>
                                    </g>
                                </svg>
                                <h4 class="text-sm font-medium defparagraf text-blue-800">Menunggu Konfirmasi Harga</h4>
                            </div>
                            <p class="text-xs defparagraf text-blue-700 leading-relaxed">
                                Booking Anda telah diterima. Admin sedang menyiapkan estimasi harga berdasarkan layanan yang dipilih.
                            </p>
                        </div>
                    </div>
                @elseif($status === 'dalam_antrian')
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <div class="bg-green-50 border-2 border-green-500 p-4">
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-green-800 mr-2">
                                    <path fill="currentColor" d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/>
                                </svg>
                                <h4 class="text-sm font-medium defparagraf text-green-800">Dalam Antrian</h4>
                            </div>
                            <p class="text-xs defparagraf text-green-700 leading-relaxed">
                                Booking Anda sudah masuk antrian. Mohon menunggu giliran untuk diproses oleh teknisi kami.
                            </p>
                        </div>
                    </div>
                @elseif($status === 'dalam_servisan')
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <div class="bg-purple-50 border-2 border-purple-500 p-4">
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-purple-800 mr-2">
                                    <path fill="currentColor" d="M6.12 20.75c-.76 0-1.48-.3-2.03-.84a2.86 2.86 0 0 1 0-4.05l5.51-5.51c-.5-1.94.04-4.03 1.46-5.45a5.67 5.67 0 0 1 5.48-1.46c.26.07.46.27.53.53s0 .53-.19.72l-2.45 2.45l.52 1.91l1.91.52l2.45-2.45c.19-.19.47-.26.72-.19c.26.07.46.27.53.53c.53 1.95-.02 4.05-1.46 5.48c-1.42 1.42-3.51 1.96-5.45 1.46l-5.51 5.51c-.54.54-1.26.84-2.02.84m8.56-15.98c-.96.08-1.87.5-2.57 1.2c-1.14 1.14-1.51 2.81-.96 4.35c.1.27.03.58-.18.78l-5.83 5.83c-.53.53-.53 1.4 0 1.93c.26.26.6.4.97.4c.36 0 .71-.14.96-.4l5.83-5.83c.21-.21.51-.27.78-.18c1.54.54 3.21.18 4.35-.96c.7-.7 1.11-1.61 1.2-2.57l-1.63 1.63c-.19.19-.47.26-.73.19l-2.74-.75a.75.75 0 0 1-.53-.53l-.75-2.74c-.07-.26 0-.54.19-.73l1.63-1.63Z"/>
                                </svg>
                                <h4 class="text-sm font-medium defparagraf text-purple-800">Sedang Dikerjakan</h4>
                            </div>
                            <p class="text-xs defparagraf text-purple-700 leading-relaxed">
                                Mobil Anda sedang dalam proses pengerjaan oleh teknisi kami. Kami akan memberitahu jika sudah selesai.
                            </p>
                        </div>
                    </div>
                @elseif($status === 'confirmed')
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <div class="bg-cyan-50 border-2 border-cyan-500 p-4">
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-cyan-800 mr-2">
                                    <path fill="currentColor" d="m10.6 16.6l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22"/>
                                </svg>
                                <h4 class="text-sm font-medium defparagraf text-cyan-800">Booking Dikonfirmasi</h4>
                            </div>
                            <p class="text-xs defparagraf text-cyan-700 leading-relaxed">
                                Booking telah dikonfirmasi. Admin akan memproses pesanan sesuai jadwal yang ditentukan.
                            </p>
                        </div>
                    </div>
                @elseif(in_array($status, ['selesai', 'completed']))
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <div class="bg-emerald-50 border-2 border-emerald-600 p-4">
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-emerald-800 mr-2">
                                    <g fill="currentColor">
                                        <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                                        <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" clip-rule="evenodd"/>
                                    </g>
                                </svg>
                                <h4 class="text-sm font-medium defparagraf text-emerald-800">Layanan Selesai</h4>
                            </div>
                            <p class="text-xs defparagraf text-emerald-700 leading-relaxed">
                                Layanan telah selesai dikerjakan. Terima kasih telah menggunakan layanan DwiACMobil.
                            </p>
                        </div>
                    </div>
                @elseif($status === 'cancelled')
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <div class="bg-red-50 border-2 border-red-500 p-4">
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-red-800 mr-2">
                                    <path fill="currentColor" d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8"/>
                                </svg>
                                <h4 class="text-sm font-medium defparagraf text-red-800">Booking Dibatalkan</h4>
                            </div>
                            <p class="text-xs defparagraf text-red-700 leading-relaxed">
                                Booking telah dibatalkan. Anda dapat membuat booking baru jika diperlukan.
                            </p>
                        </div>
                    </div>
                @endif

            @else
                <div class="text-center">
                    <h4 class="defparagraf text-[#0F044C] font-medium mb-2">Data booking tidak tersedia</h4>
                    <p class="defparagraf text-[#787A91] text-sm">Silahkan coba lagi atau hubungi admin</p>
                </div>
            @endif

            <!-- Close Button -->
            <div class="flex justify-center mt-6">
                <button onclick="closeModal()" class="px-6 py-2 bg-[#0F044C] text-white hover:bg-[#141E61] transition-colors defparagraf">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function closeModal() {
    document.getElementById('bookingReceiptModal').classList.add('hidden');
    // Update URL to remove show_receipt parameter
    const url = new URL(window.location);
    url.searchParams.delete('show_receipt');
    window.history.replaceState({}, '', url);
}

// Close modal interactions
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('bookingReceiptModal');
    const modalContent = modal?.querySelector('.bg-white');
    
    // Close when clicking outside modal
    modal?.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    // Prevent modal from closing when clicking inside modal content
    modalContent?.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
    // Close with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal?.classList.contains('hidden')) {
            closeModal();
        }
    });
});
</script>
