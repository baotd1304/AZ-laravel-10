<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\UserCatalogueController;
use App\Http\Controllers\ajax\AjaxController;
use App\Http\Controllers\ajax\LocationController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function() {
    Route::get('login', [AuthController::class, 'index']);
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function() {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

//Route ADMIN
Route::prefix('admin')->name('admin')->as('admin.')->middleware('auth', 'adminAccess')->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('user')->name('user')->as('user.')->group(function() {
        Route::get('index', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [UserController::class, 'update'])->name('update');
        Route::delete('{id}', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('user-catalogue')->name('user_catalogue')->as('user_catalogue.')->group(function() {
        Route::get('index', [UserCatalogueController::class, 'index'])->name('index');
        Route::get('create', [UserCatalogueController::class, 'create'])->name('create');
        Route::post('store', [UserCatalogueController::class, 'store'])->name('store');
        Route::get('{id}/edit', [UserCatalogueController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [UserCatalogueController::class, 'update'])->name('update');
        Route::delete('{id}', [UserCatalogueController::class, 'destroy'])->name('destroy');
    });
    
});

Route::get('get-location', [LocationController::class, 'getLocation'])->name('get-location');
Route::post('change-status', [AjaxController::class, 'changeStatus'])->name('change-status');
Route::post('change-status-all', [AjaxController::class, 'changeStatusAll'])->name('change-status-all');
Route::delete('delete-checked', [AjaxController::class, 'deleteChecked'])->name('delete-checked');
Route::post('change-field-select', [AjaxController::class, 'changeFieldSelect'])->name('change-field-select');

