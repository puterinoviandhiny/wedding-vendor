<?php

use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\WeddingPackageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Business Profile
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/business/profile',
        [BusinessProfileController::class, 'edit']
    )->name('business.profile');

    Route::put(
        '/business/profile',
        [BusinessProfileController::class, 'update']
    )->name('business.profile.update');

    //client

    Route::resource('clients', ClientController::class);
    
    //package
    Route::resource('packages', WeddingPackageController::class)
    ->except(['show']);
    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::middleware('owner')->group(function () {

        Route::resource(
            'users',
            UserController::class
        )->except([
            'show',
        ]);

    });



});
require __DIR__.'/auth.php';
