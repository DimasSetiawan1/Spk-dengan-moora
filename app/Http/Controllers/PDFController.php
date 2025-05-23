<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use Arr;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $suppliers = Supplier::where('nilai', '>', 0)->orderByDesc('nilai')->get();
        $data = [
            'title' => 'Hasil Pemilihan Supplier Terbaik Mengunakan Metode MOORA',
            'suppliers' => $suppliers,
            'date' => date('d F Y')
        ];

        $pdf = Pdf::loadView('pages.pdf.index', $data);

        return $pdf->download('hasil_perhitungan_' . date('d_F_Y') . '.pdf');
    }
}
