<?php

use App\Http\Controllers\API\v1\Admin\UserController;
use App\Http\Controllers\API\v1\AdminAuthController;
use App\Http\Controllers\API\v1\AuthController;
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

// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'
// ], function($router){
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::post('/register', [AuthController::class, 'register']);
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::prefix('v1/user')->group(function () {
    Route::middleware(['api'])->group(function() {
        Route::get('/', function() {
            return response()->json(['success' => true, 'user' => auth()->user()]);
        });
    });
});

Route::group(['prefix' => 'v1/admin', 'namespace' => 'api\v1'], function() {
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::middleware(['api','admin'])->group(function() {
        Route::get('test', function() {
            return response()->json(['success' => true, 'user' => auth()->user()]);
        });
        Route::get('/user-listing', [UserController::class, 'index']);
    });
});
