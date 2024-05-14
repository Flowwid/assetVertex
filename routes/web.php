<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MaintenanceController;

Route::get('/', function () {
    return view('welcome');
});

//DASHBOARD
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//AUTHENTICATION
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //DIVISION
    Route::get('/division', [DivisionController::class, 'index'])->name('division.index');
    Route::post('/division', [DivisionController::class, 'insert'])->name('division.insert');
    Route::get('/division/edit/{division_id}', [DivisionController::class, 'edit'])->name('division.edit');
    Route::put('/division/{division_id}/update', [DivisionController::class, 'update'])->name('division.update');
    Route::delete('/division/{division_id}/delete', [DivisionController::class, 'delete'])->name('division.delete');

    //BUDGET
    Route::get('/budget', [BudgetController::class, 'index'])->name('budget.index');

    //EVENT
    Route::get('/event', [EventController::class, 'index'])->name('event.index');
    Route::post('/event', [EventController::class, 'insert'])->name('event.insert');
    Route::get('/event/edit/{event_id}', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/event/{event_id}/update', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/{event_id}/delete', [EventController::class, 'delete'])->name('event.delete');

    //FUND

    //ALLOCATION

    //ASSET
    Route::get('/asset', [AssetController::class, 'index'])->name('asset.index');
    Route::post('/asset', [AssetController::class, 'insert'])->name('asset.insert');
    Route::get('/asset/edit/{asset_id}', [AssetController::class, 'edit'])->name('asset.edit');
    Route::put('/asset/{asset_id}/update', [AssetController::class, 'update'])->name('asset.update');
    Route::delete('/asset/{asset_id}/delete', [AssetController::class, 'delete'])->name('asset.delete');

    //BOM

    //MAINTENANCE
    Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');


});

require __DIR__.'/auth.php';
