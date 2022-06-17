<?php

use App\Http\Controllers\API\EmailVerificationController;
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

Route::group(['prefix' => 'v1'], function () {
    Route::get('test', fn() => response()->json(['hello' => 'world'])); // TODO: just test function

//    Email verification API
    Route::post('emila/verify/{id}', [EmailVerificationController::class, 'verify'])
        ->name('emailVerification.verify');
    Route::post('email/resend', [EmailVerificationController::class, 'resend']);
});
