<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Models\Todo;
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
Route::resource('todo', TodoController::class);

// This route is made so the completed status of the todo doesn't cause error an
// on title uniqueness validation
Route::put('todo/status/{id}', function(Request $request, $id) {
    $todo = Todo::findOrFail($id);
    $todo ->update($request->all());
    $todo->save();
});

Route::get('todo/user/{id}', function($id) {
    return DB::table('todos')
                ->where('user_id', $id)
                ->orderByRaw('created_at DESC')
                ->get();
});
