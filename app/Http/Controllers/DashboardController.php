<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Ibu;
use App\Models\Penimbangan;
use App\Models\Imunisasi;

class DashboardController extends Controller
{
    function index() {
        if(auth()->user()->role == 'orang-tua') {
            return redirect('/info');
        }
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'anak' => Anak::count(),
            'ibu' => Ibu::count(),
            'penimbangan' => Penimbangan::count(),
            'imunisasi' => Imunisasi::count()
        ]);
    }
}
