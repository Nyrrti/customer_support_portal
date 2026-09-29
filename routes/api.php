<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//PUBLIC
Route::post("/login", [AuthController::class, "login"])
    ->middleware("throttle:5,1");

//PROTECTED
Route::middleware("auth:sanctum")->group(function () {
    Route::get("/user", [AuthController::class, "user"]);
    Route::post("/logout", [AuthController::class, "logout"]);
// Logged in
    Route::get("/tickets", [TicketController::class, "index"]);
    Route::get("/categories", [CategoryController::class, "index"]);
    Route::get("/users", [UserController::class, "index"]);
    Route::get("/tickets/{ticket}", [TicketController::class, "show"]); 
    
    Route::put("/tickets/{ticket}", [TicketController::class, "update"]);
    Route::put("/categories/{category}", [CategoryController::class, "update"]);
    Route::put("/users/{user}", [UserController::class, "update"]);
    
    Route::post("/tickets", [TicketController::class, "store"]);
    Route::post("/categories", [CategoryController::class, "store"]);
    Route::post("/users", [UserController::class, "store"]);
    
    Route::delete("/tickets/{ticket}", [TicketController::class, "destroy"]);
    Route::delete("/categories/{category}", [CategoryController::class, "destroy"]);
    Route::delete("/users/{user}", [UserController::class, "destroy"]);
});