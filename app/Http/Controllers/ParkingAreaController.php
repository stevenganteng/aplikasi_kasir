<?php

namespace App\Http\Controllers;

use App\Models\ParkingArea;
use App\Helpers\ActivityLogHelper;
use Illuminate\Http\Request;

class ParkingAreaController extends Controller
{
    /**
     * Display a listing of the parking areas.
     */
    public function index()
    {
        $parkingAreas = ParkingArea::latest()->paginate(10);
        return view('admin.parking-areas.index', compact('parkingAreas'));
    }

    /**
     * Show the form for creating a new parking area.
     */
    public function create()
    {
        return view('admin.parking-areas.create');
    }

    /**
     * Store a newly created parking area in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:parking_areas'],
            'capacity' => ['required', 'integer', 'min:1'],
            'location' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $data = $request->all();
        $data['available_spaces'] = $request->capacity;

        $parkingArea = ParkingArea::create($data);

        // Log activity
        ActivityLogHelper::log('create', 'Parking Area', $parkingArea->id, null, $parkingArea->toArray());

        return redirect()->route('admin.parking-areas.index')->with('success', 'Parking area created successfully.');
    }

    /**
     * Display the specified parking area.
     */
    public function show(ParkingArea $parkingArea)
    {
        return view('admin.parking-areas.show', compact('parkingArea'));
    }

    /**
     * Show the form for editing the specified parking area.
     */
    public function edit(ParkingArea $parkingArea)
    {
        return view('admin.parking-areas.edit', compact('parkingArea'));
    }

    /**
     * Update the specified parking area in storage.
     */
    public function update(Request $request, ParkingArea $parkingArea)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:parking_areas,code,' . $parkingArea->id],
            'capacity' => ['required', 'integer', 'min:1'],
            'location' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $oldValues = $parkingArea->toArray();
        $data = $request->all();
        
        // Recalculate available spaces if capacity changed
        $occupiedSpaces = $parkingArea->transactions()->where('status', 'parking')->count();
        $data['available_spaces'] = $data['capacity'] - $occupiedSpaces;

        $parkingArea->update($data);

        // Log activity
        ActivityLogHelper::log('update', 'Parking Area', $parkingArea->id, $oldValues, $parkingArea->fresh()->toArray());

        return redirect()->route('admin.parking-areas.index')->with('success', 'Parking area updated successfully.');
    }

    /**
     * Remove the specified parking area from storage.
     */
    public function destroy(ParkingArea $parkingArea)
    {
        $oldValues = $parkingArea->toArray();
        $parkingArea->delete();

        // Log activity
        ActivityLogHelper::log('delete', 'Parking Area', $parkingArea->id, $oldValues, null);

        return redirect()->route('admin.parking-areas.index')->with('success', 'Parking area deleted successfully.');
    }
}
