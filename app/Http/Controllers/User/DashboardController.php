<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get current queue/booking data (simulated for now)
        $currentBooking = $this->getCurrentBooking($user);
        
        // Get activity summary
        $activitySummary = $this->getActivitySummary($user);
        
        // Get user's cars
        $userCars = $this->getUserCars($user);
        
        return view('user.dashboard', compact('currentBooking', 'activitySummary', 'userCars'));
    }
    
    private function getCurrentBooking($user)
    {
        // Simulated current booking data
        // In real implementation, this would come from a bookings table
        return [
            'id' => 'BWK-2024-001',
            'service_name' => 'Isi Freon',
            'service_date' => '11 September 2025',
            'car_name' => 'Mazda MX-5 Miata Na',
            'price' => 'Rp 150.000',
            'time_slot' => '09:15 - •••',
            'status' => 'Sedang Berlangsung',
            'notes' => 'AC tidak dingin, perlu pengecekan sistem pendingin',
            'pricing' => [
                'service_cost' => 'Rp 100.000',
                'sparepart_cost' => 'Rp 50.000',
                'delivery_cost' => 'Rp 0',
                'total_cost' => 'Rp 150.000'
            ]
        ];
    }
    
    private function getActivitySummary($user)
    {
        // Simulated activity data based on user
        // In real implementation, this would aggregate from bookings/services table
        $totalServices = $this->calculateTotalServices($user);
        $totalSpent = $this->calculateTotalSpent($user);
        
        return [
            'total_services' => $totalServices,
            'total_spent' => $totalSpent,
            'formatted_spent' => $this->formatCurrency($totalSpent)
        ];
    }
    
    private function calculateTotalServices($user)
    {
        // Simulated calculation based on user data
        // You can use user ID or other attributes to vary the data
        $baseServices = 8;
        $userFactor = ($user->id_pelanggan % 5) + 1; // Varies between 1-5
        return $baseServices + $userFactor;
    }
    
    private function calculateTotalSpent($user)
    {
        // Simulated calculation based on user data
        $baseAmount = 1500000; // 1.5M
        $userFactor = ($user->id_pelanggan % 10) + 1; // Varies between 1-10
        return $baseAmount + ($userFactor * 100000); // Adds 100k-1M
    }
    
    private function formatCurrency($amount)
    {
        if ($amount >= 1000000) {
            return number_format($amount / 1000000, 1) . 'Jt';
        } elseif ($amount >= 1000) {
            return number_format($amount / 1000, 0) . 'K';
        }
        return number_format($amount, 0);
    }
    
    private function getUserCars($user)
    {
        // Simulated user cars data
        // In real implementation, this would come from a user_cars table
        $carTemplates = [
            [
                'name' => 'Mazda MX-5 Miata Na',
                'year' => '2020',
                'fuel_type' => 'Bensin',
                'last_service' => '2 bulan lalu'
            ],
            [
                'name' => 'Toyota Avanza',
                'year' => '2018',
                'fuel_type' => 'Bensin',
                'last_service' => '1 bulan lalu'
            ],
            [
                'name' => 'Honda Civic',
                'year' => '2019',
                'fuel_type' => 'Bensin',
                'last_service' => '3 bulan lalu'
            ],
            [
                'name' => 'Suzuki Ertiga',
                'year' => '2021',
                'fuel_type' => 'Bensin',
                'last_service' => '1 minggu lalu'
            ]
        ];
        
        // Return different number of cars based on user ID
        $numCars = ($user->id_pelanggan % 3) + 1; // 1-3 cars per user
        return array_slice($carTemplates, 0, $numCars);
    }
}