<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1/user/{id}/todos')->group( function () {
              
    Route::get(   '/',                    [TodoController::class, 'index']);
    Route::post(  '/',                    [TodoController::class, 'store']);
    Route::put(   '/{todo}',              [TodoController::class, 'update']);
    Route::put(   '/{todo}/state={state}',[TodoController::class, 'update']);
    Route::delete('/{todo}',              [TodoController::class, 'destroy']);
            
}) ;

