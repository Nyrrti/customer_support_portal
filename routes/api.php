<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


//PUBLIC
Route::post("/login", [AuthController::class, "login"])
    ->middleware("throttle:5,1");

//PROTECTED
Route::middleware("auth:sanctum")->group(function () {
    Route::get("/user", [AuthController::class, "profile"]);
    Route::get("/logout", [AuthController::class, "logout"]);

    Route::get("/categories", [CategoryController::class, "index"]);

    Route::get("/tickets", [TicketController::class, "index"]);
    Route::post("/tickets", [TicketController::class, "store"]);
});