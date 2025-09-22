<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Welcome::class);

Route::get('/timeline', \App\Http\Controllers\ListFactController::class)
    ->middleware([
        \App\Http\Middleware\FullPageCacheMiddleware::class,
    ])
    ->name('timeline');

Route::get('/{year}', \App\Http\Controllers\ViewYearController::class)
    ->middleware([
        \App\Http\Middleware\FullPageCacheMiddleware::class,
    ])
    ->name('year.view')
    ->where('year', '^(19|20)\d{2}$');
