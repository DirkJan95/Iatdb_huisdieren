<?php

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

// Route::controller('/petsOverview', 'PetController');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/petAdded', 'App\Http\Controllers\PetController@store')->name('pet.store');
    Route::get('/pet/{id}', 'App\Http\Controllers\PetController@getPet');
    Route::get('/petsOverview', 'App\Http\Controllers\PetController@index')->name('pet.index');
    Route::get('/jouwDieren', 'App\Http\Controllers\PetController@yourPets');
    Route::post('/pets/{pet}/claim', 'App\Http\Controllers\PetController@claim')->name('pets.claim');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Add route for all reviews
});

require __DIR__ . '/auth.php';
