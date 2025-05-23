<?php

namespace App\Http\Controllers;

use App\Models\Subkriteria;
use App\Http\Requests\StoreSubkriteriaRequest;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Subkriteria $subkriterium)
    {
        // dd($subkriterium->all());
        return view('pages.subkriteria.index', [
            'title' => 'Daftar Subkriteria',
            'subkriterias' => $subkriterium->with('kriteria')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Kriteria::exists()) {
            return redirect()->route('subkriteria.index')->with('error', 'Tambahkan Kriteria terlebih dahulu');
        }
        return view('pages.subkriteria.edit', [
            'title' => 'Tambah Subkriteria',
            'kriterias' =>  Kriteria::select('id', 'name', 'code')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:subkriterias',
            'bobot' => 'required|integer|between:1,4',
            'kriteria_id' => 'required|exists:kriterias,id'
        ]);
        Subkriteria::create($validated);
        return to_route('subkriteria.index')->with('success', 'Subkriteria berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subkriteria $subkriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subkriteria $subkriterium)
    {

        return view('pages.subkriteria.edit', [
            'title' => 'Edit Subkriteria',
            'subkriteria' => $subkriterium,
            'kriterias' =>  Kriteria::where('id', '!=', $subkriterium->kriteria_id)->select('id', 'name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subkriteria $subkriterium)
    {

        $rules = [
            'bobot' => 'required|integer:1,4',
        ];
        if ($request->name != $subkriterium->name || $request->kriteria_id != $subkriterium->kriteria_id) {
            $rules['name'] = 'required|unique:kriterias';
            $rules['kriteria_id'] = 'required|exists:kriterias,id';
        }

        $validated = $request->validate($rules);
        $subkriterium->where('id', $subkriterium->id)->update($validated);
        return redirect()->route('subkriteria.index')->with('success', 'Subkriteria berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subkriteria $subkriterium)
    {

        $subkriterium->delete();
        return to_route('subkriteria.index')->with('success', 'Subkriteria berhasil dihapus');
    }
}
