<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ibu;
use Illuminate\Support\Facades\Hash;
use Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index', [
            'title' => 'User',
            'users' => User::all()
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
        $validated = $request->validate([
            'foto' => 'required|max:3000|mimes:png,jpg,jpeg',
            'role' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $validated['foto'] = $request->file('foto')->store('foto');
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect('/user')->with('notif', 'Berhasil Menambah Data.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'role' => 'required',
            'name' => 'required',
            'email' => 'required',
        ];

        if($request->input('password')) {
            $rules['password'] = 'required';
        }

        if($request->hasFile('foto')) {
            $rules['foto'] = 'required|max:3000|mimes:png,jpg,jpeg';
        }

        $validated = $request->validate($rules);

        if($request->input('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        if($request->hasFile('foto')) {
            Storage::delete($user->foto);
            $validated['foto'] = $request->file('foto')->store('foto');
        }

        User::where('id', $user->id)->update($validated);

        return redirect('/user')->with('notif', 'Berhasil Mengubah Data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Storage::delete($user->foto);
        $user->delete();

        return redirect('/user')->with('notif', 'Berhasil Menghapus Data.');
    }

    function loginOrangTua() {
        return view('auth.login_orang_tua', ['title' => 'Login Orang Tua']);
    }

    function loginOrangTuaTry(Request $request) {
        $validated = $request->validate([
            'nama_istri' => 'required',
            'nik' => 'required'
        ]);
        $ibu = Ibu::with('anak')->where('nama_istri', $validated['nama_istri'])->where('nik', $validated['nik'])->first();

        if(!$ibu) {
            return redirect('/login/orangtua')->withErrors(['login' => 'Credentials not match our record']);
        }

        session()->put('ibu', $ibu);

        return view('informasi.info', ['title' => 'Informasi']);
    }
}
