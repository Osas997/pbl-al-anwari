<?php

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\TesController;
use App\Livewire\Admin\Catering\Catering;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Diniyyah\Diniyyah;
use App\Livewire\Admin\Diniyyah\DinyyahDeletedFile;
use App\Livewire\Admin\Laporan\Laporan;
use App\Livewire\Admin\Pembayaran\KwitansiPembayaran;
use App\Livewire\Admin\Pembayaran\Pembayaran;
use App\Livewire\Admin\Pembayaran\PembayaranDetail;
use App\Livewire\Admin\Pembayaran\RiwayatPembayaran;
use App\Livewire\Admin\Rekening\Rekening;
use App\Livewire\Admin\Santri\Santri;
use App\Livewire\Admin\Santri\SantriDeletedFile;
use App\Livewire\Admin\Santri\SantriDetail;
use App\Livewire\Admin\Syahriyyah\Syahriyyah;
use App\Livewire\Admin\Tagihan\Tagihan;
use App\Livewire\Admin\Tagihan\TagihanDetail;
use App\Livewire\Admin\Tagihan\TagihanSelesai;
use App\Livewire\Auth\Login;
use App\Livewire\Santri\MyProfile;
use App\Livewire\Santri\Profile;
use App\Livewire\Tes;
use Illuminate\Support\Facades\Route;



Route::redirect('/', '/login');

Route::get('/login', Login::class)->name('login')->middleware('guestOnly');

Route::get('/logout', LogoutController::class)->name('logout')->middleware('auth:admin,web');

Route::middleware('admin')->prefix('admin')->group(function () {
   Route::get('dashboard', Dashboard::class)->name('dashboard');

   Route::get('diniyyah', Diniyyah::class)->name('diniyyah');
   Route::get('deleted-diniyyah', DinyyahDeletedFile::class)->name('deleted-diniyyah');

   Route::get('rekening-bank', Rekening::class)->name('rekening-bank');

   Route::get('catering', Catering::class)->name('catering');

   Route::get('syahriyyah', Syahriyyah::class)->name('syahriyyah');

   Route::get('santri', Santri::class)->name('santri');
   Route::get('deleted-santri', SantriDeletedFile::class)->name('deleted-santri');
   Route::get('santri/{santri}', SantriDetail::class)->name('santri-detail');

   Route::get('tagihan', Tagihan::class)->name('tagihan');
   Route::get('tagihan/{tagihan}', TagihanDetail::class)->name('tagihan-detail');

   Route::get('pembayaran', Pembayaran::class)->name('pembayaran');
   Route::get('pembayaran/{id}', PembayaranDetail::class)->name('pembayaran-detail');

   Route::get('riwayat-pembayaran', RiwayatPembayaran::class)->name('riwayat-pembayaran');

   Route::get('laporan', Laporan::class)->name('laporan');

   Route::get('kwitansi/{pembayaran}', KwitansiPembayaran::class)->name('kwitansi-pembayaran');

   Route::get('/tes',  Tes::class)->name('tes');
});

Route::middleware('santri')->prefix('santri')->group(function () {
   Route::get('settings', Profile::class)->name('change-password');

   Route::get('profile', MyProfile::class)->name('profile');

   Route::get('tagihan', App\Livewire\Santri\Tagihan\Tagihan::class)->name('tagihan-santri');
   Route::get('tagihan/{tagihan}', App\Livewire\Santri\Tagihan\TagihanDetail::class)->name('tagihan-detail-santri');

   Route::get('riwayat-pembayaran', App\Livewire\Santri\Pembayaran\RiwayatPembayaran::class)->name('riwayat-pembayaran-santri');
});


Route::get('tes', TesController::class)->name('tesDone');