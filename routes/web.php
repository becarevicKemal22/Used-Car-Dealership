<?php

use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleModelController;
use App\Http\Controllers\VehicleTypeController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return view('home');
});

Route::resource('vozila', VehicleController::class);

Route::get('/nova_marka', [ManufacturerController::class, 'create'])->name('manufacturers.create');
Route::post('/nova_marka', [ManufacturerController::class, 'store'])->name('manufacturers.store');

Route::get('/novi_model', [VehicleModelController::class, 'create'])->name('vehicleModels.create');
Route::post('/novi_model', [VehicleModelController::class, 'store'])->name('vehicleModels.store');

Route::get('/novi_tip', [VehicleTypeController::class, 'create'])->name('vehicleTypes.create');
Route::post('/novi_tip', [VehicleTypeController::class, 'store'])->name('vehicleTypes.store');

Route::view('/kontakt', 'kontakt.blade.php');
Route::view('/usluge', 'usluge.blade.php');

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');