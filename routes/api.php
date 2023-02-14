<?php

use App\Http\Controllers\CategoryControllers\CategoryDetailController;
use App\Http\Controllers\CategoryControllers\CategoryListController;
use App\Http\Controllers\CategoryControllers\CreateCategoryController;
use App\Http\Controllers\CategoryControllers\DeleteCategoryController;
use App\Http\Controllers\CategoryControllers\UpdateCategoryController;
use App\Http\Controllers\ImageControllers\ImageDetailController;
use App\Http\Controllers\ImageControllers\ImageListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('validate.xapikey')->group(function () {
    // Categories Routes
    Route::prefix('categories')->group(function (){
        Route::get('/', CategoryListController::class);
        Route::get('/{id}', CategoryDetailController::class);
        Route::post('/', CreateCategoryController::class);
        Route::put('/{id}', UpdateCategoryController::class);
        Route::delete('/{id}', DeleteCategoryController::class);
    });

    // Images Routes
    Route::prefix('images')->group(function (){
        Route::get('/', ImageListController::class);
        Route::get('/{id}', ImageDetailController::class);
    });

});
