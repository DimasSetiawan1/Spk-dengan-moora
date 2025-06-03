<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $suppliers = Supplier::where('nilai', '>', 0)->orderByDesc('nilai')->get();
        $kriteria = $suppliers->first()->kriterias->pluck('name')->toArray();
        $data = [
            'title' => 'Hasil Pemilihan Supplier Terbaik Mengunakan Metode MOORA',
            'suppliers' => $suppliers,
            'kriteria' => $kriteria,
            'date' => date('d F Y')
        ];

        $pdf = Pdf::loadView('pages.pdf.index', $data);

        return $pdf->download('hasil_perhitungan_' . date('d_F_Y') . '.pdf');
    }
}
