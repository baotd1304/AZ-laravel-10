<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\admin\PostCatalogueController;
use App\Http\Controllers\admin\PostController;
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
    
    Route::prefix('users')->name('users')->as('users.')->group(function() {
        Route::get('index', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [UserController::class, 'update'])->name('update');
        Route::delete('{id}', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('user-catalogues')->name('user_catalogues')->as('user_catalogues.')->group(function() {
        Route::get('index', [UserCatalogueController::class, 'index'])->name('index');
        Route::get('create', [UserCatalogueController::class, 'create'])->name('create');
        Route::post('store', [UserCatalogueController::class, 'store'])->name('store');
        Route::get('{id}/edit', [UserCatalogueController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [UserCatalogueController::class, 'update'])->name('update');
        Route::delete('{id}', [UserCatalogueController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('languages')->name('languages')->as('languages.')->group(function() {
        Route::get('index', [LanguageController::class, 'index'])->name('index');
        Route::get('create', [LanguageController::class, 'create'])->name('create');
        Route::post('store', [LanguageController::class, 'store'])->name('store');
        Route::get('{id}/edit', [LanguageController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [LanguageController::class, 'update'])->name('update');
        Route::delete('{id}', [LanguageController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('post-catalogues')->name('post_catalogues')->as('post_catalogues.')->group(function() {
        Route::get('index', [PostCatalogueController::class, 'index'])->name('index');
        Route::get('create', [PostCatalogueController::class, 'create'])->name('create');
        Route::post('store', [PostCatalogueController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PostCatalogueController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [PostCatalogueController::class, 'update'])->name('update');
        Route::delete('{id}', [PostCatalogueController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('posts')->name('posts')->as('posts.')->group(function() {
        Route::get('index', [PostController::class, 'index'])->name('index');
        Route::get('create', [PostController::class, 'create'])->name('create');
        Route::post('store', [PostController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [PostController::class, 'update'])->name('update');
        Route::delete('{id}', [PostController::class, 'destroy'])->name('destroy');
    });
    
    
});

Route::get('get-location', [LocationController::class, 'getLocation'])->name('get_location');
Route::post('change-status', [AjaxController::class, 'changeStatus'])->name('change_status');
Route::post('change-status-all', [AjaxController::class, 'changeStatusAll'])->name('change_status_all');
Route::delete('delete-checked', [AjaxController::class, 'deleteChecked'])->name('delete_checked');
Route::post('change-field-select', [AjaxController::class, 'changeFieldSelect'])->name('change_field_select');
