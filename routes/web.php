<?php

use App\Livewire\Admin\Test;
use Illuminate\Support\Facades\Route;


Route::get('dashboard', Test::class)->name('dashboard');
Route::get('settings', App\Livewire\Santri\Test::class)->name('settings');

Route::view('/', 'app')->name('app');
