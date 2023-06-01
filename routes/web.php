<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;

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

// Route::controller('/petsOverview', 'PetController');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profiel/{id}', 'App\Http\Controllers\UserController@getProfile');
    Route::get('/pet/{id}', 'App\Http\Controllers\PetController@getPet');
    Route::get('/petsOverview', [PetController::class, 'index'])->name('pet.index');
    Route::get('/jouwDieren', [PetController::class, 'yourpets']);
    Route::get('/users/{userId}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');

    Route::post('/petAdded', 'App\Http\Controllers\PetController@store')->name('pet.store');
    Route::post('/pets/{pet}/claim', [PetController::class, 'claim'])->name('pets.claim');
    Route::post('/users/{userId}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/pets/{pet}/handle-claim', [PetController::class, 'handleClaim'])->name('pets.handleClaim');

    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Add route for admin all reviews
});

require __DIR__ . '/auth.php';
