<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\AOC;

class AOCController extends Controller
{
    function index() {
        return view('aoc.index', [
            'title' => 'Vitamin A & Obat Cacing',
            'anaks' => Anak::with('ibu')->get()
        ]);
    }

    function aoc($id) {
        return view('aoc.aoc', [
            'title' => 'Data AOC',
            'anak' => Anak::with(['ibu', 'aoc'])->where('id', $id)->first()
        ]);
    }

    function store(Request $request, Anak $anak) {
        $validated = $request->validate([
            'tanggal_pemberian' => 'required',
            'vitamin_a' => 'required',
            'obat_cacing' => 'required'
        ]);

        $validated['anak_id'] = $anak->id;
        $validated['umur'] = abs(round((strtotime($anak->tanggal_lahir ) - strtotime($validated['tanggal_pemberian'])) / 86400));
        $validated['obat_cacing'] = ($validated['obat_cacing'] == 'true') ? true : false ;

        AOC::create($validated);

        return redirect('/aoc/' . $anak->id)->with('notif', 'Berhasil Menambah Data.');
    }

    function update(Request $request, Anak $anak) {
        $validated = $request->validate([
            'tanggal_pemberian' => 'required',
            'vitamin_a' => 'required',
            'obat_cacing' => 'required'
        ]);

        $validated['umur'] = abs(round((strtotime($anak->tanggal_lahir ) - strtotime($validated['tanggal_pemberian'])) / 86400));
        $validated['obat_cacing'] = ($validated['obat_cacing'] == 'true') ? true : false ;

        AOC::where('id', $request->input('id'))->update($validated);

        return redirect('/aoc/' . $anak->id)->with('notif', 'Berhasil Mengubah Data.');
    }
}
