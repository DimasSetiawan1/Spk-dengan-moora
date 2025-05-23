<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash as FacadesHash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.profile.index', [
            'title' => 'Edit Profile',
            'user' => User::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, string $id)
    {
        $rules = [];
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8|confirmed';
        }
        if ($request->name != $user->find($id)->name) {
            $rules['name'] = 'required|string|max:255';
        }
        if ($request->email != $user->find($id)->email) {
            $rules['email'] = 'required|string|min:5|max:255|unique:users';
        }
        $data = $request->validate($rules);
        if ($request->filled('password')) {
            $data['password'] = FacadesHash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->find($id)->update($data);
        return to_route('dashboard')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
