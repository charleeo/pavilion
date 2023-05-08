<?php

use App\Http\Controllers\ClientController;
use App\Models\LegalCounsel;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('client')->group(function () {
   
    Route::get('/',[ ClientController::class,"index"]);
    
    Route::get('/detail/{client}',[ ClientController::class,"show"]);

    Route::post('/',[ ClientController::class,"store"]);
    
});
Route::get('/counsels',[ ClientController::class,"counsels"]);

