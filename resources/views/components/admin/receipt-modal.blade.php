<!-- Admin Booking Receipt Modal Component -->
<div id="adminBookingReceiptModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white border border-[#0F044C]/20 rounded-2xl shadow-2xl w-full max-w-lg mx-4 max-h-[90vh] overflow-y-auto relative">
        <!-- Header -->
        <div class="bg-[#0F044C] text-white p-4 text-center relative rounded-t-2xl border-b border-[#0F044C]/30">
            <button type="button" onclick="closeAdminReceiptModal()" class="absolute right-3 top-3 text-white/80 hover:text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <h3 class="text-lg font-montserrat-48 uppercase">DETAIL STRUK (ADMIN)</h3>
            <p class="text-sm defparagraf opacity-90 mt-1" id="adminModalSubtitle">Detail Booking Antrian</p>
        </div>

        <div class="p-6">
            <!-- Booking ID -->
            <div class="text-center mb-6">
                <h4 class="text-sm defparagraf text-[#787A91] mb-1">ID BOOKING</h4>
                <p class="text-lg font-montserrat-48 text-[#0F044C]" id="adminReceiptBookingId">-</p>
            </div>

            <!-- Booking Information -->
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Tanggal:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptBookingDate">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Jam:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptBookingTime">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Status Antrian:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptBookingStatus">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Menginap:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptOvernight">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Durasi:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptDuration">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Mobil:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptBookingCar">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Estimasi Selesai:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptEstimatedCompletion">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Mulai Servis:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptStartService">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Selesai Servis:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptEndService">-</span>
                </div>
            </div>

            <!-- Services with Pricing -->
            <div class="mt-6" id="adminReceiptServicesSection">
                <div class="text-sm defparagraf">
                    <div class="grid grid-cols-12 text-xs font-semibold text-gray-700">
                        <div class="col-span-6 py-2 border-b border-gray-200">Layanan</div>
                        <div class="col-span-2 py-2 text-center border-b border-gray-200">jumlah</div>
                        <div class="col-span-2 py-2 text-right border-b border-gray-200">Harga Satuan</div>
                        <div class="col-span-2 py-2 text-right border-b border-gray-200">Subtotal</div>
                    </div>
                    <div id="adminReceiptServicesRows">
                        <!-- Services will be populated here -->
                    </div>
                    <div class="flex justify-between pt-3 font-medium border-t border-gray-200">
                        <span class="bigparagraf font-semibold text-[#0F044C]">Total</span>
                        <span class="bigparagraf font-semibold text-[#0F044C]" id="adminReceiptTotal">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- Address -->
            <div class="mt-6">
                <h4 class="defparagraf text-[#0F044C] font-medium mb-2">Alamat Pickup/Delivery:</h4>
                <p class="defparagraf text-[#0F044C] text-sm" id="adminReceiptAddress">-</p>
            </div>

            <!-- Notes -->
            <div class="mt-6" id="adminReceiptNotesSection">
                <h4 class="defparagraf text-[#0F044C] font-medium mb-2">Catatan:</h4>
                <p class="defparagraf text-[#0F044C] text-sm" id="adminReceiptNotes">-</p>
            </div>

            <!-- Status Section with Action - PENDING -->
            <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4 hidden" id="adminStatusPending">
                <div class="bg-gradient-to-br from-[#FFDC7F]/20 to-[#FFDC7F]/5 border-2 border-[#FFDC7F]/40 rounded-xl shadow-lg p-4">
                    <div class="flex items-center mb-3">
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
                        <h4 class="text-sm font-medium defparagraf text-[#B8941F]">Set Harga Layanan</h4>
                    </div>
                    <p class="text-xs defparagraf text-yellow-700 leading-relaxed mb-4">
                        Booking ini belum memiliki harga. Tentukan harga untuk setiap layanan yang dipilih.
                    </p>

                    <form id="adminSetPriceForm" method="POST" action="" data-action-template="{{ url('/admin/antrian') }}/:id/set-price">
                        @csrf
                        <input type="hidden" name="details" id="adminPriceDetailsJson" value="[]">

                        <div class="space-y-3 mb-4">
                            <h5 class="text-xs font-semibold text-[#0F044C] mb-2">Rincian Layanan:</h5>
                            <div id="adminPriceEditorRows" class="space-y-2">
                                <!-- Price editor rows will be populated here -->
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-3 border-t border-[#FFDC7F]/40 mb-4">
                            <span class="text-xs defparagraf text-[#787A91]">Total Keseluruhan:</span>
                            <div class="text-right">
                                <input type="number" name="harga_keseluruhan" id="adminModalHargaKeseluruhan" class="w-24 px-2 py-1 border-2 border-[#FFDC7F]/60 rounded text-xs text-right focus:ring-1 focus:ring-[#FFDC7F] focus:border-[#FFDC7F] defparagraf bg-white" min="0" step="1000" readonly required />
                            </div>
                        </div>

                        <div class="border-t border-[#FFDC7F]/40 pt-3 mb-4">
                            <h5 class="text-xs font-semibold text-[#0F044C] mb-2">Perkiraan Selesai Servis:</h5>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="text-xs defparagraf text-[#787A91] block mb-1">Tanggal Selesai:</label>
                                    <input type="date" name="estimasi_tanggal" id="adminEstimasiTanggal" class="w-full px-2 py-1 border-2 border-[#FFDC7F]/60 rounded text-xs focus:ring-1 focus:ring-[#FFDC7F] focus:border-[#FFDC7F] defparagraf bg-white" required />
                                </div>
                                <div>
                                    <label class="text-xs defparagraf text-[#787A91] block mb-1">Jam Selesai:</label>
                                    <input type="time" name="estimasi_jam" id="adminEstimasiJam" class="w-full px-2 py-1 border-2 border-[#FFDC7F]/60 rounded text-xs focus:ring-1 focus:ring-[#FFDC7F] focus:border-[#FFDC7F] defparagraf bg-white" required />
                                </div>
                            </div>
                            <p class="text-xs defparagraf text-[#7A5E00] mt-2">* Default berdasarkan tanggal booking. Estimasi ini akan dikirim ke pelanggan sebagai perkiraan waktu selesai servis</p>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 px-3 py-2 bg-[#B8941F] text-white text-xs defparagraf hover:bg-[#7A5E00] transition-colors border-2 border-[#B8941F] hover:border-[#7A5E00] rounded-lg">
                                Set Harga
                            </button>
                            <form method="POST" action="{{ route('admin.antrian.cancel', 'BOOKING_ID') }}" class="inline" id="adminCancelFormPending">
                                @csrf
                                <button type="submit" onclick="return confirm('Yakin ingin membatalkan booking ini?')" class="px-3 py-2 bg-white text-[#B8941F] text-xs defparagraf hover:bg-[#B8941F] hover:text-white transition-colors border-2 border-[#B8941F] rounded-lg">
                                    Batalkan
                                </button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Status Section - WAITING FOR CUSTOMER CONFIRMATION -->
            <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4 hidden" id="adminStatusWaitingConfirm">
                <div class="bg-gradient-to-br from-[#F59E0B]/20 to-[#F59E0B]/5 border-2 border-[#F59E0B]/40 rounded-xl shadow-lg p-4">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-[#B45309] mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="m16 11l2 2l4-4m-6 12v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                            </g>
                        </svg>
                        <h4 class="text-sm font-medium defparagraf text-[#B45309]">Menunggu Konfirmasi Pelanggan</h4>
                    </div>
                    <p class="text-xs defparagraf text-[#B45309] leading-relaxed mb-3">
                        Harga telah ditetapkan dan dikirim ke pelanggan. Menunggu konfirmasi dari pelanggan.
                    </p>
                    <div class="flex gap-2 justify-center">
                        <form method="POST" action="{{ route('admin.antrian.cancel', 'BOOKING_ID') }}" class="inline" id="adminCancelFormWaiting">
                            @csrf
                            <button type="submit" onclick="return confirm('Yakin ingin membatalkan booking ini?')" class="px-4 py-2 bg-white text-[#B45309] text-xs defparagraf hover:bg-[#B45309] hover:text-white transition-colors border-2 border-[#B45309] rounded-lg">
                                Batalkan Booking
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Status Section - IN QUEUE -->
            <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4 hidden" id="adminStatusInQueue">
                <div class="bg-gradient-to-br from-[#141E61]/10 to-[#141E61]/5 border-2 border-[#141E61]/30 rounded-xl shadow-lg p-4">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-[#141E61] mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="none">
                                <path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 2a8 8 0 1 0 0 16a8 8 0 0 0 0-16m0 2a1 1 0 0 1 .993.883L13 7v4.586l2.707 2.707a1 1 0 0 1-1.32 1.497l-.094-.083l-3-3a1 1 0 0 1-.284-.576L11 12V7a1 1 0 0 1 1-1"/>
                            </g>
                        </svg>
                        <h4 class="text-sm font-medium defparagraf text-[#141E61]">Sedang Antri</h4>
                    </div>
                    <p class="text-xs defparagraf text-[#141E61] leading-relaxed mb-3">
                        Pelanggan telah mengkonfirmasi harga. Siap untuk memulai servis kendaraan.
                    </p>
                    <div class="flex gap-2">
                        <form id="adminStartForm" method="POST" action="" data-action-template="{{ url('/admin/antrian') }}/:id/start" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 bg-[#141E61] text-white text-xs defparagraf hover:bg-[#0F044C] transition-colors border-2 border-[#141E61] hover:border-[#0F044C] rounded-lg">
                                Mulai Servis
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.antrian.cancel', 'BOOKING_ID') }}" class="inline" id="adminCancelFormQueue">
                            @csrf
                            <button type="submit" onclick="return confirm('Yakin ingin membatalkan booking ini?')" class="px-4 py-2 bg-white text-[#141E61] text-xs defparagraf hover:bg-[#141E61] hover:text-white transition-colors border-2 border-[#141E61] rounded-lg">
                                Batalkan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Status Section - IN PROGRESS -->
            <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4 hidden" id="adminStatusInProgress">
                <div class="bg-gradient-to-br from-[#C66E52]/15 to-[#C66E52]/5 border-2 border-[#C66E52]/35 rounded-xl shadow-lg p-4">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-[#A0523C] mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M13.41 3.596a.76.76 0 0 0-.35-.51l-2 2a1 1 0 0 1-1.44 0l-.76-.68a1 1 0 0 1 0-1.4l2-2a.76.76 0 0 0-.48-.43a3.8 3.8 0 0 0-4.2 5.309L.815 11.252a1 1 0 0 0 .014 1.428l.561.538a1 1 0 0 0 1.396-.01l5.428-5.37a3.81 3.81 0 0 0 5.196-4.242" stroke-width="1"/>
                        </svg>
                        <h4 class="text-sm font-medium defparagraf text-[#A0523C]">Sedang Dikerjakan</h4>
                    </div>
                    <p class="text-xs defparagraf text-[#A0523C] leading-relaxed mb-3">
                        Servis sedang berlangsung. Tandai selesai ketika pekerjaan sudah tuntas.
                    </p>
                    <div class="flex gap-2">
                        <form id="adminFinishForm" method="POST" action="" data-action-template="{{ url('/admin/antrian') }}/:id/finish" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 bg-[#C66E52] text-white text-xs defparagraf hover:bg-[#A0523C] transition-colors border-2 border-[#C66E52] hover:border-[#A0523C] rounded-lg">
                                Tandai Selesai
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.antrian.cancel', 'BOOKING_ID') }}" class="inline" id="adminCancelFormProgress">
                            @csrf
                            <button type="submit" onclick="return confirm('Yakin ingin membatalkan booking ini?')" class="px-4 py-2 bg-white text-[#A0523C] text-xs defparagraf hover:bg-[#A0523C] hover:text-white transition-colors border-2 border-[#A0523C] rounded-lg">
                                Batalkan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Status Section - COMPLETED -->
            <div class="mt-6 border-t-2 border-[#EEEEEE] pt-4 hidden" id="adminStatusCompleted">
                <div class="bg-gradient-to-br from-[#E7DEAF]/30 to-[#E7DEAF]/10 border-2 border-[#E7DEAF]/50 rounded-xl shadow-lg p-4">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-[#7A8F5C] mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="currentColor">
                                <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                                <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" clip-rule="evenodd"/>
                            </g>
                        </svg>
                        <h4 class="text-sm font-medium defparagraf text-[#7A8F5C]">Selesai Servis</h4>
                    </div>
                    <p class="text-xs defparagraf text-[#7A8F5C] leading-relaxed mb-3">
                        Servis telah selesai. Kendaraan siap diambil oleh pelanggan.
                    </p>
                </div>
            </div>

            <!-- Delete Action - Always Available -->
            <div class="mt-4">
                <div class="bg-gradient-to-br from-red-600/10 to-red-600/5 border-2 border-red-600/30 rounded-xl shadow-sm p-4">
                    <div class="flex items-center mb-2">
                        <svg class="w-4 h-4 text-red-700 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd" d="M17 5V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v1H4a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V7h1a1 1 0 1 0 0-2zm-2-1H9v1h6zm2 3H7v11a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z" clip-rule="evenodd"/>
                            <path fill="currentColor" d="M9 9h2v8H9zm4 0h2v8h-2z"/>
                        </svg>
                        <h4 class="text-xs font-medium defparagraf text-red-700">Hapus Booking (Emergency)</h4>
                    </div>
                    <p class="text-xs defparagraf text-red-600 leading-relaxed mb-3">
                        Hapus booking ini secara permanen jika terjadi kesalahan atau diperlukan.
                    </p>
                    <button type="button" onclick="toggleAdminDeleteConfirm(true)" class="w-full px-3 py-2 text-red-700 bg-red-50 text-xs defparagraf hover:bg-red-100 transition-colors border-2 border-red-400 rounded-lg">
                        Hapus Permanen
                    </button>
                    <div id="adminDeleteConfirm" class="hidden mt-3 space-y-2">
                        <div class="bg-red-50 border border-red-300 text-red-800 p-2 text-xs defparagraf rounded">
                            ⚠️ Tindakan ini tidak dapat dibatalkan. Data akan dihapus permanen.
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="adminDeleteAgree" class="w-3 h-3 text-red-600">
                            <label for="adminDeleteAgree" class="text-xs defparagraf text-red-800">Saya paham konsekuensinya</label>
                        </div>
                        <div class="flex gap-2">
                            <button type="button" onclick="toggleAdminDeleteConfirm(false)" class="flex-1 px-3 py-1 text-gray-700 bg-gray-100 text-xs defparagraf hover:bg-gray-200 transition-colors border border-gray-300 rounded-lg">
                                Batal
                            </button>
                            <form id="adminDeleteForm" method="POST" action="" data-action-template="{{ url('/admin/antrian') }}/:id" onsubmit="return document.getElementById('adminDeleteAgree').checked;" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="adminDeleteSubmit" class="w-full px-3 py-1 text-white bg-red-700 text-xs defparagraf disabled:opacity-50 hover:bg-red-800 transition-colors border border-red-700 rounded-lg" disabled>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-center mt-6 pt-4 border-t border-[#EEEEEE]">
                <button onclick="closeAdminReceiptModal()" class="px-6 py-2 bg-[#0F044C] text-white hover:bg-[#141E61] transition-colors defparagraf text-sm rounded-lg">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
window.openAdminReceiptFromDataset = function(el) {
    try {
        console.log('=== OPENING ADMIN MODAL ===');
        console.log('Button element:', el);

        if (!el) {
            console.error('No element provided to openAdminReceiptFromDataset');
            alert('Error: No button element provided');
            return;
        }

        const ds = el.dataset || {};
        console.log('Button dataset:', ds);
        console.log('Dataset keys:', Object.keys(ds));

        const jsonOr = (v, fb) => {
            try {
                return JSON.parse(v || 'null') ?? fb;
            } catch(e) {
                console.warn('JSON parse error for:', v, e);
                return fb;
            }
        };

        const services = jsonOr(ds.services, []);
        const pricing = jsonOr(ds.pricing, null);
        console.log('Parsed services:', services);
        console.log('Parsed pricing:', pricing);

        // Check if modal element exists
        const modal = document.getElementById('adminBookingReceiptModal');
        console.log('Modal element:', modal);
        if (!modal) {
            console.error('Modal element not found!');
            console.log('All elements with "modal" in ID:');
            document.querySelectorAll('[id*="modal"]').forEach(el => {
                console.log('- Found:', el.id);
            });
            alert('Modal tidak ditemukan. Silakan refresh halaman.');
            return;
        }

        // Enhanced element update function with logging
        const updateElement = (id, value) => {
            console.log(`Updating element '${id}' with value:`, value);
            const el = document.getElementById(id);
            if (el) {
                el.textContent = value;
                console.log(`✅ Successfully updated '${id}'`);
            } else {
                console.error(`❌ Element with id '${id}' not found`);
                // List similar IDs
                const similar = Array.from(document.querySelectorAll('[id*="' + id.substring(0, 10) + '"]')).map(el => el.id);
                if (similar.length) {
                    console.log('Similar IDs found:', similar);
                }
            }
        };

        console.log('Starting to update basic info elements...');
        // Update basic info
        updateElement('adminReceiptBookingId', ds.id || '-');
        updateElement('adminModalSubtitle', 'Detail Booking Antrian');
        updateElement('adminReceiptBookingDate', ds.date || '-');
        updateElement('adminReceiptBookingTime', ds.time || '-');
        updateElement('adminReceiptBookingStatus', (ds.status || '-').replaceAll('_',' ').replace(/\b\w/g, c=>c.toUpperCase()));
        updateElement('adminReceiptOvernight', (ds.menginap === '1' || ds.menginap === 'true') ? 'Ya' : 'Tidak');
        updateElement('adminReceiptDuration', ds.duration ? `${ds.duration} hari` : '-');
        updateElement('adminReceiptBookingCar', ds.car || '-');
        updateElement('adminReceiptMechanic', ds.mechanic || '-');
        updateElement('adminReceiptEstimatedCompletion', ds['estimated-completion'] || '-');
        updateElement('adminReceiptStartService', ds['start-service'] || '-');
        updateElement('adminReceiptEndService', ds['end-service'] || '-');

        // Handle address
        let addressText = 'Datang langsung ke bengkel';

        // Check if we have a pre-formatted address
        if (ds.address && ds.address.trim()) {
            addressText = ds.address;
        } else {
            // Handle individual pickup/delivery addresses
            const hasPickup = ds['is-pickup'] === '1';
            const hasDelivery = ds['is-delivery'] === '1';
            const pickupAddr = ds['pickup-address'] || '';
            const deliveryAddr = ds['delivery-address'] || '';

            if (hasPickup || hasDelivery) {
                const parts = [];
                if (hasPickup && pickupAddr) parts.push('Jemput: ' + pickupAddr);
                if (hasDelivery && deliveryAddr) parts.push('Antar: ' + deliveryAddr);
                addressText = parts.join(' | ') || 'Alamat tidak lengkap';
            }
        }

        updateElement('adminReceiptAddress', addressText);

        // Handle notes
        const notesSection = document.getElementById('adminReceiptNotesSection');
        const notes = ds.notes && ds.notes.trim() ? ds.notes : 'Tidak ada catatan khusus';
        updateElement('adminReceiptNotes', notes);
        if (notes === 'Tidak ada catatan khusus') {
            notesSection && notesSection.classList.add('hidden');
        } else {
            notesSection && notesSection.classList.remove('hidden');
        }

        // Handle services
        const servicesRows = document.getElementById('adminReceiptServicesRows');
        const totalEl = document.getElementById('adminReceiptTotal');
        if (servicesRows) {
            servicesRows.innerHTML = '';
            let total = 0;
            if (services.length) {
                // Sort services: permanent services first, then regular services
                const sortedServices = services.sort((a, b) => {
                    const aIsPermanent = (typeof a === 'object' && a.permanen) || false;
                    const bIsPermanent = (typeof b === 'object' && b.permanen) || false;

                    if (aIsPermanent && !bIsPermanent) return -1;
                    if (!aIsPermanent && bIsPermanent) return 1;
                    return 0;
                });

                sortedServices.forEach(s => {
                    const serviceName = typeof s === 'string' ? s : (s && (s.nama || s.deskripsi)) || '-';
                    const isPermanent = typeof s === 'object' ? (s.permanen || false) : false;
                    
                    // Get pricing data if available
                    let qty = '-';
                    let unitPrice = '-';
                    let subtotal = '-';
                    
                    if (typeof s === 'object' && s) {
                        // Check if this service has pricing data
                        if (s.jumlah !== undefined) {
                            qty = parseInt(s.jumlah) || 0;
                        }
                        if (s.harga_satuan !== undefined && s.harga_satuan !== null) {
                            const price = parseInt(s.harga_satuan) || 0;
                            unitPrice = price > 0 ? `Rp ${price.toLocaleString('id-ID')}` : '-';
                        }
                        if (s.subtotal !== undefined && s.subtotal !== null) {
                            const sub = parseInt(s.subtotal) || 0;
                            subtotal = sub > 0 ? `Rp ${sub.toLocaleString('id-ID')}` : '-';
                            if (sub > 0) total += sub;
                        }
                    }
                    
                    const row = document.createElement('div');
                    row.className = 'grid grid-cols-12 items-center border-b border-gray-100';

                    // Add lock icon for permanent services
                    const nameDisplay = isPermanent ?
                        `<span class="inline-flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17a2 2 0 0 1-2-2c0-1.11.89-2 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2m6 3V10H6v10zm0-12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10c0-1.11.89-2 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3"/></svg>${serviceName}</span>` :
                        serviceName;

                    row.innerHTML = `
                        <div class="col-span-6 py-2 text-[#0F044C] text-sm ${isPermanent ? 'font-semibold text-[#0F044C]' : ''}">${nameDisplay}</div>
                        <div class="col-span-2 py-2 text-center">${qty}</div>
                        <div class="col-span-2 py-2 text-right">${unitPrice}</div>
                        <div class="col-span-2 py-2 text-right font-medium text-[#0F044C]">${subtotal}</div>
                    `;
                    servicesRows.appendChild(row);
                });
            } else {
                const row = document.createElement('div');
                row.className = 'py-2 text-center text-[#787A91] text-sm';
                row.textContent = 'Tidak ada layanan dipilih';
                servicesRows.appendChild(row);
            }
            updateElement('adminReceiptTotal', `Rp ${total.toLocaleString('id-ID')}`);
        }

        // Normalize status
        const uiToRaw = {
            'waiting': 'dalam_antrian',
            'in_progress': 'dalam_servisan',
            'need_confirmation': 'pending',
            'completed': 'selesai'
        };
        const rawStatus = (ds.status || '').toLowerCase();
        const status = uiToRaw[rawStatus] || rawStatus;

        // Hide all status sections
        document.getElementById('adminStatusPending').classList.add('hidden');
        document.getElementById('adminStatusWaitingConfirm').classList.add('hidden');
        document.getElementById('adminStatusInQueue').classList.add('hidden');
        document.getElementById('adminStatusInProgress').classList.add('hidden');
        document.getElementById('adminStatusCompleted').classList.add('hidden');

        // Show appropriate status section and set up forms
        if (status === 'pending') {
            document.getElementById('adminStatusPending').classList.remove('hidden');
            const setPriceForm = document.getElementById('adminSetPriceForm');
            const cancelForm = document.getElementById('adminCancelFormPending');
            if (setPriceForm && ds.id) {
                setPriceForm.action = setPriceForm.getAttribute('data-action-template').replace(':id', ds.id);
            }
            if (cancelForm && ds.id) {
                cancelForm.action = cancelForm.action.replace('BOOKING_ID', ds.id);
            }
            initAdminPriceEditor(services);

            // Set default estimated completion based on booking date
            const tanggalInput = document.getElementById('adminEstimasiTanggal');
            const jamInput = document.getElementById('adminEstimasiJam');
            if (tanggalInput && jamInput) {
                // Simple approach: convert d/m/Y to YYYY-MM-DD directly
                if (ds.date) {
                    const dateParts = ds.date.split('/');
                    if (dateParts.length === 3) {
                        const day = dateParts[0].padStart(2, '0');
                        const month = dateParts[1].padStart(2, '0');
                        const year = dateParts[2];

                        // Convert d/m/Y to YYYY-MM-DD format for date input
                        const inputDate = `${year}-${month}-${day}`;
                        tanggalInput.value = inputDate;
                    }
                } else {
                    // Fallback to today if no booking date
                    const today = new Date();
                    const year = today.getFullYear();
                    const month = String(today.getMonth() + 1).padStart(2, '0');
                    const day = String(today.getDate()).padStart(2, '0');
                    tanggalInput.value = `${year}-${month}-${day}`;
                }

                jamInput.value = '17:00'; // Default to 5 PM as reasonable completion time
            }
        } else if (status === 'harga_dari_admin') {
            document.getElementById('adminStatusWaitingConfirm').classList.remove('hidden');
            const cancelForm = document.getElementById('adminCancelFormWaiting');
            if (cancelForm && ds.id) {
                cancelForm.action = cancelForm.action.replace('BOOKING_ID', ds.id);
            }
        } else if (status === 'dalam_antrian') {
            document.getElementById('adminStatusInQueue').classList.remove('hidden');
            const startForm = document.getElementById('adminStartForm');
            const cancelForm = document.getElementById('adminCancelFormQueue');
            if (startForm && ds.id) {
                startForm.action = startForm.getAttribute('data-action-template').replace(':id', ds.id);
            }
            if (cancelForm && ds.id) {
                cancelForm.action = cancelForm.action.replace('BOOKING_ID', ds.id);
            }
        } else if (status === 'dalam_servisan') {
            document.getElementById('adminStatusInProgress').classList.remove('hidden');
            const finishForm = document.getElementById('adminFinishForm');
            const cancelForm = document.getElementById('adminCancelFormProgress');
            if (finishForm && ds.id) {
                finishForm.action = finishForm.getAttribute('data-action-template').replace(':id', ds.id);
            }
            if (cancelForm && ds.id) {
                cancelForm.action = cancelForm.action.replace('BOOKING_ID', ds.id);
            }
        } else if (status === 'selesai') {
            document.getElementById('adminStatusCompleted').classList.remove('hidden');
        }

        // Set up delete form
        const deleteForm = document.getElementById('adminDeleteForm');
        if (deleteForm && ds.id) {
            deleteForm.action = deleteForm.getAttribute('data-action-template').replace(':id', ds.id);
        }

        // Reset delete confirmation
        const delBox = document.getElementById('adminDeleteConfirm');
        const delAgree = document.getElementById('adminDeleteAgree');
        const delSubmit = document.getElementById('adminDeleteSubmit');
        if (delBox) delBox.classList.add('hidden');
        if (delAgree) delAgree.checked = false;
        if (delSubmit) delSubmit.disabled = true;

        // Show modal
        console.log('About to show modal...');
        console.log('Modal classes before show:', modal.classList.toString());
        modal.classList.remove('hidden');
        console.log('Modal classes after show:', modal.classList.toString());
        console.log('Modal should now be visible');
        console.log('=== MODAL OPENING COMPLETE ===');

    } catch (error) {
        console.error('❌ FATAL ERROR opening modal:', error);
        console.error('Error stack:', error.stack);
        alert('Terjadi kesalahan saat membuka modal: ' + error.message + '. Silakan coba lagi atau refresh halaman.');
    }
};

window.closeAdminReceiptModal = function(){
    try {
        console.log('Closing admin modal...');
        const modal = document.getElementById('adminBookingReceiptModal');
        if (modal) {
            modal.classList.add('hidden');
            console.log('✅ Modal closed successfully');
        } else {
            console.error('❌ Modal element not found when trying to close');
        }
    } catch (error) {
        console.error('❌ Error closing modal:', error);
    }
};

function initAdminPriceEditor(services) {
    try {
        const rows = document.getElementById('adminPriceEditorRows');
        const totalInput = document.getElementById('adminModalHargaKeseluruhan');
        const hidden = document.getElementById('adminPriceDetailsJson');

        if (!rows) {
            console.error('adminPriceEditorRows element not found');
            return;
        }
        if (!totalInput) {
            console.error('adminModalHargaKeseluruhan element not found');
            return;
        }
        if (!hidden) {
            console.error('adminPriceDetailsJson element not found');
            return;
        }

        rows.innerHTML = '';
// Sort services: permanent services first, then regular services
const sortedServices = (services || []).sort((a, b) => {
    const aIsPermanent = (typeof a === 'object' && a.permanen) || false;
    const bIsPermanent = (typeof b === 'object' && b.permanen) || false;

    if (aIsPermanent && !bIsPermanent) return -1;
    if (!aIsPermanent && bIsPermanent) return 1;
    return 0;
});

const items = sortedServices.map(s => {
    const name = typeof s === 'string' ? s : (s && (s.nama || s.deskripsi)) || '-';

    let defaultPrice = 0;
    if (typeof s === 'object' && s) {
        defaultPrice = parseInt(s.harga_default) || 0;
    }

    const isPermanent = typeof s === 'object' ? Boolean(s.permanen) : false;

    return { name: name, jumlah: 1, price: 0, defaultPrice: defaultPrice, isPermanent: isPermanent };
});

        if (items.length === 0) {
            items.push({ name: 'Layanan', jumlah: 1, price: 0, defaultPrice: 0, isPermanent: false });
        }

        // Function to format number with thousand separators
        function formatNumber(num) {
            if (!num || num === 0) return '0';
            return parseInt(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Function to parse number from formatted string
        function parseFormattedNumber(str) {
            return parseInt(str.replace(/\./g, '')) || 0;
        }

        function serialize() {
            let list = [];
            let sum = 0;
            rows.querySelectorAll('[data-row]').forEach(r => {
                const nama = r.querySelector('[data-name]').textContent || '-';
                const jumlah = parseInt(r.querySelector('[data-jumlah]').value || '0', 10);
                const priceInput = r.querySelector('[data-price]');
                const price = parseFormattedNumber(priceInput.value || '0');
                const sub = Math.max(0, jumlah) * Math.max(0, price);
                list.push({ nama: nama, jumlah: jumlah, harga_satuan: price, subtotal: sub });
                sum += sub;
            });
            hidden.value = JSON.stringify(list);
            totalInput.value = sum;
        }

        items.forEach(it => {
            const row = document.createElement('div');
            // Add special styling for permanent services
            const bgClass = it.isPermanent ?
                'bg-gradient-to-r from-amber-100/80 to-orange-100/60 border-2 border-amber-300 shadow-sm' :
                'bg-gradient-to-r from-[#FFDC7F]/10 to-[#FFDC7F]/5 border border-[#FFDC7F]/30';
            row.className = `flex items-center justify-between ${bgClass} rounded-lg px-3 py-2 mb-2`;
            row.setAttribute('data-row', '1');

            const left = document.createElement('div');
            left.className = `defparagraf text-xs font-medium pr-2 flex-1 ${it.isPermanent ? 'text-amber-800 font-semibold' : 'text-[#0F044C]'}`;
            left.setAttribute('data-name', '1');
            // Add lock icon for permanent services
            if (it.isPermanent) {
                left.innerHTML = `<span class="inline-flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17a2 2 0 0 1-2-2c0-1.11.89-2 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2m6 3V10H6v10zm0-12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10c0-1.11.89-2 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3"/></svg>${it.name}</span>`;
            } else {
                left.textContent = it.name;
            }

            const right = document.createElement('div');
            right.className = 'flex items-center gap-1';

            const jumlah = document.createElement('input');
            jumlah.type = 'number';
            jumlah.min = '1';
            jumlah.step = '1';
            jumlah.value = String(it.jumlah);
            jumlah.className = 'w-12 text-center border border-[#FFDC7F]/60 rounded px-1 py-1 text-xs';
            jumlah.setAttribute('data-jumlah', '1');

            const price = document.createElement('input');
            price.type = 'text';
            price.value = '';

            // Set placeholder
            if (it.defaultPrice && it.defaultPrice > 0) {
                price.placeholder = formatNumber(it.defaultPrice);
            } else {
                price.placeholder = 'Masukkan harga...';
            }

            const priceClass = it.isPermanent ?
                'w-24 text-right border-2 border-amber-300 bg-amber-50 rounded-md px-2 py-1 text-xs font-medium text-amber-800 focus:border-amber-400 focus:bg-amber-100' :
                'w-24 text-right border border-[#FFDC7F]/60 rounded-md px-2 py-1 text-xs focus:border-[#FFDC7F] focus:ring-1 focus:ring-[#FFDC7F]/30';
            price.className = priceClass;
            price.setAttribute('data-price', '1');

            // Add formatting for price input
            price.addEventListener('input', function() {
                const value = this.value.replace(/\./g, '');
                if (value && !isNaN(value)) {
                    this.value = formatNumber(parseInt(value));
                }
                serialize();
            });

            // Set default price if available and input is empty
            price.addEventListener('focus', function() {
                if (!this.value && it.defaultPrice > 0) {
                    this.value = formatNumber(it.defaultPrice);
                    setTimeout(() => serialize(), 100);
                }
            });

            right.appendChild(jumlah);
            right.appendChild(price);
            row.appendChild(left);
            row.appendChild(right);
            rows.appendChild(row);

            jumlah.addEventListener('input', serialize);
        });

        serialize();
    } catch (e) {
        console.error('Price editor error:', e);
    }
}

window.toggleAdminDeleteConfirm = function(show) {
    const box = document.getElementById('adminDeleteConfirm');
    if (!box) return;
    if (show) {
        box.classList.remove('hidden');
    } else {
        box.classList.add('hidden');
    }
};

// Initialize delete confirmation checkbox
document.addEventListener('DOMContentLoaded', function() {
    const agree = document.getElementById('adminDeleteAgree');
    const submitBtn = document.getElementById('adminDeleteSubmit');
    if (agree && submitBtn) {
        agree.addEventListener('change', function() {
            submitBtn.disabled = !agree.checked;
        });
    }
});
</script>
