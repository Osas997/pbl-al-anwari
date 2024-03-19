<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Diniyyah\Diniyyah;
use App\Livewire\Admin\Kamar\Kamar;
use App\Livewire\Admin\Kamar\KamarDeletedFile;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;



Route::redirect('/', '/login');

Route::get('/login', Login::class)->name('login')->middleware('guestOnly');

Route::get('/logout', LogoutController::class)->name('logout')->middleware('auth:admin,web');

Route::middleware('role:admin,admin')->prefix('admin')->group(function () {
   Route::get('dashboard', Dashboard::class)->name('dashboard');
   Route::get('kamar', Kamar::class)->name('kamar');
   Route::get('deleted-kamar', KamarDeletedFile::class)->name('deleted-kamar');
   Route::get('diniyyah', Diniyyah::class)->name('diniyyah');
   Route::get('settings', App\Livewire\Santri\Test::class)->name('settings');
   // Route::get('tes', App\Livewire\Santri\Test::class)->name('tes');
   Route::view('tes', 'app')->name('tes');
});
