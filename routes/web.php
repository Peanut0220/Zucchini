<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartDetailsController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
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
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{food_id}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::delete('/cart/{cartDetail}', [CartController::class, 'destroy'])->name('cart.delete');  // For deleting individual items
    Route::delete('/cart/clear/clean', [CartController::class, 'clear'])->name('cart.clear');
    Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cusShow/{delivery}', [DeliveryController::class, 'cusShow'])->name('cusShow');
    Route::get('/coupon', [CouponController::class, 'getCoupon'])->name('coupon');
    Route::get('/checkout', [CartController::class, 'checkoutIndex'])->name('checkout');
    Route::post('/checkout/process', [OrderController::class, 'checkout'])->name('checkout.process');
    Route::get('/order/success/{order_id}', [OrderController::class, 'orderSuccess'])->name('order.success');
    Route::get('/orderList', function () {
        return view('custonly.orderList');
    })->name('orderList');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('orderShow');
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
