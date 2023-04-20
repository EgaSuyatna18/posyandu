<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ibu;

class IbuController extends Controller
{
    function index() {
        return view('ibu.index', [
            'title' => 'Data Ibu',
            'ibus' => Ibu::all()
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'nik' => 'required',
            'nama_istri' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'golongan_darah' => 'required',
            'nama_suami' => 'required'
        ]);

        Ibu::create($validated);

        return redirect('/ibu')->with('notif', 'Berhasil Menambah Data.');
    }

    function destroy(Request $request, $id) {
        Ibu::where('id', $id)->delete();

        return redirect('/ibu')->with('notif', 'Berhasil Menghapus Data.');
    }

    function update(Request $request) {
        $validated = $request->validate([
            'nik' => 'required',
            'nama_istri' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'golongan_darah' => 'required',
            'nama_suami' => 'required'
        ]);

        Ibu::where('id', $request->input('id'))->update($validated);

        return redirect('/ibu')->with('notif', 'Berhasil Mengubah Data.');
    }
}
