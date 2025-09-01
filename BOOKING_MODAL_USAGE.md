# Booking Receipt Modal Component - Usage Guide

## Overview
The `booking-receipt-modal` component is a reusable modal that displays booking details and receipts across different pages in the user dashboard.

## Installation
1. Include the component in any Blade template:
```blade
<x-user.booking-receipt-modal />
```

## Usage Examples

### 1. Basic Usage - Show Receipt Details
```javascript
// Example data structure
const bookingData = {
    id: 'BWK-2024-001',
    date: '27/08/2024',
    time: '09:00',
    car: 'Toyota Avanza (2018)',
    services: ['Service AC Mobil', 'Isi Freon'],
    address: 'Jl. Contoh No. 123, Jakarta',
    notes: 'AC tidak dingin',
    status: 'confirmed', // 'waiting', 'confirmed', 'completed', 'cancelled'
    pricing: {
        serviceCost: 'Rp 150.000',
        sparepartCost: 'Rp 75.000',
        deliveryCost: 'Rp 25.000',
        totalCost: 'Rp 250.000'
    }
};

// Show the modal
showReceiptModal(bookingData);
```

### 2. History Page Example
```blade
<!-- In history.blade.php -->
<x-user.dashboard-layout>
    <!-- Include the modal component -->
    <x-user.booking-receipt-modal />
    
    <!-- History list -->
    <div class="space-y-4">
        @foreach($bookings as $booking)
        <div class="bg-white border-2 border-[#0F044C] p-4">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="font-medium defparagraf text-[#0F044C]">{{ $booking->id }}</h3>
                    <p class="text-sm defparagraf text-[#787A91]">{{ $booking->date }}</p>
                </div>
                <button onclick="showBookingDetails('{{ $booking->id }}')" 
                        class="px-4 py-2 bg-[#0F044C] text-white hover:bg-[#141E61] transition-colors defparagraf">
                    Detail Struk
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        function showBookingDetails(bookingId) {
            // In real app, fetch data from backend
            const bookingData = {
                id: bookingId,
                date: '27/08/2024',
                time: '09:00',
                car: 'Toyota Avanza (2018)',
                services: ['Service AC Mobil', 'Isi Freon'],
                address: 'Jl. Contoh No. 123, Jakarta',
                notes: 'AC tidak dingin',
                status: 'completed',
                pricing: {
                    serviceCost: 'Rp 150.000',
                    sparepartCost: 'Rp 75.000',
                    deliveryCost: 'Rp 25.000',
                    totalCost: 'Rp 250.000'
                }
            };
            
            showReceiptModal(bookingData);
        }
    </script>
</x-user.dashboard-layout>
```

### 3. Dashboard Page Example
```blade
<!-- In dashboard.blade.php -->
<x-user.dashboard-layout>
    <!-- Include the modal component -->
    <x-user.booking-receipt-modal />
    
    <!-- Recent bookings section -->
    <div class="bg-white border-2 border-[#0F044C] p-6">
        <h2 class="text-lg font-montserrat-alt-48 text-[#0F044C] mb-4">Booking Terbaru</h2>
        
        <div class="space-y-3">
            <div class="flex justify-between items-center p-3 bg-[#EEEEEE] border border-[#787A91]">
                <div>
                    <p class="defparagraf text-[#0F044C] font-medium">BWK-2024-001</p>
                    <p class="text-sm defparagraf text-[#787A91]">Service AC Mobil</p>
                </div>
                <button onclick="showQuickReceipt('BWK-2024-001')" 
                        class="text-sm px-3 py-1 bg-[#0F044C] text-white hover:bg-[#141E61] transition-colors defparagraf">
                    Lihat Detail
                </button>
            </div>
        </div>
    </div>

    <script>
        function showQuickReceipt(bookingId) {
            const bookingData = {
                id: bookingId,
                date: '27/08/2024',
                time: '09:00',
                car: 'Toyota Avanza (2018)',
                services: ['Service AC Mobil'],
                status: 'waiting'
            };
            
            showReceiptModal(bookingData);
        }
    </script>
</x-user.dashboard-layout>
```

## Data Structure

### Required Fields
- `id`: Booking ID string
- `date`: Date string (formatted)
- `time`: Time string
- `car`: Car information string
- `services`: Array of service names
- `status`: Status string ('waiting', 'confirmed', 'completed', 'cancelled')

### Optional Fields
- `address`: Pickup/delivery address string
- `notes`: Additional notes string
- `pricing`: Object with cost breakdown
  - `serviceCost`: Service cost string (e.g., 'Rp 150.000')
  - `sparepartCost`: Sparepart cost string
  - `deliveryCost`: Delivery cost string
  - `totalCost`: Total cost string
- `isNewBooking`: Boolean to show "BOOKING BERHASIL!" title

## Available Functions

### `showReceiptModal(bookingData)`
Shows the modal with provided booking data.

### `closeReceiptModal()`
Closes the modal.

## Status Types
- **waiting**: Shows loading spinner with "Menunggu Konfirmasi Harga"
- **confirmed**: Shows green confirmation message
- **completed**: Shows blue completion message
- **cancelled**: Shows red cancellation message

## Styling
The modal uses the same design system as the rest of the application:
- Primary color: `#0F044C`
- Secondary color: `#141E61`
- Gray color: `#787A91`
- Font class: `defparagraf`
- Header font: `font-montserrat-alt-48`
