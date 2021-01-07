<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\Task;

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

// Route definition...
Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks/{task}', [TaskController::class, 'show']);
Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
Route::patch('/tasks/{task}', [TaskController::class, 'update']);
// Route::get('/tasks/{task}', function (Task $task) {
//     return dd($task::first());
// });
// // Controller method definition...
// public function show(User $user)
// {
//     return view('user.profile', ['user' => $user]);
// }

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('/', "TaskController@index");
// Route::post("/task", "TaskController@store");
// Route::get("/{id}/complete", "TaskController@complete");
// Route::get("/{id}/delete", "TaskController@destroy");

// Route::post('/', function (Task $task) {
//     return dd($task);
// });
// Route::get('/task', function (Task $task) {
//     return dd($task);
// });
// // Route::get('/tasks/{id}', function (Task $task) {
// //     return dd($task);
// // });
// Route::get('/task/{id}', function (Task $task) {
//     return dd($task->first());
// });
