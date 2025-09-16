<!-- Admin Booking Receipt Modal Component -->
<div id="adminReceiptModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white border-2 border-[#0F044C] shadow-lg max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="bg-[#0F044C] text-white p-4 text-center">
            <h3 class="text-lg font-montserrat-48" id="adminModalTitle">DETAIL STRUK (Montir)</h3>
            <p class="text-sm defparagraf mt-1" id="adminModalSubtitle">Detail Struk Servis</p>
        </div>

        <!-- Receipt Content -->
        <div class="p-6">
            <!-- Booking ID -->
            <div class="text-center mb-6">
                <h4 class="text-sm defparagraf text-[#787A91] mb-1">ID BOOKING</h4>
                <p class="text-lg font-montserrat-48 text-[#0F044C]" id="adminReceiptBookingId">-</p>
            </div>

            <!-- Booking Details -->
            <div class="space-y-4 border-t-2 border-[#EEEEEE] pt-4">
                <!-- Date & Time -->
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Tanggal:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptBookingDate">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Jam:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptBookingTime">-</span>
                </div>

                <!-- Car Info -->
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Mobil:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="adminReceiptBookingCar">-</span>
                </div>

                <!-- Services -->
                <div class="border-t border-[#EEEEEE] pt-3">
                    <p class="defparagraf text-[#787A91] mb-2">Layanan:</p>
                    <ul class="space-y-1" id="adminReceiptBookingServices"></ul>
                </div>

                <!-- Price Details (optional) -->
                <div class="border-t border-[#EEEEEE] pt-3 hidden" id="adminReceiptPriceSection">
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
                            <div class="flex justify-between text-xs defparagraf" id="adminReceiptDeliverySection">
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
            </div>

            <!-- Admin-only notes/address (optional) -->
            <div class="mt-4 space-y-3">
                <div class="hidden" id="adminReceiptAddressWrapper">
                    <p class="defparagraf text-[#787A91] mb-1">Alamat:</p>
                    <p class="defparagraf text-[#0F044C] text-sm" id="adminReceiptAddress">-</p>
                </div>
                <div class="hidden" id="adminReceiptNotesWrapper">
                    <p class="defparagraf text-[#787A91] mb-1">Catatan:</p>
                    <p class="defparagraf text-[#0F044C] text-sm" id="adminReceiptNotes">-</p>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="flex justify-center mt-6 gap-2" id="adminReceiptFooter">
                <button onclick="closeAdminReceiptModal()" class="px-6 py-2 bg-[#0F044C] text-white hover:bg-[#141E61] transition-colors defparagraf">Tutup</button>
                <button id="adminReceiptEditBtn" class="hidden px-6 py-2 bg-[#141E61] text-white hover:bg-[#0F044C] transition-colors defparagraf">Edit Struk</button>
            </div>
        </div>
    </div>
</div>

<script>
window.showAdminReceiptModal = function(bookingData){
    try{
        // Basic fields
        document.getElementById('adminReceiptBookingId').textContent = bookingData.id || '-';
        document.getElementById('adminReceiptBookingDate').textContent = bookingData.date || '-';
        document.getElementById('adminReceiptBookingTime').textContent = bookingData.time || '-';
        document.getElementById('adminReceiptBookingCar').textContent = bookingData.car || '-';

        // Services
        var list = document.getElementById('adminReceiptBookingServices');
        list.innerHTML = '';
        var services = Array.isArray(bookingData.services) ? bookingData.services : [];
        if (services.length){
            services.forEach(function(s){
                var li = document.createElement('li');
                li.className = 'defparagraf text-[#0F044C] text-sm';
                li.textContent = '• ' + s;
                list.appendChild(li);
            });
        } else {
            var li = document.createElement('li');
            li.className = 'defparagraf text-[#787A91] text-sm';
            li.textContent = 'Tidak ada layanan';
            list.appendChild(li);
        }

        // Price
        var priceSec = document.getElementById('adminReceiptPriceSection');
        if (bookingData.pricing){
            document.getElementById('adminReceiptServiceCost').textContent = bookingData.pricing.serviceCost || 'Rp 0';
            document.getElementById('adminReceiptSparepartCost').textContent = bookingData.pricing.sparepartCost || 'Rp 0';
            document.getElementById('adminReceiptDeliveryCost').textContent = bookingData.pricing.deliveryCost || 'Rp 0';
            document.getElementById('adminReceiptTotalCost').textContent = bookingData.pricing.totalCost || 'Rp 0';
            priceSec.classList.remove('hidden');
            var deliverySec = document.getElementById('adminReceiptDeliverySection');
            if (!bookingData.pricing.deliveryCost || bookingData.pricing.deliveryCost === 'Rp 0') {
                deliverySec.classList.add('hidden');
            } else {
                deliverySec.classList.remove('hidden');
            }
        } else {
            priceSec.classList.add('hidden');
        }

        // Address & notes
        var addressWrap = document.getElementById('adminReceiptAddressWrapper');
        if (bookingData.address){
            document.getElementById('adminReceiptAddress').textContent = bookingData.address;
            addressWrap.classList.remove('hidden');
        } else {
            addressWrap.classList.add('hidden');
        }
        var notesWrap = document.getElementById('adminReceiptNotesWrapper');
        if (bookingData.notes){
            document.getElementById('adminReceiptNotes').textContent = bookingData.notes;
            notesWrap.classList.remove('hidden');
        } else {
            notesWrap.classList.add('hidden');
        }

        // Edit button
        var editBtn = document.getElementById('adminReceiptEditBtn');
        if (bookingData.editUrl){
            editBtn.classList.remove('hidden');
            editBtn.onclick = function(){ window.location.href = bookingData.editUrl; };
        } else {
            editBtn.classList.add('hidden');
            editBtn.onclick = null;
        }

        // Titles (optional)
        document.getElementById('adminModalTitle').textContent = 'DETAIL STRUK (Montir)';
        document.getElementById('adminModalSubtitle').textContent = 'Detail Struk Servis';

        // Show modal
        document.getElementById('adminReceiptModal').classList.remove('hidden');
    }catch(e){ console.warn('showAdminReceiptModal failed', e); }
}

window.closeAdminReceiptModal = function(){
    document.getElementById('adminReceiptModal').classList.add('hidden');
}

// Click outside to close
document.addEventListener('click', function(e){
    var modal = document.getElementById('adminReceiptModal');
    if (e.target === modal) { window.closeAdminReceiptModal(); }
});
</script>
