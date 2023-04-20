<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IbuController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\VaksinController;
use App\Http\Controllers\PenimbanganController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\AOCController;
use App\Http\Controllers\PMBAController;
use App\Http\Controllers\PenyuluhanController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

route::get('/dashboard', [DashboardController::class, 'index']);

// Ibu
route::get('/ibu', [IbuController::class, 'index']);
route::post('/ibu', [IbuController::class, 'store']);
route::delete('/ibu/{id}/delete', [IbuController::class, 'destroy']);
route::put('/ibu', [IbuController::class, 'update']);

// Anak
route::get('/anak', [AnakController::class, 'index']);
route::post('/anak', [AnakController::class, 'store']);
route::delete('/anak/{id}/delete', [AnakController::class, 'destroy']);
route::put('/anak', [AnakController::class, 'update']);

// Kader
route::get('/kader', [KaderController::class, 'index']);
route::post('/kader', [KaderController::class, 'store']);
route::delete('/kader/{id}/delete', [KaderController::class, 'destroy']);
route::put('/kader', [KaderController::class, 'update']);

// Vaksin
route::get('/vaksin', [VaksinController::class, 'index']);
route::post('/vaksin', [VaksinController::class, 'store']);
route::delete('/vaksin/{id}/delete', [VaksinController::class, 'destroy']);
route::put('/vaksin', [VaksinController::class, 'update']);

// penimbangan
route::get('/penimbangan', [PenimbanganController::class, 'index']);
route::get('/penimbangan/{id}', [PenimbanganController::class, 'penimbangan']);
route::post('/penimbangan/{anak}', [PenimbanganController::class, 'store']);
route::put('/penimbangan/{anak}', [PenimbanganController::class, 'update']);
route::get('/hasil_penimbangan', [PenimbanganController::class, 'hasil']);
route::post('/hasil_penimbangan', [PenimbanganController::class, 'hasilPost']);

// imunisasi
route::get('/imunisasi', [ImunisasiController::class, 'index']);
route::get('/imunisasi/{id}', [ImunisasiController::class, 'imunisasi']);
route::post('/imunisasi/{anak}', [ImunisasiController::class, 'store']);
route::put('/imunisasi/{anak}', [ImunisasiController::class, 'update']);

// AOC
route::get('/aoc', [AOCController::class, 'index']);
route::get('/aoc/{id}', [AOCController::class, 'aoc']);
route::post('/aoc/{anak}', [AOCController::class, 'store']);
route::put('/aoc/{anak}', [AOCController::class, 'update']);

// PMBA
route::get('/pmba', [PMBAController::class, 'index']);
route::get('/pmba/{id}', [PMBAController::class, 'pmba']);
route::post('/pmba/{anak}', [PMBAController::class, 'store']);
route::put('/pmba/{anak}', [PMBAController::class, 'update']);

// Penyuluhan
route::get('/penyuluhan', [PenyuluhanController::class, 'index']);
route::post('/penyuluhan', [PenyuluhanController::class, 'store']);
route::delete('/penyuluhan/{penyuluhan}/delete', [PenyuluhanController::class, 'destroy']);
route::put('/penyuluhan', [PenyuluhanController::class, 'update']);

// informasi
route::get('/informasi', [InformasiController::class, 'index']);
route::put('/informasi', [InformasiController::class, 'update']);
route::get('/info', [InformasiController::class, 'info']);

// user
Route::resource('user', UserController::class);
Route::get('/login/orangtua', [UserController::class, 'loginOrangTua']);
Route::post('/login/orangtua', [UserController::class, 'loginOrangTuaTry']);

// laporan
route::get('/laporan/anak', [LaporanController::class, 'anak']);
route::get('/laporan/penimbangan', [LaporanController::class, 'penimbangan']);
route::get('/laporan/imunisasi', [LaporanController::class, 'imunisasi']);
route::get('/laporan/aoc', [LaporanController::class, 'aoc']);
route::get('/laporan/pmba', [LaporanController::class, 'pmba']);

// logout
route::get('/logout', function(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});
