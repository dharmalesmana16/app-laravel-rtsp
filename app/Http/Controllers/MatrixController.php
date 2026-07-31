<?php

namespace App\Http\Controllers;

use App\Models\DataCamera;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class MatrixController extends Controller
{
    public function index(): View
    {
        return view('matrix.index', ['groups' => $this->groups()]);
    }

    public function items(): View
    {
        return view('matrix._items', ['groups' => $this->groups()]);
    }

    private function groups(): Collection
    {
        $cameras = DataCamera::with('vendor')
            ->orderBy('vendor_id')
            ->orderBy('id')
            ->get();

        return $cameras->groupBy(fn (DataCamera $c) => $c->vendor->nama_perusahaan ?? 'Tanpa Vendor');
    }
}
