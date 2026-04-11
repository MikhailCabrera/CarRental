<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('customer', 'vehicle')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $customers = Customer::all();
        $vehicles = Product::all();
        return view('bookings.create', compact('customers', 'vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id' => 'required|exists:retailcosts,id',
            'start_date' => 'required|date_format:Y-m-d H:i',
            'end_date' => 'required|date_format:Y-m-d H:i|after:start_date',
            'rental_rate' => 'required|numeric|min:0'
        ]);

        Booking::create($request->all());
        return redirect('/bookings')->with('success', 'Booking created successfully!');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $customers = Customer::all();
        $vehicles = Product::all();
        return view('bookings.edit', compact('booking', 'customers', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id' => 'required|exists:retailcosts,id',
            'start_date' => 'required|date_format:Y-m-d H:i',
            'end_date' => 'required|date_format:Y-m-d H:i|after:start_date',
            'rental_rate' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,ongoing,completed,cancelled'
        ]);

        $booking->update($request->all());
        return redirect('/bookings')->with('success', 'Booking updated successfully!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect('/bookings')->with('success', 'Booking deleted successfully!');
    }
}
