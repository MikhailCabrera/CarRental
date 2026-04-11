<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create(Request $request)
    {
        $today = Carbon::today();
        $defaultPickupDate = old('pickup_date', $today->toDateString());
        $defaultReturnDate = old('return_date', $today->copy()->addDay()->toDateString());

        $vehiclePresets = [
            [
                'type' => 'Sedan',
                'transmission' => 'Automatic',
                'fuel' => 'Electric',
                'seats' => 5,
                'features' => ['Autopilot', 'Premium Sound', 'GPS Navigation', 'Bluetooth'],
                'image' => 'https://images.unsplash.com/photo-1617788138017-80ad40651399?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'type' => 'SUV',
                'transmission' => 'Automatic',
                'fuel' => 'Diesel',
                'seats' => 7,
                'features' => ['4WD', 'Leather Seats', 'Sunroof', 'Bluetooth'],
                'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'type' => 'Sedan',
                'transmission' => 'Automatic',
                'fuel' => 'Hybrid',
                'seats' => 5,
                'features' => ['Fuel Efficient', 'Backup Camera', 'Bluetooth', 'GPS Navigation'],
                'image' => 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'type' => 'Luxury',
                'transmission' => 'Automatic',
                'fuel' => 'Gasoline',
                'seats' => 5,
                'features' => ['Heated Seats', 'Premium Interior', 'Smart Assist', 'Bluetooth'],
                'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'type' => 'Van',
                'transmission' => 'Automatic',
                'fuel' => 'Diesel',
                'seats' => 9,
                'features' => ['Family Ready', 'Large Cargo', 'Air Conditioning', 'Bluetooth'],
                'image' => 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'type' => 'Crossover',
                'transmission' => 'Automatic',
                'fuel' => 'Gasoline',
                'seats' => 5,
                'features' => ['Cruise Control', 'Touchscreen', 'Safety Sensors', 'Bluetooth'],
                'image' => 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=1200&q=80',
            ],
        ];

        $products = Product::with('category')->orderBy('name')->get()->values();
        $selectedId = (int) $request->query('vehicle');
        $selectedIndex = max(0, $products->search(fn ($product) => $product->id === $selectedId));
        if ($selectedIndex === false) {
            $selectedIndex = 0;
        }

        $product = $products[$selectedIndex] ?? null;
        abort_if(!$product, 404);

        $preset = $vehiclePresets[$selectedIndex % count($vehiclePresets)];
        $productName = strtolower($product->name);
        $brandName = strtolower($product->category->category_name ?? '');
        $image = $preset['image'];

        if (str_contains($productName, 'vios') || ($brandName === 'toyota' && str_contains($productName, 'toyota'))) {
            $image = 'https://toyotasantarosa.com.ph/wp-content/uploads/2021/02/vios.png';
        }

        $vehicle = [
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

        return view('reservations.create', compact('vehicle', 'defaultPickupDate', 'defaultReturnDate', 'today'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:retailcosts,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'license_number' => 'required|string|max:255',
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:pickup_date',
            'card_number' => 'required|string|max:30',
            'cardholder_name' => 'required|string|max:255',
            'expiry_date' => 'required|string|max:10',
            'cvv' => 'required|string|max:4',
        ]);

        $vehicle = Product::findOrFail($validated['vehicle_id']);

        $customer = Customer::updateOrCreate(
            ['email' => $validated['email']],
            [
                'name' => trim($validated['first_name'].' '.$validated['last_name']),
                'phone' => $validated['phone_number'],
                'address' => 'N/A',
                'identification_type' => 'Driver License',
                'identification_number' => $validated['license_number'],
            ]
        );

        Booking::create([
            'customer_id' => $customer->id,
            'vehicle_id' => $vehicle->id,
            'start_date' => Carbon::parse($validated['pickup_date'])->startOfDay(),
            'end_date' => Carbon::parse($validated['return_date'])->startOfDay(),
            'status' => 'pending',
            'rental_rate' => $vehicle->retailcost,
        ]);

        return redirect('/bookings')->with('success', 'Booking created successfully from reservation page.');
    }
}
