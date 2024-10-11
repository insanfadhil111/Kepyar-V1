<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ESPController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/uploadDaya/{daya}', [ESPController::class, 'uploadDaya']);
Route::post('/data', [ESPController::class, 'store']);
Route::post('/data2', [ESPController::class, 'store2']);
Route::post('/data3', [ESPController::class, 'store3']);
Route::post('/data4', [ESPController::class, 'store4']);
Route::post('/data5', [ESPController::class, 'store5']);
// Route::post('api/data', [ESPController::class, 'store']);
Route::get('/triggerRelay', [ESPController::class, 'triggerRelay']);
Route::post('/esp/uploadDaya/{device}', [ESPController::class, 'uploadDaya']);
Route::get('/esp/uploadDaya/{device}', [ESPController::class, 'uploadDaya']);
