<?php

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Check if the user is authenticated
    if (auth()->check()) {
        // Redirect authenticated users to the 'home' page (or any other page)
        return redirect()->route('home');
    }
    // Show the welcome page for guests
    return view('guestonly.welcome');
})->name('welcome');

Route::get('/welcome', function () {
    // Check if the user is authenticated
    if (auth()->check()) {
        // Redirect authenticated users to the 'home' page (or any other page)
        return redirect()->route('home');
    }
    // Show the welcome page for guests
    return view('guestonly.welcome');
})->name('welcome');

// Define your home route (or wherever authenticated users should go)
Route::get('/home', function () {
    return view('home'); // or return to any specific controller method or view
})->name('home');

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cusShow/{delivery}', [DeliveryController::class, 'cusShow'])->name('cusShow');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('/food', FoodController::class);
    Route::resource('/delivery', DeliveryController::class);
});



require __DIR__ . '/auth.php';
