<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http\Models\User;


class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('admin.siswa.index');
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function storeAdmin(Request $request)
    {       
        $validated = $request->validated([
                'username' => 'required|unique,username',
                'email' => 'required|unique,users,email',
                'password' => 'required|min:6|confirmed',
        ]);

        User::create([
             'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'admin',
                'nisn' => null,
                'kelas'=> null,
        ]);

        return redirect()->route('users.index')->with('Admin berhasil ditambahkan');
    }

    public function storeSiswa(Request $request)
    {
        $validated = $request->validated([
            'username' => 'required|unique,username',
            'email' => 'required|unique,users,email',
            'password' => 'required|min:6|confirmed',
            'nisn' => 'required|unique:users,nisn',
            'kelas' => 'required',
        ]);

        User::create([
             'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'admin',
                'nisn' => $validated['nisn'],
                'kelas'=> $validated['kelas'],
        ]);
    }

    public function show(User $users)
    {
        return view('admin.siswa.show',compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.siswa.edit',compact('users'));
    }

    public function update(Request $request)
    {
        $validated = $request->validated([
            'username' => 'required|unique,username'. $user->id,
            'email' => 'required|unique,users,email'. $user->id,
            'role' => 'required|in:admin,siswa',
            'password' => 'nullable|min:6|confirmed',
            'nisn' => 'nullable|unique:users,nisn'. $user->id,
            'kelas' => 'nullable',
        ]);

        if(!empty($validated['passowrd'])){
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if($validated['role'] === 'admin'){
            $validated['nisn'] = null;
            $validated['kelas'] = null;
        }

        $user->update($validated);
        return redirect()->route('siswa.index')->with("success, User berhasil diupdated");
    }

    public function destroy()
    {
        $user->delete();
        return redirect()->route('users.index')->with('success, User berhasil dihapus');
    }
}
