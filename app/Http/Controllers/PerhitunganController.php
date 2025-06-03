<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Mockery\Undefined;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** SPK DENGAN MOORA */
        $kriterias = Kriteria::all();
        $suppliers = Supplier::orderBy('code')->whereHas('kriterias')->get();
        $matriks = [];

        /** MATRIKS KEPUTUSAN */
        foreach ($suppliers as $column => $supplier) {
            foreach ($supplier->kriterias as $baris => $kriteria) {
                $matriks[$baris][$column] = $kriteria->pivot->bobot;
            }
        }



        /** MATRIKS NORMALISASI */
        $normalisasi = [];
        foreach ($matriks as $row => $data) {
            $sum = 0;
            foreach ($data as $col => $value) {
                $sum += pow($value, 2);
            }
            $sum = sqrt($sum);

            foreach ($data as $col => $value) {
                $normalisasi[$row][] = $value / $sum;
            }
        }



        /** MATRIKS NORMALISASI BOBOT */
        $optimasiAttribute = [];
        foreach ($normalisasi as $row => $values) {
            $kriteria = $kriterias[$row];
            foreach ($values as $key => $value) {
                $optimasiAttribute[$row][] = $value * $kriteria->bobot;
            }
        }


        /** MATRIKS PERANGKINGAN */

        $minmax = [];
        foreach ($suppliers as $supplierIndex => $supplier) {
            $min = 0;
            $max = 0;

            foreach ($kriterias as $kriteriaIndex => $kriteria) {
                $value = $optimasiAttribute[$kriteriaIndex][$supplierIndex];
                if ($kriteria->keterangan) {
                    $max += $value;
                } else {
                    $min += $value;
                }
            }

            $yi = $max - $min;
            $minmax[$supplier->id] = $yi;
        }

        $nilai = [];
        foreach ($suppliers as $supplier) {
            $nilai[$supplier->id] = round($minmax[$supplier->id], 4);
        }
        foreach ($nilai as $supplierId => $value) {
            $supplier = $supplier->find($supplierId);
            if ($supplier) {
                $supplier->update(['nilai' => $value]);
            }
        }
        return view('pages.perhitungan.index', [
            'title' => 'Perhitungan',
            'suppliers' => $suppliers,
            'kriterias' => $kriterias,
            'matriks_keputusan' => $matriks,
            'matriks_normalisasi' => $normalisasi,
            'nilais' => $nilai,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
