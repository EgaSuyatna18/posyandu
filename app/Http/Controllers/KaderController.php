<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kader;

class KaderController extends Controller
{
    function index() {
        return view('kader.index', [
            'title' => 'Data Kader',
            'kaders' => Kader::all()
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'nama_kader' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required'
        ]);

        Kader::createID($validated);

        return redirect('/kader')->with('notif', 'Berhasil Menambah Data.');
    }

    function destroy(Request $request, $id) {
        Kader::where('id', $id)->delete();

        return redirect('/kader')->with('notif', 'Berhasil Menghapus Data.');
    }

    function update(Request $request) {
        $validated = $request->validate([
            'nama_kader' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required'
        ]);

        Kader::where('id', $request->input('id'))->update($validated);

        return redirect('/kader')->with('notif', 'Berhasil Mengubah Data.');
    }
}
