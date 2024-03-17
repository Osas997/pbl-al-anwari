<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;



Route::redirect('/', '/login');

Route::get('/login', Login::class)->name('login')->middleware('guestOnly');

Route::get('/logout', LogoutController::class)->name('logout')->middleware('auth:admin,web');

Route::middleware('role:admin,admin')->group(function () {
   Route::get('dashboard', Dashboard::class)->name('dashboard');
   Route::get('settings', App\Livewire\Santri\Test::class)->name('settings');
   Route::get('tes', App\Livewire\Santri\Test::class)->name('tes');
});
