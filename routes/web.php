<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\Admin\Angkatan\Angkatan;
use App\Livewire\Admin\Angkatan\AngkatanDeletedFile;
use App\Livewire\Admin\Catering\Catering;
use App\Livewire\Admin\Catering\CateringDeletedFile;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Diniyyah\Diniyyah;
use App\Livewire\Admin\Diniyyah\DinyyahDeletedFile;
use App\Livewire\Admin\Kamar\Kamar;
use App\Livewire\Admin\Kamar\KamarDeletedFile;
use App\Livewire\Admin\Syahriyyah\Syahriyyah;
use App\Livewire\Admin\Syahriyyah\SyahriyyahDeletedFile;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;



Route::redirect('/', '/login');

Route::get('/login', Login::class)->name('login')->middleware('guestOnly');

Route::get('/logout', LogoutController::class)->name('logout')->middleware('auth:admin,web');

Route::middleware('role:admin,admin')->prefix('admin')->group(function () {
   Route::get('dashboard', Dashboard::class)->name('dashboard');

   Route::get('diniyyah', Diniyyah::class)->name('diniyyah');
   Route::get('deleted-diniyyah', DinyyahDeletedFile::class)->name('deleted-diniyyah');

   Route::get('angkatan', Angkatan::class)->name('angkatan');
   Route::get('deleted-angkatan', AngkatanDeletedFile::class)->name('deleted-angkatan');

   Route::get('catering', Catering::class)->name('catering');

   Route::get('syahriyyah', Syahriyyah::class)->name('syahriyyah');

   Route::get('settings', App\Livewire\Santri\Test::class)->name('settings');
   Route::view('tes', 'app')->name('tes');
   // Route::get('tes', App\Livewire\Santri\Test::class)->name('tes');
});