<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Penimbangan;
use App\Models\Ibu;

class PenimbanganController extends Controller
{
    function index() {
        return view('penimbangan.index', [
            'title' => 'Penimbangan',
            'anaks' => Anak::with('ibu')->get()
        ]);
    }

    function penimbangan($id) {
        return view('penimbangan.penimbangan', [
            'title' => 'Data Penimbangan',
            'anak' => Anak::with(['ibu', 'penimbangan'])->where('id', $id)->first()
        ]);
    }

    function store(Request $request, Anak $anak) {
        $validated = $request->validate([
            'tanggal_timbang' => 'required',
            'bb' => 'required',
            'pb' => 'required',
            'lk' => 'required'
        ]);

        $validated['anak_id'] = $anak->id;
        $validated['umur'] = abs(round((strtotime($anak->tanggal_lahir ) - strtotime($validated['tanggal_timbang'])) / 86400));
        $validated['bulan'] = Penimbangan::select('bulan')->where('anak_id', $anak->id)->max('bulan') + 1;

        Penimbangan::create($validated);

        return redirect('/penimbangan/' . $anak->id)->with('notif', 'Berhasil Menambah Data.');
    }

    function update(Request $request, Anak $anak) {
        $validated = $request->validate([
            'tanggal_timbang' => 'required',
            'bb' => 'required',
            'pb' => 'required',
            'lk' => 'required'
        ]);

        $validated['umur'] = abs(round((strtotime($anak->tanggal_lahir ) - strtotime($validated['tanggal_timbang'])) / 86400));

        Penimbangan::where('id', $request->input('id'))->update($validated);

        return redirect('/penimbangan/' . $anak->id)->with('notif', 'Berhasil Mengubah Data.');
    }

    function hasil() {
        return view('penimbangan.hasil', [
            'title' => 'Hasil Penimbangan'
        ]);
    }

    function hasilPost(Request $request) {
        $validated = $request->validate(['nik' => 'required']);
        return view('penimbangan.hasil2', [
            'title' => 'Data Penimbangan',
            'anak' => Anak::with('penimbangan')->where('nik', $validated['nik'])->first()
        ]);
    }
}
