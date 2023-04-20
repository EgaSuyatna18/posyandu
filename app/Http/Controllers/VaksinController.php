<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaksin;

class VaksinController extends Controller
{
    function index() {
        return view('vaksin.index', [
            'title' => 'Data Vaksin',
            'vaksins' => Vaksin::all()
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'nama_vaksin' => 'required',
        ]);

        Vaksin::create($validated);

        return redirect('/vaksin')->with('notif', 'Berhasil Menambah Data.');
    }

    function destroy(Request $request, $id) {
        Vaksin::where('id', $id)->delete();

        return redirect('/vaksin')->with('notif', 'Berhasil Menghapus Data.');
    }

    function update(Request $request) {
        $validated = $request->validate([
            'nama_vaksin' => 'required',
        ]);

        Vaksin::where('id', $request->input('id'))->update($validated);

        return redirect('/vaksin')->with('notif', 'Berhasil Mengubah Data.');
    }
}
