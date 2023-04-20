<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Vaksin;
use App\Models\Imunisasi;

class ImunisasiController extends Controller
{
    function index() {
        return view('imunisasi.index', [
            'title' => 'Penimbangan',
            'anaks' => Anak::with('ibu')->get()
        ]);
    }

    function imunisasi($id) {
        return view('imunisasi.imunisasi', [
            'title' => 'Data Imunisasi',
            'vaksins' => Vaksin::all(),
            'anak' => Anak::with(['ibu', 'imunisasi.vaksin'])->where('id', $id)->first()
        ]);
    }

    function store(Request $request, Anak $anak) {
        $validated = $request->validate([
            'tanggal_imunisasi' => 'required',
            'vaksin_id' => 'required',
        ]);

        $validated['anak_id'] = $anak->id;
        $validated['umur'] = abs(round((strtotime($anak->tanggal_lahir ) - strtotime($validated['tanggal_imunisasi'])) / 86400));

        Imunisasi::create($validated);

        return redirect('/imunisasi/' . $anak->id)->with('notif', 'Berhasil Menambah Data.');
    }

    function update(Request $request, Anak $anak) {
        $validated = $request->validate([
            'tanggal_imunisasi' => 'required',
            'vaksin_id' => 'required',
        ]);

        $validated['umur'] = abs(round((strtotime($anak->tanggal_lahir ) - strtotime($validated['tanggal_imunisasi'])) / 86400));

        Imunisasi::where('id', $request->input('id'))->update($validated);

        return redirect('/imunisasi/' . $anak->id)->with('notif', 'Berhasil Mengubah Data.');
    }
}
