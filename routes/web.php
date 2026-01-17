<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\FunnelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Funnel Routes
Route::get('/f/{funnel:slug}', [FunnelController::class, 'show'])->name('funnel.show');
Route::get('/f/{funnel:slug}/{step:slug}', [FunnelController::class, 'step'])->name('funnel.step');

// Dynamic Pages (must be last)
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show')->where('slug', '[a-z0-9\-]+');
