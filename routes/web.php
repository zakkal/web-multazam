<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\SantriPage;
use App\Livewire\UstadzPage;
use App\Livewire\SetoranPage;
use App\Livewire\LaporanPage;
use App\Livewire\PengaturanPage;
use App\Livewire\PaymentPage;

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

Route::get('/', function() {
    return view('welcome');
})->name('home');

Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/santri', SantriPage::class)->name('santri');
Route::get('/ustadz', UstadzPage::class)->name('ustadz');
Route::get('/setoran', SetoranPage::class)->name('setoran');
Route::get('/laporan', LaporanPage::class)->name('laporan');
Route::get('/pengaturan', PengaturanPage::class)->name('pengaturan');
// Route::get('/pembayaran', PaymentPage::class)->name('pembayaran');

Route::get('/fix-storage', function() {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return 'Storage Link Created Successfully!';
});

Route::get('/optimize-clear', function() {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return 'Cache Cleared Successfully!';
});
