<?php

namespace App\Http\Controllers;

use App\Models\DataCamera;
use App\Models\DataVendor;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalVendors = DataVendor::count();
        $totalCameras = DataCamera::count();
        $camerasOnline = DataCamera::whereNotNull('last_on')->count();
        $camerasOffline = $totalCameras - $camerasOnline;

        $latestCameras = DataCamera::with('vendor')
            ->latest()
            ->take(5)
            ->get();

        $vendors = DataVendor::withCount('cameras')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalVendors',
            'totalCameras',
            'camerasOnline',
            'camerasOffline',
            'latestCameras',
            'vendors'
        ));
    }
}
