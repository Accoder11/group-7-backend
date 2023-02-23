<?php

use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/posts', [PostController::class, 'index']);

Route::post('/posts/add', [PostController::class, 'store']);

Route::get('/posts/{post}', [PostController::class, 'show']);

Route::put('/posts/{post}', [PostController::class, 'update']);

Route::delete('/posts/{post}', [PostController::class, 'destroy']);

Route::get('/posts/{post}/edit', [PostController::class, 'edit']);

Route::post('/posts/{post}/upload-image', [PostController::class, 'uploadImage']);

Route::get('/posts/{category}', 'PostController@index');

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
