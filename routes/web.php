<?php

use App\Http\Controllers\TeamsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\BookingOrdersController;
use App\Http\Controllers\CarTypesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ServiceOrdersController;
use App\Http\Controllers\TestimonialsController;

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
})->name('home');

Route::resource('booking_orders', BookingOrdersController::class);
Route::resource('locations', LocationsController::class);
Route::resource('cars', CarsController::class);
Route::resource('services', ServicesController::class);
Route::resource('contacts', ContactsController::class);
Route::resource('teams', TeamsController::class);
Route::resource('testimonials', TestimonialsController::class);
Route::resource('services_orders', ServicesController::class);
Route::resource('car_types', CarTypesController::class);
Route::resource('service_orders', ServiceOrdersController::class);
