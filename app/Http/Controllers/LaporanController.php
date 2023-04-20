<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Penimbangan;
use App\Models\Imunisasi;
use App\Models\AOC;
use App\Models\PMBA;

class LaporanController extends Controller
{
    function anak() {
        return view('laporan.anak', [
            'title' => 'Laporan Anak',
            'anaks' => Anak::with('ibu')->get()
        ]);
    }

    function penimbangan() {
        return view('laporan.penimbangan', [
            'title' => 'Laporan Penimbangan',
            'penimbangans' => Penimbangan::with('anak.ibu')->get()
        ]);
    }

    function imunisasi() {
        return view('laporan.imunisasi', [
            'title' => 'Laporan Imunisasi',
            'imunisasis' => Imunisasi::with(['anak.ibu', 'vaksin'])->get()
        ]);
    }

    function aoc() {
        return view('laporan.aoc', [
            'title' => 'Laporan Vitamin A & Obat Cacing',
            'aocs' => AOC::with('anak.ibu')->get()
        ]);
    }

    function pmba() {
        return view('laporan.pmba', [
            'title' => 'Laporan Pemberian Makan Bagi Anak',
            'pmbas' => PMBA::with('anak.ibu')->get()
        ]);
    }
}
