<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data log diurutkan dari yang terbaru dengan pagination
        $logs = ActivityLog::orderBy('id', 'desc')->paginate(10);

        return view('admin_logs', compact('logs'));
    }
}