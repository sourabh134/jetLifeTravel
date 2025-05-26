<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('admin.auth-cover-signin');
// });
//Frontend
Route::get('/',[HomeController::class,'index']);
Route::get('/register',[UserController::class,'register']);
Route::get('/login',[UserController::class,'login']);
Route::post('/storeUser',[UserController::class,'storeUser'])->name('user.userstores');
Route::post('/search-airport', [HomeController::class, 'searchAirport']);
Route::get('/Flights-Search', [HomeController::class, 'flightSearchResult']);
Route::get('/Review-Flight', [HomeController::class, 'reviewflight']);
//Backend
Route::get('/admin',[AdminController::class,'admin'])->name('admin');
Route::post('/adminLogin',[AdminController::class,'adminLogin'])->name('adminlogin');
Route::get('/adminpassword',[AdminController::class,'adminpassword'])->name('adminpassword');
Route::controller(AdminController::class)->group(function(){
    Route::get('/dashboard','adminDashboard')->name('admin.dashboard');
    Route::get('/logout','logout')->name('logout');
});
Route::controller(BookingController::class)->group(function(){
    Route::get('/flightbooking','flightbooking')->name('flightbooking');
});
// Route::middleware([CheckLogin::class, PreventBackHistory::class])->group(function(){
//     Route::controller(AdminController::class)->group(function(){
//         Route::get('/dashboard','adminDashboard')->name('dashboard');
//     });
// });

