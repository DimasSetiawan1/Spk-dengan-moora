<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash as FacadesHash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.settings.users.index', [
            'title' => 'Daftar Pengguna',
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.settings.users.edit', [
            'title' => 'Tambah Pengguna',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email:rfc,dns',
            'role' => 'required|in:admin,user',
            'password' => 'required|min:8',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        $request['password'] = FacadesHash::make($request->password);
        User::create($request->all());

        return to_route('users.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.settings.users.edit', [
            'title' => 'Edit Pengguna',
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email:rfc,dns',
            'password' => 'nullable|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id);
        $data = $request->except('password');

        if ($request->filled('password')) {
            $data['password'] = FacadesHash::make($request->password);
        }

        if ($user->update($data)) {
            return to_route('users.index')->with('success', 'Pengguna berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui pengguna');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {

        if (User::destroy($id)) {
            return to_route('users.index')->with('success', 'Pengguna berhasil dihapus');
        }

        return back()->with('error', 'Gagal menghapus pengguna');
    }
}
