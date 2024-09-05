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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/food', FoodController::class);
    Route::resource('/delivery', DeliveryController::class);
    Route::get('/delivery/{delivery}', [DeliveryController::class, 'show'])->name('delivery.show');
    Route::patch('/delivery/{delivery}', [DeliveryController::class, 'update'])->name('delivery.update');

});

Route::get('/test',[FoodController::class,'test'])->name('test');

require __DIR__.'/auth.php';
