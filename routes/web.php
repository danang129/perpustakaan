<?php


use App\Livewire\BukuComponent;
use App\Livewire\HomeComponent;
use App\Livewire\KategoriComponent;
use App\Livewire\KembaliComponent;
use App\Livewire\LoginComponent;
use App\Livewire\MemberComponent;
use App\Livewire\PinjamComponent;
use App\Livewire\UserComponent;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('components.layouts.app');
// });


Route::get('/', HomeComponent::class)->middleware('auth')->name('home');
Route::get('/admin', UserComponent::class)->middleware('auth')->name('admin');
Route::get('/member', MemberComponent::class)->middleware('auth')->name('member');
Route::get('/kategori', KategoriComponent::class)->middleware('auth')->name('kategori');
Route::get('/buku', BukuComponent::class)->middleware('auth')->name('buku');
Route::get('/peminjaman-buku', PinjamComponent::class)->middleware('auth')->name('pinjam');
Route::get('/pengembalian-buku', KembaliComponent::class)->middleware('auth')->name('kembali');

Route::get('/login', LoginComponent::class)->name('login');
Route::get('/logout', LoginComponent::class,'keluar')->name('logout');