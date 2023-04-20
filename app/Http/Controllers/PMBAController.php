<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\PMBA;

class PMBAController extends Controller
{
    function index() {
        return view('pmba.index', [
            'title' => 'Pemberian Makan Bagi Anak',
            'anaks' => Anak::with('ibu')->get()
        ]);
    }

    function pmba($id) {
        return view('pmba.pmba', [
            'title' => 'Data PMBA',
            'anak' => Anak::with(['ibu', 'pmba'])->where('id', $id)->first()
        ]);
    }

    function store(Request $request, Anak $anak) {
        $validated = $request->validate([
            'tanggal' => 'required',
            'nasihat' => 'required',
        ]);

        $validated['anak_id'] = $anak->id;
        $validated['umur'] = abs(round((strtotime($anak->tanggal_lahir ) - strtotime($validated['tanggal'])) / 86400));

        PMBA::create($validated);

        return redirect('/pmba/' . $anak->id)->with('notif', 'Berhasil Menambah Data.');
    }

    function update(Request $request, Anak $anak) {
        $validated = $request->validate([
            'tanggal' => 'required',
            'nasihat' => 'required',
        ]);

        $validated['umur'] = abs(round((strtotime($anak->tanggal_lahir ) - strtotime($validated['tanggal'])) / 86400));

        PMBA::where('id', $request->input('id'))->update($validated);

        return redirect('/pmba/' . $anak->id)->with('notif', 'Berhasil Mengubah Data.');
    }
}
