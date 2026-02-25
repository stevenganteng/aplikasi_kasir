<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Helpers\ActivityLogHelper;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the vehicles.
     */
    public function index()
    {
        $vehicles = Vehicle::latest()->paginate(10);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new vehicle.
     */
    public function create()
    {
        return view('admin.vehicles.create');
    }

    /**
     * Store a newly created vehicle in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => ['required', 'string', 'max:255', 'unique:vehicles'],
            'type' => ['required', 'in:motor,mobil,truk,sepeda'],
            'brand' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'owner_name' => ['nullable', 'string', 'max:255'],
            'owner_phone' => ['nullable', 'string', 'max:255'],
        ]);

        $vehicle = Vehicle::create($request->all());

        // Log activity
        ActivityLogHelper::log('create', 'Vehicle', $vehicle->id, null, $vehicle->toArray());

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the specified vehicle.
     */
    public function show(Vehicle $vehicle)
    {
        return view('admin.vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'plate_number' => ['required', 'string', 'max:255', 'unique:vehicles,plate_number,' . $vehicle->id],
            'type' => ['required', 'in:motor,mobil,truk,sepeda'],
            'brand' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'owner_name' => ['nullable', 'string', 'max:255'],
            'owner_phone' => ['nullable', 'string', 'max:255'],
        ]);

        $oldValues = $vehicle->toArray();
        $vehicle->update($request->all());

        // Log activity
        ActivityLogHelper::log('update', 'Vehicle', $vehicle->id, $oldValues, $vehicle->fresh()->toArray());

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $oldValues = $vehicle->toArray();
        $vehicle->delete();

        // Log activity
        ActivityLogHelper::log('delete', 'Vehicle', $vehicle->id, $oldValues, null);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}
