<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Maintenance;
use App\Models\Product;
use App\Models\RentalTransaction;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'vehicles' => Product::count(),
            'brands' => Category::count(),
            'customers' => Customer::count(),
            'bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'active_bookings' => Booking::whereIn('status', ['confirmed', 'ongoing'])->count(),
            'transactions' => RentalTransaction::count(),
            'pending_transactions' => RentalTransaction::where('payment_status', 'pending')->count(),
            'maintenance' => Maintenance::count(),
            'open_maintenance' => Maintenance::whereIn('status', ['pending', 'scheduled', 'in_progress'])->count(),
            'employees' => Employee::count(),
            'revenue' => RentalTransaction::sum('total_amount'),
        ];

        $recentBookings = Booking::with('customer', 'vehicle')
            ->latest()
            ->take(5)
            ->get();

        $recentTransactions = RentalTransaction::with('customer')
            ->latest()
            ->take(5)
            ->get();

        $vehicles = Product::with('category')
            ->latest()
            ->take(8)
            ->get();

        $recentMaintenances = Maintenance::with('vehicle')
            ->latest()
            ->take(5)
            ->get();

        $terms = [
            'All reservations are subject to admin review before final release.',
            'Valid government ID and driver license are required for booking approval.',
            'Payment details must be verified before vehicle release.',
            'Late returns, damages, or missing documents may result in additional charges.',
        ];

        return view('dashboard.index', compact('stats', 'recentBookings', 'recentTransactions', 'recentMaintenances', 'vehicles', 'terms'));
    }
}
