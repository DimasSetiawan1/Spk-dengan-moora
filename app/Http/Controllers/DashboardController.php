<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'supplier' => Supplier::count(),
            'kriteria' => Kriteria::count(),
            'subkriteria' => Subkriteria::count(),
            'suppliers' => Supplier::all()
        ]);
    }
}
