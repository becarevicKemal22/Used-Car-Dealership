<?php

use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleModelController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::resource('vozila', VehicleController::class);

Route::get('/nova_marka', [ManufacturerController::class, 'create'])->name('manufacturers.create');
Route::post('/nova_marka', [ManufacturerController::class, 'store'])->name('manufacturers.store');

Route::get('/novi_model', [VehicleModelController::class, 'create'])->name('vehicleModels.create');
Route::post('/novi_model', [VehicleModelController::class, 'store'])->name('vehicleModels.store');

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');