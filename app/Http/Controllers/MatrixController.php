<?php

namespace App\Http\Controllers;

use App\Models\DataCamera;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MatrixController extends Controller
{
    public function index(Request $request): View
    {
        $cameras = DataCamera::with('vendor')
            ->orderBy('vendor_id')
            ->orderBy('id')
            ->get();

        $groups = $cameras->groupBy(function ($camera) {
            return $camera->vendor->nama_perusahaan ?? 'Tanpa Vendor';
        });

        return view('matrix.index', ['groups' => $groups]);
    }
}
