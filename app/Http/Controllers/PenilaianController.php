<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {

        return view('pages.penilaian.index', [
            'title' => 'Daftar Penilaian',
            'kriterias' => Kriteria::with('subkriterias')->get(),
            'suppliers' => Supplier::whereHas('kriterias')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Subkriteria::exists()) {
            return redirect()->route('penilaian.index')->with('error', 'Tambahkan Subkriteria terlebih dahulu');
        }

        if (!Supplier::whereDoesntHave('kriterias')->exists()) {
            return redirect()->route('penilaian.index');
        }


        return view('pages.penilaian.edit', [
            'title' => 'Tambah Penilaian',
            'add' => true,
            // 'kriterias' => Kriteria::all(),
            'kriterias' => Kriteria::with('subkriterias')->get(),
            'suppliers' => Supplier::whereDoesntHave('kriterias')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'values.*' => ['required'],
        ]);

        $nilaiData = [];
        foreach ($request->values as $kriteriaId => $combinedValue) {
            // Split the combined value
            [$subkriteriaId, $bobot] = explode('_', $combinedValue);

            $nilaiData[$kriteriaId] = [
                'subkriteria_id' => $subkriteriaId,
                'bobot' => $bobot,
            ];
        }

        $supplier = Supplier::find($request->supplier_id);
        $supplier->kriterias()->sync($nilaiData);

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil ditambahkan');
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
    public function edit(Supplier $supplier)
    {
        return view('pages.penilaian.edit', [
            'title' => 'Edit Penilaian',
            // 'penilaian' => $penilaian,
            'supplier' => $supplier,
            'kriterias' => Kriteria::with('subkriterias')->get(),
            'suppliers' => Supplier::with('kriterias')->get(),
            // 'subkriterias' => Subkriteria::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'bobot[*]' => ['required', 'exists:subkriterias,id'],
        ]);
        $nilaiData = [];
        foreach ($request->bobot as $kriteriaId => $subkriteriaId) {
            $nilaiData[$kriteriaId] = ['bobot' => $subkriteriaId];
        }
        $supplier->kriterias()->sync($nilaiData);

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->kriterias()->detach();
        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil dihapus');
    }
}
