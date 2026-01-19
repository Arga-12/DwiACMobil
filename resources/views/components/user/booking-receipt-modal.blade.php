@php
    $booking = $selectedBooking ?? null;
    $shouldShowModal = !is_null($booking);
@endphp

<!-- Booking Receipt Modal -->
<div id="bookingReceiptModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 {{ $shouldShowModal ? '' : 'hidden' }}" role="dialog" aria-modal="true" aria-labelledby="bookingReceiptTitle">
    <div class="bg-white border border-[#0F044C]/20 rounded-2xl shadow-2xl w-full max-w-lg mx-4 max-h-[90vh] overflow-y-auto relative">
        <!-- Modal Header -->
        <div class="bg-[#0F044C] text-white p-4 text-center relative rounded-t-2xl border-b border-[#0F044C]/30">
            <button type="button" onclick="closeModal()" class="absolute right-3 top-3 text-white/80 hover:text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <h2 id="bookingReceiptTitle" class="text-lg font-montserrat-48 uppercase">DETAIL STRUK</h2>
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

                    @if($booking->estimasi_selesai)
                        <div class="flex justify-between">
                            <span class="defparagraf text-[#787A91]">Estimasi Selesai:</span>
                            <span class="defparagraf text-[#0F044C] font-medium">
                                {{ $booking->estimasi_selesai->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Services with inline pricing breakdown -->
                @php
                    $hasDetails = $booking->details && $booking->details->count() > 0;
                    $detailTotalInline = $hasDetails ? (int) $booking->details->sum('subtotal') : 0;
                    $status = strtolower($booking->status ?? '');

                    // Only show services table if admin has set actual pricing (not placeholder)
                    // Don't show for 'pending' status where it's just placeholder data
                    $showServices = $hasDetails && !in_array($status, ['pending']);
                @endphp
                <div class="mt-6">
                    @if($showServices)
                        <div class="text-sm defparagraf">
                            <div class="grid grid-cols-12 text-xs font-semibold text-gray-700">
                                <div class="col-span-6 py-2 border-b border-gray-200">Layanan</div>
                                <div class="col-span-2 py-2 text-center border-b border-gray-200">Qty</div>
                                <div class="col-span-2 py-2 text-right border-b border-gray-200">Harga Satuan</div>
                                <div class="col-span-2 py-2 text-right border-b border-gray-200">Subtotal</div>
                            </div>
                            @foreach($booking->details->sortByDesc(function($d) { return $d->layanan ? $d->layanan->permanen : false; }) as $d)
                                <div class="grid grid-cols-12 items-center border-b border-gray-100">
                                    <div class="col-span-6 py-2 text-[#0F044C]">{{ $d->deskripsi }}</div>
                                    <div class="col-span-2 py-2 text-center">{{ (int)($d->jumlah ?? 0) }}</div>
                                    <div class="col-span-2 py-2 text-right">Rp {{ number_format((int)($d->harga_satuan ?? 0), 0, ',', '.') }}</div>
                                    <div class="col-span-2 py-2 text-right font-medium text-[#0F044C]">Rp {{ number_format((int)($d->subtotal ?? 0), 0, ',', '.') }}</div>
                                </div>
                            @endforeach
                            <div class="flex justify-between pt-3 font-medium">
                                <span class="bigparagraf font-semibold text-[#0F044C]">Total</span>
                                <span class="bigparagraf font-semibold text-[#0F044C]">Rp {{ number_format($detailTotalInline, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @elseif($status === 'pending')
                        @if($hasDetails)
                            <div class="text-sm defparagraf">
                                <div class="grid grid-cols-12 text-xs font-semibold text-gray-700">
                                    <div class="col-span-6 py-2 border-b border-gray-200">Layanan</div>
                                    <div class="col-span-2 py-2 text-center border-b border-gray-200">Qty</div>
                                    <div class="col-span-2 py-2 text-right border-b border-gray-200">Harga Satuan</div>
                                    <div class="col-span-2 py-2 text-right border-b border-gray-200">Subtotal</div>
                                </div>
                                @foreach($booking->details->sortByDesc(function($d) { return $d->layanan ? $d->layanan->permanen : false; }) as $d)
                                    <div class="grid grid-cols-12 items-center border-b border-gray-100">
                                        <div class="col-span-6 py-2 text-[#0F044C]">{{ $d->deskripsi }}</div>
                                        <div class="col-span-2 py-2 text-center">{{ (int)($d->qty ?? 0) }}</div>
                                        <div class="col-span-2 py-2 text-right">-</div>
                                        <div class="col-span-2 py-2 text-right font-medium text-[#0F044C]">-</div>
                                    </div>
                                @endforeach
                                <div class="flex justify-between pt-3 font-medium">
                                    <span class="bigparagraf font-semibold text-[#0F044C]">Total</span>
                                    <span class="bigparagraf font-semibold text-[#0F044C]">-</span>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <p class="defparagraf text-[#787A91] text-sm">Informasi layanan belum tersedia</p>
                        </div>
                    @endif
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

                @if(!in_array($status, ['pending']))
                    <!-- Detail Harga for non-pending status -->
                    @php
                        $finalTotal = (int) ($booking->harga_keseluruhan ?? 0);
                        $hasPriceFromAdmin = ($hasDetails && $showServices) || $finalTotal > 0;
                    @endphp
                @endif

                <!-- Status Section with Action Buttons -->
                @php $status = strtolower($booking->status ?? ''); @endphp

                @if($status === 'harga_dari_admin')
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <div class="bg-gradient-to-br from-[#FFDC7F]/20 to-[#FFDC7F]/5 border-2 border-[#FFDC7F]/40 rounded-xl shadow-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-[#B8941F] mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <defs><path id="admBadgeIconSum" d="M21.5 11v10h-19V11z"/></defs>
                                    <g fill="none">
                                        <use href="#admBadgeIconSum"/>
                                        <path d="M12 13.5a2.5 2.5 0 1 1 0 5a2.5 2.5 0 0 1 0-5m5.136-7.209L19 5.67l1.824 5.333H3.002L3 11.004L14.146 2.1z"/>
                                        <path stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M21 11.003h-.176L19.001 5.67L3.354 11.003L3 11m-.5.004H3L14.146 2.1l2.817 3.95"/>
                                        <g stroke="currentColor" stroke-linecap="square" stroke-width="2">
                                            <path d="M14.5 16a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0Z"/>
                                            <use href="#admBadgeIconSum"/>
                                            <path d="M2.5 11h2a2 2 0 0 1-2 2zm19 0h-2a2 2 0 0 0 2 2zm-19 10h2.002A2 2 0 0 0 2.5 18.998zm19 0h-2a2 2 0 0 1 2-2z"/>
                                        </g>
                                    </g>
                                </svg>
                                <h4 class="text-sm font-medium defparagraf text-[#B8941F]">Harga dari Admin</h4>
                            </div>
                            <p class="text-xs defparagraf text-yellow-700 leading-relaxed mb-3">
                                Admin telah menetapkan harga. Silakan konfirmasi untuk melanjutkan booking ini.
                                @if($booking->estimasi_selesai)
                                    <br><strong>Estimasi selesai:</strong> {{ $booking->estimasi_selesai->setTimezone('Asia/Jakarta')->format('d/m/Y \p\u\k\u\l H:i') }}
                                @endif
                            </p>
                            <div class="flex gap-2 justify-center">
                                <form method="POST" action="{{ route('user.antrian.confirm_price', $booking->nomor_booking ?? $booking->id_antri_struk) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-[#141E61] text-white text-xs defparagraf hover:bg-[#0F044C] transition-colors border-2 border-[#141E61] hover:border-[#0F044C] rounded-lg">
                                        Konfirmasi Harga
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('user.antrian.cancel', $booking->nomor_booking ?? $booking->id_antri_struk) }}" class="inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Yakin ingin membatalkan booking ini?')" class="px-4 py-2 bg-white text-[#0F044C] text-xs defparagraf hover:bg-[#0F044C] hover:text-white transition-colors border-2 border-[#0F044C] rounded-lg">
                                        Batalkan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @elseif($status === 'pending')
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <div class="bg-gradient-to-br from-[#FFDC7F]/20 to-[#FFDC7F]/5 border-2 border-[#FFDC7F]/40 rounded-xl shadow-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-[#B8941F] mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <defs><path id="admBadgeIconSum2" d="M21.5 11v10h-19V11z"/></defs>
                                    <g fill="none">
                                        <use href="#admBadgeIconSum2"/>
                                        <path d="M12 13.5a2.5 2.5 0 1 1 0 5a2.5 2.5 0 0 1 0-5m5.136-7.209L19 5.67l1.824 5.333H3.002L3 11.004L14.146 2.1z"/>
                                        <path stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M21 11.003h-.176L19.001 5.67L3.354 11.003L3 11m-.5.004H3L14.146 2.1l2.817 3.95"/>
                                        <g stroke="currentColor" stroke-linecap="square" stroke-width="2">
                                            <path d="M14.5 16a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0Z"/>
                                            <use href="#admBadgeIconSum2"/>
                                            <path d="M2.5 11h2a2 2 0 0 1-2 2zm19 0h-2a2 2 0 0 0 2 2zm-19 10h2.002A2 2 0 0 0 2.5 18.998zm19 0h-2a2 2 0 0 1 2-2z"/>
                                        </g>
                                    </g>
                                </svg>
                                <h4 class="text-sm font-medium defparagraf text-[#B8941F]">Menunggu Konfirmasi Harga</h4>
                            </div>
                            <p class="text-xs defparagraf text-yellow-700 leading-relaxed">
                                Booking Anda telah diterima. Admin sedang menyiapkan estimasi harga berdasarkan layanan yang dipilih.
                            </p>
                        </div>
                    </div>
                @elseif($status === 'dalam_antrian')
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <div class="bg-gradient-to-br from-[#141E61]/10 to-[#141E61]/5 border-2 border-[#141E61]/30 rounded-xl shadow-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-[#141E61] mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <g fill="none">
                                        <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                                        <path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 2a8 8 0 1 0 0 16a8 8 0 0 0 0-16m0 2a1 1 0 0 1 .993.883L13 7v4.586l2.707 2.707a1 1 0 0 1-1.32 1.497l-.094-.083l-3-3a1 1 0 0 1-.284-.576L11 12V7a1 1 0 0 1 1-1"/>
                                    </g>
                                </svg>
                                <h4 class="text-sm font-medium defparagraf text-[#141E61]">Dalam Antrian</h4>
                            </div>
                            <p class="text-xs defparagraf text-[#0F044C] leading-relaxed">
                                Booking Anda sudah masuk antrian. Mohon menunggu giliran untuk diproses oleh teknisi kami.
                                @if($booking->estimasi_selesai)
                                    <br><strong>Estimasi selesai:</strong> {{ $booking->estimasi_selesai->setTimezone('Asia/Jakarta')->format('d/m/Y \p\u\k\u\l H:i') }}
                                @endif
                            </p>
                        </div>
                    </div>
                @elseif($status === 'dalam_servisan')
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <div class="bg-gradient-to-br from-[#C66E52]/15 to-[#C66E52]/5 border-2 border-[#C66E52]/35 rounded-xl shadow-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-[#A0523C] mr-2" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M13.41 3.596a.76.76 0 0 0-.35-.51l-2 2a1 1 0 0 1-1.44 0l-.76-.68a1 1 0 0 1 0-1.4l2-2a.76.76 0 0 0-.48-.43a3.8 3.8 0 0 0-4.2 5.309L.815 11.252a1 1 0 0 0 .014 1.428l.561.538a1 1 0 0 0 1.396-.01l5.428-5.37a3.81 3.81 0 0 0 5.196-4.242" stroke-width="1"/>
                                </svg>
                                <h4 class="text-sm font-medium defparagraf text-[#A0523C]">Sedang Dikerjakan</h4>
                            </div>
                            <p class="text-xs defparagraf text-[#A0523C] leading-relaxed">
                                Mobil Anda sedang dalam proses pengerjaan oleh teknisi kami. Kami akan memberitahu jika sudah selesai.
                                @if($booking->estimasi_selesai)
                                    <br><strong>Estimasi selesai:</strong> {{ $booking->estimasi_selesai->setTimezone('Asia/Jakarta')->format('d/m/Y \p\u\k\u\l H:i') }}
                                @endif
                            </p>
                        </div>
                    </div>
                @elseif($status === 'confirmed')
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <div class="bg-gradient-to-br from-[#141E61]/10 to-[#141E61]/5 border-2 border-[#141E61]/30 rounded-xl shadow-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-[#141E61] mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <g fill="currentColor">
                                        <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                                        <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" clip-rule="evenodd"/>
                                    </g>
                                </svg>
                                <h4 class="text-sm font-medium defparagraf text-[#141E61]">Booking Dikonfirmasi</h4>
                            </div>
                            <p class="text-xs defparagraf text-[#0F044C] leading-relaxed">
                                Booking telah dikonfirmasi. Admin akan memproses pesanan sesuai jadwal yang ditentukan.
                                @if($booking->estimasi_selesai)
                                    <br><strong>Estimasi selesai:</strong> {{ $booking->estimasi_selesai->setTimezone('Asia/Jakarta')->format('d/m/Y \p\u\k\u\l H:i') }}
                                @endif
                            </p>
                        </div>
                    </div>
                @elseif(in_array($status, ['selesai', 'completed']))
                    <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4">
                        <div class="bg-gradient-to-br from-[#E7DEAF]/30 to-[#E7DEAF]/10 border-2 border-[#E7DEAF]/50 rounded-xl shadow-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-[#7A8F5C] mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <g fill="currentColor">
                                        <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                                        <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" clip-rule="evenodd"/>
                                    </g>
                                </svg>
                                <h4 class="text-sm font-medium defparagraf text-[#7A8F5C]">Layanan Selesai</h4>
                            </div>
                            <p class="text-xs defparagraf text-[#7A8F5C] leading-relaxed">
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
                <button onclick="closeModal()" class="px-6 py-2 bg-[#0F044C] text-white hover:bg-[#141E61] rounded-lg transition-colors defparagraf">
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
