<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\CheckUserRole;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MahasiswaPeminjamanController;
use App\Http\Controllers\MahasiswaBukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\JenisUserController;

//login logout register
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', function(){
    return view('register');
})->name('register.form');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::middleware([CheckUserRole::class.':1'])->group(function () {
    //dashboard
    Route::get('/dashboardadm', function () {
        return view('admin.index');
    })->name('dashboardadm'); 

    //manage user
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id_user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id_user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id_user}', [UserController::class, 'destroy'])->name('users.destroy');

    //manage jenis user
    Route::get('/jenisuser', [JenisUserController::class, 'index'])->name('jenisuser.index'); 
    Route::get('/create', [JenisUserController::class, 'create'])->name('jenisuser.create'); 
    Route::post('/jenisuser', [JenisUserController::class, 'store'])->name('jenisuser.store'); 
    Route::get('/{id_jenis_user}/edit', [JenisUserController::class, 'edit'])->name('jenisuser.edit'); 
    Route::put('/{id_jenis_user}', [JenisUserController::class, 'update'])->name('jenisuser.update'); 
    Route::delete('/jenisuser/{id_jenis_user}', [JenisUserController::class, 'destroy'])->name('jenisuser.destroy'); 
});

Route::middleware([CheckUserRole::class.':2'])->group(function () {
    //dashboard
    Route::get('/dashboardpjg', function () {
        return view('penjaga.index');
    })->name('dashboardpjg'); 

    //kategori
    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('kategori/{idkategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('kategori/{idkategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('kategori/{idkategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    //buku
    Route::get('buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('buku/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('buku', [BukuController::class, 'store'])->name('buku.store');
    Route::get('buku/{idbuku}/edit', [BukuController::class, 'edit'])->name('buku.edit');
    Route::put('buku/{idbuku}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('buku/{idbuku}', [BukuController::class, 'destroy'])->name('buku.destroy');

    //peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/verifikasi-peminjaman/{id}', [PeminjamanController::class, 'verifikasiPeminjaman'])->name('verifikasi.peminjaman');
    Route::post('/verifikasi-pengembalian/{id}', [PeminjamanController::class, 'verifikasiPengembalian'])->name('verifikasi.pengembalian');
});

Route::middleware([CheckUserRole::class.':3'])->group(function () {
    Route::get('/dashboardmhs', function () {
        return view('mhs.index');
    })->name('dashboardmhs');

    //buku
    Route::get('/mahasiswa/buku', [MahasiswaBukuController::class, 'index'])->name('mahasiswa.buku.index');
    Route::get('/mahasiswa/buku/pinjam/{idbuku}', [MahasiswaBukuController::class, 'pinjamForm'])->name('mahasiswa.buku.pinjam.form');
    Route::post('/mahasiswa/buku/pinjam', [MahasiswaBukuController::class, 'pinjamStore'])->name('mahasiswa.buku.pinjam.store');

    //riwayat peminjaman
    Route::get('/mahasiswa/peminjaman', [MahasiswaPeminjamanController::class, 'index'])->name('mahasiswa.peminjaman.index');
    Route::post('/mahasiswa/peminjaman/kembalikan/{idpeminjaman}', [MahasiswaPeminjamanController::class, 'kembalikan'])->name('mahasiswa.peminjaman.kembalikan');
    });