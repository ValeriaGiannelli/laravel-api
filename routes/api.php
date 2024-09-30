<?php

use App\Http\Controllers\Api\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// rotta per i progetti
Route::get('/progetti', [PageController::class, 'index']);

Route::get('/linguaggi-di-programmazione', [PageController::class, 'technologies'] );

Route::get('/tipi-di-progetto', [PageController::class, 'types']);

Route::get('/progetto/{slug}', [PageController::class, 'singleProject']);

Route::get('/progetti-per-tipo/{slug}', [PageController::class, 'projectsByType']);

Route::get('/progetti-per-tecnologia/{slug}', [PageController::class, 'projectsByTechnology']);
