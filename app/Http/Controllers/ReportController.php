<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\ParkingArea;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display the report index page.
     */
    public function index()
    {
        $parkingAreas = ParkingArea::all();
        return view('owner.reports.index', compact('parkingAreas'));
    }

    /**
     * Custom date range report.
     */
    public function custom()
    {
        $parkingAreas = ParkingArea::all();
        return view('owner.reports.custom', compact('parkingAreas'));
    }

    /**
     * Generate report based on date range.
     */
    public function generate(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'parking_area_id' => ['nullable', 'exists:parking_areas,id'],
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $query = Transaction::with(['vehicle', 'parkingArea', 'tariff', 'user'])
            ->where('status', 'completed')
            ->whereBetween('entry_time', [$startDate, $endDate]);

        if ($request->parking_area_id) {
            $query->where('parking_area_id', $request->parking_area_id);
        }

        $transactions = $query->get();
        $parkingAreas = ParkingArea::all();

        // Calculate summary
        $totalTransactions = $transactions->count();
        $totalRevenue = $transactions->sum('total_price');
        $averageTransaction = $totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0;

        // Group by parking area
        $byArea = $transactions->groupBy('parking_area_id')->map(function ($group) {
            return [
                'count' => $group->count(),
                'revenue' => $group->sum('total_price'),
            ];
        });

        // Group by date
        $byDate = $transactions->groupBy(function ($item) {
            return Carbon::parse($item->entry_time)->format('Y-m-d');
        })->map(function ($group) {
            return [
                'count' => $group->count(),
                'revenue' => $group->sum('total_price'),
            ];
        })->sortKeys();

        return view('owner.reports.show', compact(
            'transactions',
            'startDate',
            'endDate',
            'totalTransactions',
            'totalRevenue',
            'averageTransaction',
            'byArea',
            'byDate',
            'parkingAreas'
        ));
    }

    /**
     * Daily report.
     */
    public function daily()
    {
        $today = Carbon::today();
        
        $transactions = Transaction::with(['vehicle', 'parkingArea', 'tariff', 'user'])
            ->where('status', 'completed')
            ->whereDate('entry_time', $today)
            ->get();

        $totalTransactions = $transactions->count();
        $totalRevenue = $transactions->sum('total_price');

        return view('owner.reports.daily', compact('transactions', 'totalTransactions', 'totalRevenue', 'today'));
    }

    /**
     * Monthly report.
     */
    public function monthly(Request $request)
    {
        $month = $request->month ?? Carbon::now()->month;
        $year = $request->year ?? Carbon::now()->year;

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = $startDate->endOfMonth();

        $transactions = Transaction::with(['vehicle', 'parkingArea', 'tariff', 'user'])
            ->where('status', 'completed')
            ->whereBetween('entry_time', [$startDate, $endDate])
            ->get();

        $totalTransactions = $transactions->count();
        $totalRevenue = $transactions->sum('total_price');

        // Daily breakdown
        $byDate = $transactions->groupBy(function ($item) {
            return Carbon::parse($item->entry_time)->format('Y-m-d');
        })->map(function ($group) {
            return [
                'count' => $group->count(),
                'revenue' => $group->sum('total_price'),
            ];
        })->sortKeys();

        return view('owner.reports.monthly', compact('transactions', 'totalTransactions', 'totalRevenue', 'startDate', 'byDate', 'month', 'year'));
    }
}
