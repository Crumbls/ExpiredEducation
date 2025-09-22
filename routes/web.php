<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Welcome::class);

Route::get('/timeline', \App\Http\Controllers\ListFactController::class)->name('timeline');

Route::get('/{year}', \App\Http\Controllers\ViewYearController::class)
    ->name('year.view')
    ->where('year', '^[1|2]\d{3}$');
