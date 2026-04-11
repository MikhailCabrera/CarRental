<?php

use Illuminate\Support\Facades\Route;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Maintenance;
use App\Models\Product;
use App\Models\RentalTransaction;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RentalTransactionController;
use App\Http\Controllers\MaintenanceController;

Route::get('/', function () {
    $vehiclePresets = [
        [
            'type' => 'Sedan',
            'transmission' => 'Automatic',
            'fuel' => 'Gasoline',
            'seats' => 5,
            'features' => ['Autopilot', 'Premium Sound', 'GPS Navigation'],
            'image' => 'https://images.unsplash.com/photo-1617788138017-80ad40651399?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'type' => 'SUV',
            'transmission' => 'Automatic',
            'fuel' => 'Diesel',
            'seats' => 7,
            'features' => ['4WD', 'Leather Seats'],
            'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'type' => 'Pickup Truck',
            'transmission' => 'Automatic',
            'fuel' => 'Diesel',
            'seats' => 5,
            'features' => ['Family Ready', 'Large Cargo', 'Air Conditioning'],
            'image' => 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=1200&q=80',
        ],
        
    ];

    $vehicles = Product::with('category')
        ->orderBy('name')
        ->get()
        ->values()
        ->map(function ($product, $index) use ($vehiclePresets) {
            $preset = $vehiclePresets[$index % count($vehiclePresets)];
            $productName = strtolower($product->name);
            $brandName = strtolower($product->category->category_name ?? '');

            $image = $preset['image'];
            if (str_contains($productName, 'vios') || ($brandName === 'toyota' && str_contains($productName, 'toyota'))) {
                $image = 'https://toyotasantarosa.com.ph/wp-content/uploads/2021/02/vios.png';
            }

            return [
                'id' => $product->id,
                'name' => $product->name,
                'brand' => $product->category->category_name ?? 'Premium Fleet',
                'price' => $product->retailcost,
                'type' => $preset['type'],
                'transmission' => $preset['transmission'],
                'fuel' => $preset['fuel'],
                'seats' => $preset['seats'],
                'features' => $preset['features'],
                'image' => $image,
            ];
        });

    $stats = [
        'vehicles' => Product::count(),
        'brands' => Category::count(),
        'customers' => Customer::count(),
        'bookings' => Booking::count(),
        'transactions' => RentalTransaction::count(),
        'maintenance' => Maintenance::count(),
        'employees' => Employee::count(),
        'revenue' => RentalTransaction::sum('total_amount'),
    ];

    return view('welcome', compact('stats', 'vehicles'));
});

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/reservation', [ReservationController::class, 'create']);
Route::post('/reservation', [ReservationController::class, 'store']);

Route::get('/rental-costs', [ProductController::class, 'index']);
Route::post('/rental-costs', [ProductController::class, 'store']);
Route::get('/rental-costs/{id}/edit', [ProductController::class, 'edit']);
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

Route::put('/rental-costs/{id}', [ProductController::class, 'update']);
Route::delete('/rental-costs/{id}', [ProductController::class, 'destroy']);

Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

Route::get('/employee', [EmployeeController::class, 'index']);
Route::post('/employee', [EmployeeController::class, 'store']);

// Customer Routes
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/create', [CustomerController::class, 'create']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::get('/customers/{id}/edit', [CustomerController::class, 'edit']);
Route::put('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

// Booking Routes
Route::get('/bookings', [BookingController::class, 'index']);
Route::get('/bookings/create', [BookingController::class, 'create']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings/{id}/edit', [BookingController::class, 'edit']);
Route::put('/bookings/{id}', [BookingController::class, 'update']);
Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);

// Transaction Routes
Route::get('/transactions', [RentalTransactionController::class, 'index']);
Route::get('/transactions/create', [RentalTransactionController::class, 'create']);
Route::post('/transactions', [RentalTransactionController::class, 'store']);
Route::delete('/transactions/{id}', [RentalTransactionController::class, 'destroy']);

// Maintenance Routes
Route::get('/maintenances', [MaintenanceController::class, 'index']);
Route::get('/maintenances/create', [MaintenanceController::class, 'create']);
Route::post('/maintenances', [MaintenanceController::class, 'store']);
Route::get('/maintenances/{id}/edit', [MaintenanceController::class, 'edit']);
Route::put('/maintenances/{id}', [MaintenanceController::class, 'update']);
Route::delete('/maintenances/{id}', [MaintenanceController::class, 'destroy']);
