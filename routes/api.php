<?php

use App\Http\Controllers\CategoryControllers\CategoryDetailController;
use App\Http\Controllers\CategoryControllers\CategoryListController;
use Illuminate\Http\Request;
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
    });

});
