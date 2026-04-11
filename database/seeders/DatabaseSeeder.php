<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Booking;
use App\Models\RentalTransaction;
use App\Models\Maintenance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed categories (brands)
        $toyota = Category::create(['category_name' => 'Toyota']);
        $honda = Category::create(['category_name' => 'Honda']);
        $mitsubishi = Category::create(['category_name' => 'Mitsubishi']);

        // Seed vehicles/products
        $v1 = Product::create([
            'name' => 'Toyota Vios',
            'retailcost' => 1500.00,
            'category_id' => $toyota->id
        ]);

        $v2 = Product::create([
            'name' => 'Honda City',
            'retailcost' => 1800.00,
            'category_id' => $honda->id
        ]);

        $v3 = Product::create([
            'name' => 'Mitsubishi Mirage',
            'retailcost' => 1200.00,
            'category_id' => $mitsubishi->id
        ]);

        // Seed customers
        $c1 = Customer::create([
            'name' => 'Juan Dela Cruz',
            'email' => 'juan@example.com',
            'phone' => '09123456789',
            'address' => '123 Main St, Manila',
            'identification_type' => 'Driver License',
            'identification_number' => 'DL-2024-001'
        ]);

        $c2 = Customer::create([
            'name' => 'Maria Santos',
            'email' => 'maria@example.com',
            'phone' => '09234567890',
            'address' => '456 Oak Ave, Quezon City',
            'identification_type' => 'Passport',
            'identification_number' => 'PA-2024-002'
        ]);

        $c3 = Customer::create([
            'name' => 'Pedro Reyes',
            'email' => 'pedro@example.com',
            'phone' => '09345678901',
            'address' => '789 Pine Rd, Makati',
            'identification_type' => 'Driver License',
            'identification_number' => 'DL-2024-003'
        ]);

        // Seed bookings
        $b1 = Booking::create([
            'customer_id' => $c1->id,
            'vehicle_id' => $v1->id,
            'start_date' => now()->addDay(),
            'end_date' => now()->addDays(3),
            'status' => 'confirmed',
            'rental_rate' => 1500.00
        ]);

        $b2 = Booking::create([
            'customer_id' => $c2->id,
            'vehicle_id' => $v2->id,
            'start_date' => now()->addDays(5),
            'end_date' => now()->addDays(7),
            'status' => 'pending',
            'rental_rate' => 1800.00
        ]);

        // Seed transactions
        RentalTransaction::create([
            'booking_id' => $b1->id,
            'customer_id' => $c1->id,
            'payment_method' => 'cash',
            'total_amount' => 4500.00,
            'payment_status' => 'completed',
            'paid_at' => now()
        ]);

        // Seed maintenance records
        Maintenance::create([
            'vehicle_id' => $v1->id,
            'maintenance_type' => 'inspection',
            'maintenance_date' => now()->subDay(),
            'cost' => 500.00,
            'description' => 'Vehicle inspection and basic maintenance',
            'status' => 'completed'
        ]);

        Maintenance::create([
            'vehicle_id' => $v2->id,
            'maintenance_type' => 'cleaning',
            'maintenance_date' => now(),
            'cost' => 300.00,
            'description' => 'Interior and exterior cleaning',
            'status' => 'completed'
        ]);
    }
}
