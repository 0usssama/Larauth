<?php

use Illuminate\Http\Request;
use App\Http\Controllers\HelloWorld;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotController;

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
/*
Testing purposes
Route::get('/user', [AuthController::class, 'getUser'])->middleware("auth:api");
*/
Route::get('/hello', [HelloWorld::class, 'hello']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, "register"]);
Route::post('/forgot', [ForgotController::class, "forgot"]);
Route::post("/reset", [ForgotController::class, "reset"]);