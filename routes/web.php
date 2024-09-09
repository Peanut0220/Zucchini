<?php

use App\Http\Controllers\CartDetailsController;
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
        // Check if the authenticated user has the 'admin' role
        if (auth()->user()->hasRole('admin')) {
            // Redirect admin users to the 'dashboard' page
            return redirect()->route('dashboard');
        }
        // Check if the authenticated user has the 'customer' role
        elseif (auth()->user()->hasRole('customer')) {
            // Redirect customer users to the 'home' page
            return redirect()->route('home');
        }
    }
    // Show the welcome page for guests
    return view('guestonly.welcome');
})->name('welcome');

Route::get('/welcome', function () {
    // Check if the user is authenticated
    if (auth()->check()) {
        // Check if the authenticated user has the 'admin' role
        if (auth()->user()->hasRole('admin')) {
            // Redirect admin users to the 'dashboard' page
            return redirect()->route('dashboard');
        }
        // Check if the authenticated user has the 'customer' role
        elseif (auth()->user()->hasRole('customer')) {
            // Redirect customer users to the 'home' page
            return redirect()->route('home');
        }
    }

    // If the user is not authenticated or doesn't have the specified role, show the guest welcome page
    return view('guestonly.welcome');
})->name('welcome');

// Routes for authenticated users
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', function () {
        return view('custonly.home');
    })->name('home');

    Route::get('/menu', [FoodController::class, 'customerMenu'])->name('menu');
    Route::get('/foodDetail/{food}', [FoodController::class, 'showCus'])->name('foodDetail');

    Route::get('/cusShow/{delivery}', [DeliveryController::class, 'cusShow'])->name('cusShow');
    Route::get('/', [CartDetailsController::class, 'cusShow'])->name('addToCart');
});

// Admin routes
Route::middleware(['auth', 'role:admin','verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('adminonly.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('/food', FoodController::class); // Admin food management
    Route::resource('/delivery', DeliveryController::class);
});

require __DIR__ . '/auth.php';
