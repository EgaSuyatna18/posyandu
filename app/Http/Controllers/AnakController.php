<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Ibu;

class AnakController extends Controller
{
    function index() {
        return view('anak.index', [
            'title' => 'Data Anak',
            'ibus' => Ibu::all(),
            'anaks' => Anak::with('ibu')->get()
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'ibu_id' => 'required',
            'nik' => 'required',
            'nama_anak' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'bb' => 'required',
            'pb' => 'required',
        ]);

        Anak::createID($validated);

        return redirect('/anak')->with('notif', 'Berhasil Menambah Data.');
    }

    function destroy(Request $request, $id) {
        Anak::where('id', $id)->delete();

        return redirect('/anak')->with('notif', 'Berhasil Menghapus Data.');
    }

    function update(Request $request) {
        $validated = $request->validate([
            'ibu_id' => 'required',
            'nik' => 'required',
            'nama_anak' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'bb' => 'required',
            'pb' => 'required',
        ]);

        Anak::where('id', $request->input('id'))->update($validated);

        return redirect('/anak')->with('notif', 'Berhasil Mengubah Data.');
    }
}
