<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;

class InformasiController extends Controller
{
    function index() {
        return view('informasi.index', [
            'title' => 'Informasi',
            'informasi' => Informasi::first()
        ]);
    }

    function update(Request $request) {
        $validated = $request->validate([
            'judul' => 'required',
            'isi' => 'required'
        ]);

        if($informasi = Informasi::first()){
            $informasi->update($validated);
        }else {
            Informasi::create($validated);
        }

        return redirect('/informasi')->with('notif', 'Informasi Diubah.');
    }

    function info() {
        return view('informasi.info', [
            'title' => 'Informasi',
            'informasi' => Informasi::first()
        ]);
    }
}
