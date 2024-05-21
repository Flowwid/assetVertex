<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\BomController;

Route::get('/', function () {
    return view('welcome2');
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
    Route::post('/budget', [BudgetController::class, 'insert'])->name('budget.insert');
    Route::get('/budget/edit/{budget_id}', [BudgetController::class, 'edit'])->name('budget.edit');
    Route::put('/budget/{budget_id}/update', [BudgetController::class, 'update'])->name('budget.update');
    Route::delete('/budget/{budget_id}/delete', [BudgetController::class, 'delete'])->name('budget.delete');


    //EVENT
    Route::get('/event', [EventController::class, 'index'])->name('event.index');
    Route::post('/event', [EventController::class, 'insert'])->name('event.insert');
    Route::get('/event/edit/{event_id}', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/event/{event_id}/update', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/{event_id}/delete', [EventController::class, 'delete'])->name('event.delete');

    //FUND
    Route::get('/budget/{budget_id}/fund/', [FundController::class, 'index'])->name('fund.index');
    Route::post('/budget/{budget_id}/fund/', [FundController::class, 'insert'])->name('fund.insert');
    Route::put('/budget/{budget_id}/fund/{fund_id}/update', [FundController::class, 'update'])->name('fund.update');
    Route::delete('/budget/{budget_id}/fund/{fund_id}/delete', [FundController::class, 'delete'])->name('fund.delete');


    //ALLOCATION

    //ASSET
    Route::get('/asset', [AssetController::class, 'index'])->name('asset.index');
    Route::post('/asset/insert', [AssetController::class, 'insert'])->name('asset.insert');
    Route::get('/asset/edit/{asset_id}', [AssetController::class, 'edit'])->name('asset.edit');
    Route::put('/asset/{asset_id}/update', [AssetController::class, 'update'])->name('asset.update');
    Route::delete('/asset/{asset_id}/delete', [AssetController::class, 'delete'])->name('asset.delete');
    Route::post('/asset/import', [AssetController::class, 'import'])->name('asset.import');
    Route::post('/asset/export', [AssetController::class, 'export'])->name('asset.export');


    //BOM
    Route::get('/asset/{asset_id}/bom/', [BomController::class, 'index'])->name('bom.index');
    Route::post('/asset/{asset_id}/bom/', [BomController::class, 'insert'])->name('bom.insert');
    Route::put('/asset/{asset_id}/bom/{bom_id}/update', [BomController::class, 'update'])->name('bom.update');
    Route::delete('/asset/{asset_id}/bom/{bom_id}/delete', [BomController::class, 'delete'])->name('bom.delete');

    //MAINTENANCE
    Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');


});

require __DIR__.'/auth.php';
