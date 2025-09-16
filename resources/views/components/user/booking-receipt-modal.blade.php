<!-- Booking Receipt Modal Component -->
<div id="bookingReceiptModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white border-2 border-[#0F044C] shadow-lg max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="bg-[#0F044C] text-white p-4 text-center">
            <h3 class="text-lg font-montserrat-48" id="modalTitle">DETAIL STRUK</h3>
            <p class="text-sm defparagraf mt-1" id="modalSubtitle">Struk Booking Antrian</p>
        </div>

        <!-- Receipt Content -->
        <div class="p-6">
            <!-- Booking ID -->
            <div class="text-center mb-6">
                <h4 class="text-sm defparagraf text-[#787A91] mb-1">ID BOOKING</h4>
                <p class="text-lg font-montserrat-48 text-[#0F044C]" id="receiptBookingId">-</p>
            </div>

            <!-- Booking Details -->
            <div class="space-y-4 border-t-2 border-[#EEEEEE] pt-4">
                <!-- Date & Time -->
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Tanggal:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="receiptBookingDate">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Jam:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="receiptBookingTime">-</span>
                </div>

                <!-- Car Info -->
                <div class="flex justify-between">
                    <span class="defparagraf text-[#787A91]">Mobil:</span>
                    <span class="defparagraf text-[#0F044C] font-medium" id="receiptBookingCar">-</span>
                </div>

                <!-- Services -->
                <div class="border-t border-[#EEEEEE] pt-3">
                    <p class="defparagraf text-[#787A91] mb-2">Layanan Dipilih:</p>
                    <ul class="space-y-1" id="receiptBookingServices">
                        <!-- Services will be populated here -->
                    </ul>
                </div>

                <!-- Address -->
                <div class="border-t border-[#EEEEEE] pt-3" id="receiptAddressSection">
                    <p class="defparagraf text-[#787A91] mb-1">Alamat pickup/Delivery:</p>
                    <p class="defparagraf text-[#0F044C] text-sm" id="receiptBookingAddress">-</p>
                </div>

                <!-- Notes -->
                <div class="border-t border-[#EEEEEE] pt-3" id="receiptNotesSection">
                    <p class="defparagraf text-[#787A91] mb-1">Catatan:</p>
                    <p class="defparagraf text-[#0F044C] text-sm" id="receiptBookingNotes">-</p>
                </div>

                <!-- Price Details (if available) -->
                <div class="border-t border-[#EEEEEE] pt-3 hidden" id="receiptPriceSection">
                    <p class="defparagraf text-[#787A91] mb-2">Detail Harga:</p>
                    <div class="bg-white border border-[#787A91] p-3">
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs defparagraf">
                                <span class="text-[#787A91]">Biaya Layanan:</span>
                                <span class="text-[#0F044C] font-medium" id="receiptServiceCost">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-xs defparagraf">
                                <span class="text-[#787A91]">Biaya Sparepart:</span>
                                <span class="text-[#0F044C] font-medium" id="receiptSparepartCost">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-xs defparagraf" id="receiptDeliverySection">
                                <span class="text-[#787A91]">Biaya Pickup/Delivery:</span>
                                <span class="text-[#0F044C] font-medium" id="receiptDeliveryCost">Rp 0</span>
                            </div>
                            <hr class="border-[#EEEEEE]">
                            <div class="flex justify-between text-sm defparagraf font-medium">
                                <span class="text-[#0F044C]">Total Harga:</span>
                                <span class="text-[#0F044C]" id="receiptTotalCost">Rp 0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Info -->
            <div class="mt-6" id="receiptStatusSection">
                <!-- Waiting Status -->
                <div class="bg-[#EEEEEE] border-2 border-[#787A91] p-4 hidden" id="receiptWaitingStatus">
                    <h4 class="text-sm font-medium defparagraf text-[#0F044C] mb-2">⏳ Menunggu Konfirmasi Harga</h4>
                    <p class="text-xs defparagraf text-[#787A91] leading-relaxed mb-3">
                        Booking Anda telah diterima. Montir sedang menyiapkan estimasi harga berdasarkan layanan yang dipilih.
                    </p>
                    
                    <!-- Loading Animation (shows initially) -->
                    <div class="flex items-center justify-center" id="waitingLoadingAnimation">
                        <div class="animate-spin rounded-full h-4 w-4 border-2 border-[#0F044C] border-t-transparent mr-2"></div>
                        <span class="text-xs defparagraf text-[#0F044C] font-medium">Sedang diproses...</span>
                    </div>
                    
                    <!-- Action Buttons (shows after 3 seconds) -->
                    <div class="hidden" id="waitingActionButtons">
                        <div class="text-center mb-3">
                            <p class="text-xs defparagraf text-[#787A91]">Apakah Anda ingin melanjutkan booking ini?</p>
                        </div>
                        <div class="flex gap-2 justify-center">
                            <button onclick="confirmWaitingBooking()" class="px-4 py-2 bg-green-600 text-white text-xs defparagraf hover:bg-green-700 transition-colors rounded">
                                ✅ Konfirmasi
                            </button>
                            <button onclick="cancelWaitingBooking()" class="px-4 py-2 bg-red-600 text-white text-xs defparagraf hover:bg-red-700 transition-colors rounded">
                                ❌ Batalkan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Confirmed Status -->
                <div class="bg-green-50 border-2 border-green-500 p-4 hidden" id="receiptConfirmedStatus">
                    <h4 class="text-sm font-medium defparagraf text-green-700 mb-2">✅ Booking Dikonfirmasi</h4>
                    <p class="text-xs defparagraf text-green-600 leading-relaxed">
                        Booking telah dikonfirmasi. Montir akan memproses pesanan sesuai jadwal yang ditentukan.
                    </p>
                </div>

                <!-- Completed Status -->
                <div class="bg-blue-50 border-2 border-blue-500 p-4 hidden" id="receiptCompletedStatus">
                    <h4 class="text-sm font-medium defparagraf text-blue-700 mb-2">🎉 Layanan Selesai</h4>
                    <p class="text-xs defparagraf text-blue-600 leading-relaxed">
                        Layanan telah selesai dikerjakan. Terima kasih telah menggunakan layanan DwiACMobil.
                    </p>
                </div>

                <!-- Cancelled Status -->
                <div class="bg-red-50 border-2 border-red-500 p-4 hidden" id="receiptCancelledStatus">
                    <h4 class="text-sm font-medium defparagraf text-red-700 mb-2">❌ Booking Dibatalkan</h4>
                    <p class="text-xs defparagraf text-red-600 leading-relaxed">
                        Booking telah dibatalkan. Anda dapat membuat booking baru jika diperlukan.
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-center mt-6">
                <button onclick="closeReceiptModal()" class="px-6 py-2 bg-[#0F044C] text-white hover:bg-[#141E61] transition-colors defparagraf">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Global functions for booking receipt modal
window.showReceiptModal = function(bookingData) {
    // Populate modal with booking data
    document.getElementById('receiptBookingId').textContent = bookingData.id || '-';
    document.getElementById('receiptBookingDate').textContent = bookingData.date || '-';
    document.getElementById('receiptBookingTime').textContent = bookingData.time || '-';
    document.getElementById('receiptBookingCar').textContent = bookingData.car || '-';
    
    // Populate services
    const servicesContainer = document.getElementById('receiptBookingServices');
    servicesContainer.innerHTML = '';
    if (bookingData.services && bookingData.services.length > 0) {
        bookingData.services.forEach(service => {
            const li = document.createElement('li');
            li.className = 'defparagraf text-[#0F044C] text-sm';
            li.innerHTML = `• ${service}`;
            servicesContainer.appendChild(li);
        });
    } else {
        servicesContainer.innerHTML = '<li class="defparagraf text-[#787A91] text-sm">Tidak ada layanan dipilih</li>';
    }
    
    // Handle address
    const addressSection = document.getElementById('receiptAddressSection');
    if (bookingData.address && bookingData.address.trim()) {
        document.getElementById('receiptBookingAddress').textContent = bookingData.address;
        addressSection.classList.remove('hidden');
    } else {
        document.getElementById('receiptBookingAddress').textContent = 'Datang langsung ke bengkel';
        addressSection.classList.remove('hidden');
    }
    
    // Handle notes
    const notesSection = document.getElementById('receiptNotesSection');
    if (bookingData.notes && bookingData.notes.trim()) {
        document.getElementById('receiptBookingNotes').textContent = bookingData.notes;
        notesSection.classList.remove('hidden');
    } else {
        notesSection.classList.add('hidden');
    }
    
    // Handle price information
    const priceSection = document.getElementById('receiptPriceSection');
    if (bookingData.pricing) {
        document.getElementById('receiptServiceCost').textContent = bookingData.pricing.serviceCost || 'Rp 0';
        document.getElementById('receiptSparepartCost').textContent = bookingData.pricing.sparepartCost || 'Rp 0';
        document.getElementById('receiptDeliveryCost').textContent = bookingData.pricing.deliveryCost || 'Rp 0';
        document.getElementById('receiptTotalCost').textContent = bookingData.pricing.totalCost || 'Rp 0';
        priceSection.classList.remove('hidden');
        
        // Hide delivery cost if not applicable
        const deliverySection = document.getElementById('receiptDeliverySection');
        if (!bookingData.pricing.deliveryCost || bookingData.pricing.deliveryCost === 'Rp 0') {
            deliverySection.classList.add('hidden');
        } else {
            deliverySection.classList.remove('hidden');
        }
    } else {
        priceSection.classList.add('hidden');
    }
    
    // Handle status
    resetReceiptStatus();
    const status = bookingData.status || 'waiting';
    switch(status) {
        case 'waiting':
            document.getElementById('receiptWaitingStatus').classList.remove('hidden');
            startWaitingTimer();
            break;
        case 'confirmed':
            document.getElementById('receiptConfirmedStatus').classList.remove('hidden');
            break;
        case 'completed':
            document.getElementById('receiptCompletedStatus').classList.remove('hidden');
            break;
        case 'cancelled':
            document.getElementById('receiptCancelledStatus').classList.remove('hidden');
            break;
    }
    
    // Set modal title based on context
    if (bookingData.isNewBooking) {
        document.getElementById('modalTitle').textContent = 'BOOKING BERHASIL!';
        document.getElementById('modalSubtitle').textContent = 'Struk Booking Antrian';
    } else {
        document.getElementById('modalTitle').textContent = 'DETAIL STRUK';
        document.getElementById('modalSubtitle').textContent = 'Detail Booking Antrian';
    }
    
    // Show modal
    document.getElementById('bookingReceiptModal').classList.remove('hidden');
};

window.closeReceiptModal = function() {
    document.getElementById('bookingReceiptModal').classList.add('hidden');
    // Clear any waiting timer when closing modal
    clearWaitingTimer();
};

function resetReceiptStatus() {
    document.getElementById('receiptWaitingStatus').classList.add('hidden');
    document.getElementById('receiptConfirmedStatus').classList.add('hidden');
    document.getElementById('receiptCompletedStatus').classList.add('hidden');
    document.getElementById('receiptCancelledStatus').classList.add('hidden');
    // Reset waiting status elements
    resetWaitingStatus();
}

// Variables for waiting timer
let waitingTimer = null;
let currentBookingData = null;

function startWaitingTimer() {
    // Reset waiting status first
    resetWaitingStatus();
    
    // Show loading animation
    document.getElementById('waitingLoadingAnimation').classList.remove('hidden');
    document.getElementById('waitingActionButtons').classList.add('hidden');
    
    // Start 3-second timer
    waitingTimer = setTimeout(() => {
        // Hide loading animation
        document.getElementById('waitingLoadingAnimation').classList.add('hidden');
        // Show action buttons
        document.getElementById('waitingActionButtons').classList.remove('hidden');
    }, 3000);
}

function resetWaitingStatus() {
    // Clear any existing timer
    clearWaitingTimer();
    
    // Reset waiting status elements to initial state
    document.getElementById('waitingLoadingAnimation').classList.remove('hidden');
    document.getElementById('waitingActionButtons').classList.add('hidden');
}

function clearWaitingTimer() {
    if (waitingTimer) {
        clearTimeout(waitingTimer);
        waitingTimer = null;
    }
}

// Functions for waiting status buttons
window.confirmWaitingBooking = function() {
    // Update status to confirmed
    resetReceiptStatus();
    document.getElementById('receiptConfirmedStatus').classList.remove('hidden');
    
    // You can add additional logic here, like:
    // - Send AJAX request to update booking status
    // - Show success message
    // - Update local data
    
    console.log('Booking confirmed!');
};

window.cancelWaitingBooking = function() {
    // Update status to cancelled
    resetReceiptStatus();
    document.getElementById('receiptCancelledStatus').classList.remove('hidden');
    
    // You can add additional logic here, like:
    // - Send AJAX request to cancel booking
    // - Show cancellation message
    // - Update local data
    
    console.log('Booking cancelled!');
};

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('bookingReceiptModal');
    if (e.target === modal) {
        closeReceiptModal();
    }
});
</script>
