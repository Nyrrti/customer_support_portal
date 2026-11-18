<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifyEmailController;

Route::get("/email/verify/{id}/{hash}", VerifyEmailController::class)
    ->middleware(["signed", "throttle:6,1"])
    ->name("verification.verify");

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');


