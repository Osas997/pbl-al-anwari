<?php

use App\Livewire\Admin\Test;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;



Route::redirect('/', '/login');

Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::middleware('role:admin,admin')->group(function () {
   Route::get('dashboard', Test::class)->name('dashboard');
   Route::get('settings', App\Livewire\Santri\Test::class)->name('settings');
});
