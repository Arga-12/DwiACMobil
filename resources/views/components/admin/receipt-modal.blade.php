<!-- Admin Booking Receipt Modal Component -->
<div id="adminBookingReceiptModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white border-2 border-[#0F044C] shadow-lg max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <!-- Header -->
        <div class="bg-[#0F044C] text-white p-4 text-center">
            <h3 class="text-xl font-montserrat-48">DETAIL STRUK (ADMIN)</h3>
            <p class="text-sm defparagraf mt-1" id="adminModalSubtitle">Detail Booking Antrian</p>
        </div>

        <div class="p-6">
            <!-- Booking ID -->
            <div class="text-center mb-6">
                <h4 class="text-sm defparagraf text-[#787A91] mb-1">ID BOOKING</h4>
                <p class="text-lg font-montserrat-48 text-[#0F044C]" id="adminReceiptBookingId">-</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="defparagraf text-[#787A91]">Tanggal:</span>
                        <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptBookingDate">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="defparagraf text-[#787A91]">Jam:</span>
                        <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptBookingTime">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="defparagraf text-[#787A91]">Status:</span>
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
                        <span class="defparagraf text-[#787A91]">Tanggal Selesai:</span>
                        <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptEndDate">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="defparagraf text-[#787A91]">Jam Selesai:</span>
                        <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptEndTime">-</span>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="defparagraf text-[#787A91]">Mobil:</span>
                        <span class="defparagraf text-[#0F044C] font-medium text-right" id="adminReceiptBookingCar">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="defparagraf text-[#787A91]">Montir:</span>
                        <span class="defparagraf text-[#0F044C] font-medium text-right" id="adminReceiptMechanic">-</span>
                    </div>
                    <div class="border-t border-[#EEEEEE] pt-3">
                        <p class="defparagraf text-[#787A91] mb-1">Alamat Pickup/Delivery:</p>
                        <p class="defparagraf text-[#0F044C] text-sm" id="adminReceiptAddress">-</p>
                    </div>
                    <div class="border-t border-[#EEEEEE] pt-3">
                        <p class="defparagraf text-[#787A91] mb-1">Catatan:</p>
                        <p class="defparagraf text-[#0F044C] text-sm" id="adminReceiptNotes">-</p>
                    </div>
                </div>
            </div>

            <div class="border-t-2 border-[#EEEEEE] pt-4 mt-4">
                <p class="defparagraf text-[#787A91] mb-2">Layanan Dipilih:</p>
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-2" id="adminReceiptServices"></ul>
            </div>

            <div class="border-t-2 border-[#EEEEEE] pt-4 mt-4" id="adminReceiptPriceBox">
                <p class="defparagraf text-[#787A91] mb-2">Detail Harga:</p>
                <div class="bg-white border border-[#787A91] p-3">
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs defparagraf">
                            <span class="text-[#787A91]">Biaya Layanan:</span>
                            <span class="text-[#0F044C] font-medium" id="adminReceiptServiceCost">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-xs defparagraf">
                            <span class="text-[#787A91]">Biaya Sparepart:</span>
                            <span class="text-[#0F044C] font-medium" id="adminReceiptSparepartCost">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-xs defparagraf">
                            <span class="text-[#787A91]">Biaya Pickup/Delivery:</span>
                            <span class="text-[#0F044C] font-medium" id="adminReceiptDeliveryCost">Rp 0</span>
                        </div>
                        <hr class="border-[#EEEEEE]">
                        <div class="flex justify-between text-sm defparagraf font-medium">
                            <span class="text-[#0F044C]">Total Harga:</span>
                            <span class="text-[#0F044C]" id="adminReceiptTotalCost">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Set Harga Section (untuk status pending) -->
            <div class="border-t-2 border-[#EEEEEE] pt-4 mt-4 hidden" id="adminSetPriceSection">
                <div class="bg-yellow-50 border-2 border-yellow-200 p-4 rounded-none">
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0 2.08-.402 2.599-1"></path>
                        </svg>
                        <h4 class="defparagraf font-semibold text-yellow-800">Set Harga Layanan</h4>
                    </div>
                    <p class="defparagraf text-yellow-700 text-sm mb-4">Booking ini belum memiliki harga. Silakan tentukan harga total untuk layanan yang dipilih.</p>
                    
                    <form id="adminSetPriceForm" method="POST" action="" data-action-template="{{ url('/admin/antrian') }}/:id/set-price" class="rounded-none">
                        @csrf
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2 defparagraf">Harga Total (Rp)</label>
                                <input type="number" 
                                       name="harga_keseluruhan" 
                                       id="adminModalHargaKeseluruhan"
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-none focus:ring-2 focus:ring-[#141E61] focus:border-[#141E61] transition-colors defparagraf" 
                                       placeholder="Masukkan harga total"
                                       min="0"
                                       step="1000"
                                       required />
                            </div>
                            <div class="text-xs text-gray-500 defparagraf">
                                * Harga akan dikirim ke pelanggan untuk konfirmasi
                            </div>
                            <div class="flex gap-3">
                                <button type="submit" class="flex-1 px-4 py-2 text-sm font-medium text-white bg-[#141E61] border-2 border-[#141E61] rounded-none hover:bg-[#0F044C] transition-colors shadow-sm defparagraf">
                                    Set Harga
                                </button>
                                <button type="button" onclick="cancelSetPrice()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border-2 border-gray-300 rounded-none hover:bg-gray-200 transition-colors defparagraf">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Admin Actions for queue progression -->
            <div class="border-t-2 border-[#EEEEEE] pt-4 mt-4 hidden" id="adminActionStart">
                <div class="bg-white border-2 border-gray-300 p-4 rounded-none">
                    <div class="flex items-center justify-between">
                        <p class="defparagraf text-gray-800">Pelanggan menyetujui harga. Tekan tombol untuk memulai servis.</p>
                        <form id="adminStartForm" method="POST" action="" data-action-template="{{ url('/admin/antrian') }}/:id/start" class="ml-4">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#141E61] border-2 border-[#141E61] rounded-none hover:bg-[#0F044C] transition-colors defparagraf">Mulai Servis</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="border-t-2 border-[#EEEEEE] pt-4 mt-4 hidden" id="adminActionFinish">
                <div class="bg-white border-2 border-gray-300 p-4 rounded-none">
                    <div class="flex items-center justify-between">
                        <p class="defparagraf text-gray-800">Servis sedang berlangsung. Tandai selesai ketika pekerjaan tuntas.</p>
                        <form id="adminFinishForm" method="POST" action="" data-action-template="{{ url('/admin/antrian') }}/:id/finish" class="ml-4">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-700 border-2 border-green-700 rounded-none hover:bg-green-800 transition-colors defparagraf">Tandai Selesai</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-6">
                <button onclick="closeAdminReceiptModal()" class="px-6 py-2 bg-[#0F044C] text-white hover:bg-[#141E61] transition-colors defparagraf">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
window.openAdminReceiptFromDataset = function(el){
    const ds = el.dataset || {};
    const jsonOr = (v, fb) => { try { return JSON.parse(v || 'null') ?? fb; } catch { return fb; } };
    const services = jsonOr(ds.services, []);
    const pricing = jsonOr(ds.pricing, null);

    document.getElementById('adminReceiptBookingId').textContent = ds.id || '-';
    document.getElementById('adminModalSubtitle').textContent = 'Detail Booking Antrian';
    document.getElementById('adminReceiptBookingDate').textContent = ds.date || '-';
    document.getElementById('adminReceiptBookingTime').textContent = ds.time || '-';
    document.getElementById('adminReceiptBookingStatus').textContent = (ds.status || '-').replaceAll('_',' ').replace(/\b\w/g, c=>c.toUpperCase());
    document.getElementById('adminReceiptOvernight').textContent = (ds.menginap === '1' || ds.menginap === 'true') ? 'Ya' : 'Tidak';
    document.getElementById('adminReceiptDuration').textContent = ds.duration ? `${ds.duration} hari` : '-';
    document.getElementById('adminReceiptEndDate').textContent = ds.enddate || '-';
    document.getElementById('adminReceiptEndTime').textContent = ds.endtime || '-';
    document.getElementById('adminReceiptBookingCar').textContent = ds.car || '-';
    document.getElementById('adminReceiptMechanic').textContent = ds.mechanic || '-';
    document.getElementById('adminReceiptAddress').textContent = (ds.address && ds.address.trim()) ? ds.address : 'Datang langsung ke bengkel';
    document.getElementById('adminReceiptNotes').textContent = (ds.notes && ds.notes.trim()) ? ds.notes : '-';

    const svc = document.getElementById('adminReceiptServices');
    svc.innerHTML = '';
    if (services.length) {
        services.forEach(s => {
            const li = document.createElement('li');
            li.className = 'defparagraf text-[#0F044C] text-sm';
            li.textContent = `• ${s}`;
            svc.appendChild(li);
        });
    } else {
        const li = document.createElement('li');
        li.className = 'defparagraf text-[#787A91] text-sm';
        li.textContent = 'Tidak ada layanan dipilih';
        svc.appendChild(li);
    }

    const priceBox = document.getElementById('adminReceiptPriceBox');
    if (pricing) {
        document.getElementById('adminReceiptServiceCost').textContent = pricing.serviceCost || 'Rp 0';
        document.getElementById('adminReceiptSparepartCost').textContent = pricing.sparepartCost || 'Rp 0';
        document.getElementById('adminReceiptDeliveryCost').textContent = pricing.deliveryCost || 'Rp 0';
        document.getElementById('adminReceiptTotalCost').textContent = pricing.totalCost || 'Rp 0';
        priceBox.classList.remove('hidden');
    } else {
        priceBox.classList.add('hidden');
    }

    // Normalize status: accept either raw DB statuses or UI grouping statuses
    const uiToRaw = {
        'waiting': 'dalam_antrian',
        'in_progress': 'dalam_servisan',
        'need_confirmation': 'pending',
        'completed': 'selesai'
    };
    const rawStatus = (ds.status || '').toLowerCase();
    const status = uiToRaw[rawStatus] || rawStatus;

    // Reset inputs/sections
    const setPriceSection = document.getElementById('adminSetPriceSection');
    document.getElementById('adminModalHargaKeseluruhan').value = '';
    setPriceSection.classList.add('hidden');

    // Show set price section for statuses that require admin price
    if (status === 'pending' || status === 'harga_dari_admin') {
        setPriceSection.classList.remove('hidden');
    }

    // Toggle admin action sections based on status
    const startSec = document.getElementById('adminActionStart');
    const finishSec = document.getElementById('adminActionFinish');
    if (startSec) startSec.classList.add('hidden');
    if (finishSec) finishSec.classList.add('hidden');
    if (status === 'dalam_antrian') {
        startSec && startSec.classList.remove('hidden');
    } else if (status === 'dalam_servisan') {
        finishSec && finishSec.classList.remove('hidden');
    }

    // Set form action dynamically using template
    const setPriceForm = document.getElementById('adminSetPriceForm');
    if (setPriceForm) {
        const tpl = setPriceForm.getAttribute('data-action-template');
        if (tpl && ds.id) {
            setPriceForm.action = tpl.replace(':id', encodeURIComponent(ds.id));
        } else {
            // Fallback: hide section if id is missing
            setPriceSection && setPriceSection.classList.add('hidden');
        }
    }

    // Set actions for start/finish forms
    const startForm = document.getElementById('adminStartForm');
    if (startForm) {
        const tpl = startForm.getAttribute('data-action-template');
        if (tpl && ds.id) startForm.action = tpl.replace(':id', encodeURIComponent(ds.id));
    }
    const finishForm = document.getElementById('adminFinishForm');
    if (finishForm) {
        const tpl = finishForm.getAttribute('data-action-template');
        if (tpl && ds.id) finishForm.action = tpl.replace(':id', encodeURIComponent(ds.id));
    }

    document.getElementById('adminBookingReceiptModal').classList.remove('hidden');
};

window.closeAdminReceiptModal = function(){
    document.getElementById('adminBookingReceiptModal').classList.add('hidden');
};

window.cancelSetPrice = function(){
    document.getElementById('adminSetPriceSection').classList.add('hidden');
};
</script>
