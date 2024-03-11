<?php

use App\Models\Barang;
use App\Models\Nasabah;
use App\Models\Penukaran;
use App\Models\Sampah;
use App\Models\Tabungan;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $userCount = User::count();
        $sampahCount = Sampah::count();
        $barangCount = Barang::count();
        $tabunganCount = Tabungan::count();
        $penukaranCount = Penukaran::count();
        $nasabahCount = Nasabah::count();
        return view('dashboard', compact('userCount', 'sampahCount', 'barangCount', 'penukaranCount', 'nasabahCount', 'tabunganCount'));
    })->name('dashboard');

    Route::get('/permissions', function () {
        return view('permissions');
    })->name('permissions');

    Route::get('/roles', function () {
        return view('roles');
    })->name('roles');

    Route::get('/users', function () {
        return view('users');
    })->name('users');

    Route::get('/nasabah', function () {
        return view('nasabah');
    })->name('nasabah');

    Route::get('/transaksi', function () {
        return view('transaksi');
    })->name('transaksi');

    Route::get('/tabungan', function () {
        return view('tabungan');
    })->name('tabungan');

    Route::get('/barang', function () {
        return view('barang');
    })->name('barang');

    Route::get('/penukaran', function () {
        return view('penukaran');
    })->name('penukaran');

    Route::get('/jenis-sampah', function () {
        return view('jenis-sampah');
    })->name('jenis-sampah');
});
