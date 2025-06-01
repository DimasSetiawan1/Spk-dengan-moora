<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Http\Requests\StoreKriteriaRequest;
use App\Http\Requests\UpdateKriteriaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Kriteria $kriteria)
    {
        return view('pages.kriteria.index', [
            'title' => 'Daftar Kriteria',
            'kriterias' => $kriteria->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * intinya buat arahin ke view create
     */
    public function create(Kriteria $kriteria)
    {

        return view('pages.kriteria.edit', [
            'title' => 'Tambah Kriteria',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKriteriaRequest $request, Kriteria $kriteria)
    {

        $validated = $request->validated();
        Kriteria::create($validated);
        return to_route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     * intinya buat arahin ke view show
     */
    public function show(Kriteria $kriteria) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriterium)
    {
        return view('pages.kriteria.edit', [
            'title' => 'Edit Kriteria',
            'kriteria' => $kriterium
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriterium)
    {
        $rules = [
            'bobot' => 'required|decimal:1,2',
            'keterangan' => 'required',
        ];
        if ($request->name != $kriterium->name) {
            $rules['name'] = 'required|unique:kriterias';
        }

        $validated = $request->validate($rules);
        $kriterium->where('id', $kriterium->id)->update($validated);
        return to_route('kriteria.index')->with('success', 'Kriteria berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriterium)
    {
        $kriterium->delete();
        return to_route('kriteria.index')->with('success', 'Kriteria berhasil dihapus');
    }
}
