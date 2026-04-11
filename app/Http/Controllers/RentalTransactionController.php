<?php

namespace App\Http\Controllers;

use App\Models\RentalTransaction;
use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;

class RentalTransactionController extends Controller
{
    public function index()
    {
        $transactions = RentalTransaction::with('booking', 'customer')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $bookings = Booking::where('status', '!=', 'cancelled')->get();
        $customers = Customer::all();
        return view('transactions.create', compact('bookings', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'customer_id' => 'required|exists:customers,id',
            'payment_method' => 'required|in:cash,gcash,card',
            'total_amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:pending,completed,cancelled'
        ]);

        RentalTransaction::create($request->all());
        return redirect('/transactions')->with('success', 'Transaction recorded successfully!');
    }

    public function destroy($id)
    {
        RentalTransaction::findOrFail($id)->delete();
        return redirect('/transactions')->with('success', 'Transaction deleted successfully!');
    }
}
