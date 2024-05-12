<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisionController;

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

    //division
    Route::get('/division', [DivisionController::class, 'index'])->name('division.index');
    Route::post('/division', [DivisionController::class, 'insert'])->name('division.insert');
    Route::get('/division/edit/{division_id}', [DivisionController::class, 'edit'])->name('division.edit');
    Route::put('/division/{division_id}/update', [DivisionController::class, 'update'])->name('division.update');
    Route::delete('/division/{division_id}/delete', [DivisionController::class, 'delete'])->name('division.delete');

});

require __DIR__.'/auth.php';
