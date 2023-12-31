<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaccoMemberController;


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

   
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    // routes/api.php

    Route::apiResource('sacco_members', SaccoMemberController::class);

    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
