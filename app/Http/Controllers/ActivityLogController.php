<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the activity logs.
     */
    public function index()
    {
        $activityLogs = ActivityLog::with('user')
            ->latest()
            ->paginate(20);
        return view('admin.activity-logs.index', compact('activityLogs'));
    }

    /**
     * Display the specified activity log.
     */
    public function show(ActivityLog $activityLog)
    {
        return view('admin.activity-logs.show', compact('activityLog'));
    }

    /**
     * Clear all activity logs (admin only).
     */
    public function clear()
    {
        ActivityLog::truncate();
        return redirect()->route('admin.activity-logs.index')->with('success', 'All activity logs have been cleared.');
    }
}
