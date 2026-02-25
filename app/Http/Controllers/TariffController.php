<?php

namespace App\Http\Controllers;

use App\Models\Tariff;
use App\Helpers\ActivityLogHelper;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    /**
     * Display a listing of the tariffs.
     */
    public function index()
    {
        $tariffs = Tariff::latest()->paginate(10);
        return view('admin.tariffs.index', compact('tariffs'));
    }

    /**
     * Show the form for creating a new tariff.
     */
    public function create()
    {
        return view('admin.tariffs.create');
    }

    /**
     * Store a newly created tariff in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price_per_hour' => ['required', 'numeric', 'min:0'],
            'price_per_day' => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $tariff = Tariff::create($request->all());

        // Log activity
        ActivityLogHelper::log('create', 'Tariff', $tariff->id, null, $tariff->toArray());

        return redirect()->route('admin.tariffs.index')->with('success', 'Tariff created successfully.');
    }

    /**
     * Display the specified tariff.
     */
    public function show(Tariff $tariff)
    {
        return view('admin.tariffs.show', compact('tariff'));
    }

    /**
     * Show the form for editing the specified tariff.
     */
    public function edit(Tariff $tariff)
    {
        return view('admin.tariffs.edit', compact('tariff'));
    }

    /**
     * Update the specified tariff in storage.
     */
    public function update(Request $request, Tariff $tariff)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price_per_hour' => ['required', 'numeric', 'min:0'],
            'price_per_day' => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $oldValues = $tariff->toArray();
        $tariff->update($request->all());

        // Log activity
        ActivityLogHelper::log('update', 'Tariff', $tariff->id, $oldValues, $tariff->fresh()->toArray());

        return redirect()->route('admin.tariffs.index')->with('success', 'Tariff updated successfully.');
    }

    /**
     * Remove the specified tariff from storage.
     */
    public function destroy(Tariff $tariff)
    {
        $oldValues = $tariff->toArray();
        $tariff->delete();

        // Log activity
        ActivityLogHelper::log('delete', 'Tariff', $tariff->id, $oldValues, null);

        return redirect()->route('admin.tariffs.index')->with('success', 'Tariff deleted successfully.');
    }
}
