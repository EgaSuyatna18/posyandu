<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kader;
use App\Models\Penyuluhan;
use Storage;

class PenyuluhanController extends Controller
{
    function index() {
        return view('penyuluhan.index', [
            'title' => 'Penyuluhan',
            'kaders' => Kader::all(),
            'penyuluhans' => Penyuluhan::with('kader')->get()
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'kader_id' => 'required',
            'tanggal_penyuluhan' => 'required',
            'materi' => 'required',
            'media' => 'required',
            'dokumentasi' => 'required|max:10000|mimes:doc,docx,pdf'
        ]);

        $validated['dokumentasi'] = $request->file('dokumentasi')->store('dokumentasi');

        Penyuluhan::create($validated);

        return redirect('/penyuluhan')->with('notif', 'Berhasil Menambah Data.');
    }

    function destroy(Request $request, Penyuluhan $penyuluhan) {
        Storage::delete($penyuluhan->dokumentasi);

        $penyuluhan->delete();

        return redirect('/penyuluhan')->with('notif', 'Berhasil Menghapus Data.');
    }

    function update(Request $request) {
        $rules = [
            'kader_id' => 'required',
            'tanggal_penyuluhan' => 'required',
            'materi' => 'required',
            'media' => 'required',
        ];

        if($request->hasFile('dokumentasi')) {
            $rules['dokumentasi'] = 'required|max:10000|mimes:doc,docx,pdf';
        }

        $validated = $request->validate($rules);

        if($request->hasFile('dokumentasi')) {
            $penyuluhan = Penyuluhan::where('id', $request->input('id'))->first();
            Storage::delete($penyuluhan->dokumentasi);
            $validated['dokumentasi'] = $request->file('dokumentasi')->store('dokumentasi');
        }

        Penyuluhan::where('id', $request->input('id'))->update($validated);

        return redirect('/penyuluhan')->with('notif', 'Berhasil Mengubah Data.');
    }
}
