<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get admin dashboard statistics
        $stats = $this->getDashboardStats();
        
        return view('admin.dashboard-admin', compact('stats'));
    }
    
    public function antrian()
    {
        // Get queue data
        $queueData = $this->getQueueData();
        
        return view('admin.antrian', compact('queueData'));
    }
    
    public function layanan()
    {
        // Get services data
        $services = $this->getServicesData();
        
        return view('admin.layanan', compact('services'));
    }
    
    public function galeri()
    {
        // Get gallery data
        $gallery = $this->getGalleryData();
        
        return view('admin.galeri.index', compact('gallery'));
    }
    
    public function montir()
    {
        // Get mechanic data
        $mechanics = $this->getMechanicData();
        
        return view('admin.montir.index', compact('mechanics'));
    }
    
    private function getDashboardStats()
    {
        // Admin dashboard statistics
        return [
            'total_customers' => Pelanggan::count(),
            'active_bookings' => 15,
            'completed_today' => 8,
            'revenue_today' => 2500000,
            'pending_queue' => 5,
            'total_services' => 42,
            'monthly_revenue' => 75000000
        ];
    }
    
    private function getQueueData()
    {
        // Simulated queue data
        return [
            [
                'id' => 'BWK-001',
                'customer_name' => 'John Doe',
                'service' => 'Isi Freon',
                'car' => 'Toyota Avanza',
                'time' => '09:00',
                'status' => 'waiting'
            ],
            [
                'id' => 'BWK-002',
                'customer_name' => 'Jane Smith',
                'service' => 'Ganti Oli',
                'car' => 'Honda Civic',
                'time' => '10:30',
                'status' => 'in_progress'
            ],
            [
                'id' => 'BWK-003',
                'customer_name' => 'Ahmad Santoso',
                'service' => 'Service AC',
                'car' => 'Mazda MX-5',
                'time' => '11:00',
                'status' => 'waiting'
            ]
        ];
    }
    
    private function getServicesData()
    {
        // Simulated services data
        return [
            [
                'name' => 'Isi Freon',
                'price' => 150000,
                'duration' => '30 menit',
                'active' => true
            ],
            [
                'name' => 'Ganti Oli',
                'price' => 100000,
                'duration' => '20 menit',
                'active' => true
            ],
            [
                'name' => 'Service AC',
                'price' => 200000,
                'duration' => '45 menit',
                'active' => true
            ],
            [
                'name' => 'Cuci Evaporator',
                'price' => 120000,
                'duration' => '35 menit',
                'active' => true
            ]
        ];
    }
    
    private function getGalleryData()
    {
        // Simulated gallery data
        return [
            [
                'title' => 'Service AC Mobil',
                'image' => 'images/gallery/service1.jpg',
                'description' => 'Layanan service AC mobil profesional'
            ],
            [
                'title' => 'Isi Freon',
                'image' => 'images/gallery/freon.jpg',
                'description' => 'Pengisian freon dengan kualitas terbaik'
            ]
        ];
    }
    
    private function getMechanicData()
    {
        // Simulated mechanic data
        return [
            [
                'name' => 'Ahmad Montir',
                'specialization' => 'AC Specialist',
                'experience' => '5 tahun',
                'status' => 'available'
            ],
            [
                'name' => 'Budi Teknisi',
                'specialization' => 'Engine Specialist',
                'experience' => '7 tahun',
                'status' => 'busy'
            ]
        ];
    }
}
