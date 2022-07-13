<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('index');
})->name('main');

Auth::routes();

Route::group(['middleware' => 'auth'], function (){
    Route::group(['prefix' => 'products'], function() {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::post('create', [ProductController::class, 'create']);
        Route::put('update/{id}', [ProductController::class, 'update']);
        Route::get('view/{id}', [ProductController::class, 'view']);
        Route::delete('delete/{id}', [ProductController::class, 'delete']);
    });
});

