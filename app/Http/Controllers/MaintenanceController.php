<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Product;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with('vehicle')->get();
        return view('maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $vehicles = Product::all();
        return view('maintenances.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:retailcosts,id',
            'maintenance_type' => 'required|in:inspection,cleaning,repair,service,other',
            'maintenance_date' => 'required|date',
            'cost' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed'
        ]);

        Maintenance::create($request->all());
        return redirect('/maintenances')->with('success', 'Maintenance recorded successfully!');
    }

    public function edit($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $vehicles = Product::all();
        return view('maintenances.edit', compact('maintenance', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        $request->validate([
            'vehicle_id' => 'required|exists:retailcosts,id',
            'maintenance_type' => 'required|in:inspection,cleaning,repair,service,other',
            'maintenance_date' => 'required|date',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed'
        ]);

        $maintenance->update($request->all());
        return redirect('/maintenances')->with('success', 'Maintenance updated successfully!');
    }

    public function destroy($id)
    {
        Maintenance::findOrFail($id)->delete();
        return redirect('/maintenances')->with('success', 'Maintenance deleted successfully!');
    }
}
