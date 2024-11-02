<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarcodeController;

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


Route::get('/barcodes/create', [BarcodeController::class, 'create'])->name('barcodes.create');
Route::post('/barcodes', [BarcodeController::class, 'store'])->name('barcodes.store');
Route::get('/barcodes/index', [BarcodeController::class, 'index'])->name('barcodes.index');
Route::get('barcodes/{id}', [BarcodeController::class, 'show'])->name('barcodes.show');

Route::resource('barcodes', BarcodeController::class);

Route::get('/scan', function () {
    return view('scan');
})->name('barcodes.scan');

Route::post('/barcodes/toggle/{code}', [BarcodeController::class, 'toggle']);
