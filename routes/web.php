<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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

Route::view('/blocked', 'blocked')->name('blocked');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::middleware('auth', 'blocked')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/profiel/{id}', [UserController::class, 'getProfile'])->name('profile.show');
    Route::get('/profiel', [UserController::class, 'showProfile'])->name('profiel');
    Route::get('/pet/{id}', [PetController::class, 'getPet']);
    Route::get('/', [PetController::class, 'index'])->name('pet.index');
    Route::get('/jouwDieren', [PetController::class, 'yourpets']);
    Route::get('/users/{userId}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');

    Route::post('/petAdded', [PetController::class, 'store'])->name('pet.store');
    Route::post('/pets/{pet}/claim', [PetController::class, 'claim'])->name('pets.claim');
    Route::post('/users/{userId}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/pets/{pet}/handle-claim', [PetController::class, 'handleClaim'])->name('pets.handleClaim');

    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    Route::put('/users/{user}/block', [AdminController::class, 'block'])->name('users.block');
    Route::put('/pets/{pet}/deny-claim', [AdminController::class, 'denyClaim'])->name('pets.denyClaim');
});

require __DIR__ . '/auth.php';
