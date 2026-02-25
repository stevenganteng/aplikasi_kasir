<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\ParkingArea;
use App\Models\Tariff;
use App\Models\Transaction;
use App\Helpers\ActivityLogHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Show the form for creating a new parking entry.
     */
    public function create()
    {
        $parkingAreas = ParkingArea::where('is_active', true)->where('available_spaces', '>', 0)->get();
        $tariffs = Tariff::where('is_active', true)->get();
        return view('petugas.parking.create', compact('parkingAreas', 'tariffs'));
    }

    /**
     * Store a newly created parking transaction in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => ['required', 'string', 'max:255'],
            'vehicle_type' => ['required', 'in:motor,mobil,truk,sepeda'],
            'parking_area_id' => ['required', 'exists:parking_areas,id'],
            'tariff_id' => ['required', 'exists:tariffs,id'],
        ]);

        // Find or create vehicle
        $vehicle = Vehicle::firstOrCreate(
            ['plate_number' => strtoupper($request->plate_number)],
            [
                'type' => $request->vehicle_type,
            ]
        );

        // Check if vehicle is already parked
        $activeParking = Transaction::where('vehicle_id', $vehicle->id)
            ->where('status', 'parking')
            ->first();

        if ($activeParking) {
            return redirect()->back()->with('error', 'Vehicle is already parked!');
        }

        // Check available spaces
        $parkingArea = ParkingArea::find($request->parking_area_id);
        if ($parkingArea->available_spaces <= 0) {
            return redirect()->back()->with('error', 'Parking area is full!');
        }

        // Generate ticket number with PK prefix
        $ticketNumber = 'PK-' . strtoupper(Str::random(6));

        // Create transaction
        $transaction = Transaction::create([
            'vehicle_id' => $vehicle->id,
            'parking_area_id' => $request->parking_area_id,
            'tariff_id' => $request->tariff_id,
            'user_id' => auth()->id(),
            'ticket_number' => $ticketNumber,
            'entry_time' => Carbon::now(),
            'status' => 'parking',
        ]);

        // Update available spaces
        $parkingArea->decrement('available_spaces');

        // Log activity
        ActivityLogHelper::log('create', 'Parking Entry', $transaction->id, null, $transaction->toArray());

        return redirect()->route('petugas.parking.active')->with('success', 'Parking entry created! Ticket: ' . $ticketNumber);
    }

    /**
     * Get active parkings.
     */
    public function active()
    {
        $transactions = Transaction::with(['vehicle', 'parkingArea', 'tariff'])
            ->where('status', 'parking')
            ->latest()
            ->paginate(10);
        return view('petugas.parking.active', compact('transactions'));
    }

    /**
     * Show the form for exiting parking.
     */
    public function exit(Transaction $transaction)
    {
        $transaction->load(['vehicle', 'parkingArea', 'tariff']);
        
        $entryTime = Carbon::parse($transaction->entry_time);
        $exitTime = Carbon::now();
        
        // Calculate hours parked (minimum 1 hour)
        $hours = $entryTime->diffInMinutes($exitTime);
        $hours = max(1, ceil($hours / 60)); // Round up to nearest hour

        // Calculate duration string
        $duration = '';
        if ($hours >= 24) {
            $days = floor($hours / 24);
            $remainingHours = $hours % 24;
            $duration = $days . ' day(s) ' . $remainingHours . ' hour(s)';
        } else {
            $duration = $hours . ' hour(s)';
        }

        // Calculate total price
        $tariff = $transaction->tariff;
        $totalPrice = $tariff->price_per_hour * $hours;

        // If daily rate applicable (24+ hours)
        if ($hours >= 24 && $tariff->price_per_day) {
            $days = floor($hours / 24);
            $remainingHours = $hours % 24;
            $totalPrice = ($tariff->price_per_day * $days) + ($tariff->price_per_hour * max(1, $remainingHours));
        }

        // Store calculated price in session for processing
        session(['exit_price_' . $transaction->id => $totalPrice]);

        return view('petugas.parking.exit', compact('transaction', 'duration', 'totalPrice'));
    }

    /**
     * Complete the parking transaction (exit).
     */
    public function processExit(Request $request, Transaction $transaction)
    {
        $request->validate([
            'payment_amount' => ['required', 'numeric', 'min:0'],
        ]);

        $exitTime = Carbon::now();
        $entryTime = Carbon::parse($transaction->entry_time);
        
        // Calculate hours parked (minimum 1 hour)
        $hours = $entryTime->diffInMinutes($exitTime);
        $hours = max(1, ceil($hours / 60));

        // Calculate total price
        $tariff = $transaction->tariff;
        $totalPrice = $tariff->price_per_hour * $hours;

        // If daily rate applicable (24+ hours)
        if ($hours >= 24 && $tariff->price_per_day) {
            $days = floor($hours / 24);
            $remainingHours = $hours % 24;
            $totalPrice = ($tariff->price_per_day * $days) + ($tariff->price_per_hour * max(1, $remainingHours));
        }

        $paymentAmount = $request->payment_amount;
        $change = $paymentAmount - $totalPrice;

        if ($change < 0) {
            return redirect()->back()->with('error', 'Insufficient payment amount!');
        }

        $oldValues = $transaction->toArray();
        
        $transaction->update([
            'exit_time' => $exitTime,
            'total_price' => $totalPrice,
            'status' => 'completed',
            'notes' => 'Paid: ' . $paymentAmount . ', Change: ' . $change,
        ]);

        // Update available spaces
        $transaction->parkingArea->increment('available_spaces');

        // Log activity
        ActivityLogHelper::log('update', 'Parking Exit', $transaction->id, $oldValues, $transaction->fresh()->toArray());

        // Redirect to print receipt
        return redirect()->route('petugas.parking.print', ['transaction' => $transaction->id, 'payment' => $paymentAmount, 'change' => $change])
            ->with('success', 'Payment processed successfully!');
    }

    /**
     * Print parking receipt (struk).
     */
    public function print(Request $request, Transaction $transaction)
    {
        $transaction->load(['vehicle', 'parkingArea', 'tariff', 'user']);
        
        $entryTime = Carbon::parse($transaction->entry_time);
        $exitTime = Carbon::parse($transaction->exit_time);
        
        // Calculate duration
        $hours = $entryTime->diffInMinutes($exitTime);
        $hours = max(1, ceil($hours / 60));

        $duration = '';
        if ($hours >= 24) {
            $days = floor($hours / 24);
            $remainingHours = $hours % 24;
            $duration = $days . ' day(s) ' . $remainingHours . ' hour(s)';
        } else {
            $duration = $hours . ' hour(s)';
        }

        $paymentAmount = $request->get('payment', $transaction->total_price);
        $change = $request->get('change', 0);

        return view('petugas.parking.receipt', compact('transaction', 'duration', 'paymentAmount', 'change'));
    }

    /**
     * Get transaction history.
     */
    public function history()
    {
        $transactions = Transaction::with(['vehicle', 'parkingArea', 'tariff', 'user'])
            ->where('status', 'completed')
            ->latest()
            ->paginate(10);
        return view('petugas.parking.history', compact('transactions'));
    }
}
