<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// PUBLIC
Route::post("/login", [AuthController::class, "login"])
    ->middleware("throttle:5,1");

// USERS AND ADMINS
Route::middleware("auth:sanctum")->group(function () {

    // Current account
    Route::get("/user", [AuthController::class, "user"]);
    Route::post("/logout", [AuthController::class, "logout"]);

    // Tickets
    Route::get("/tickets", [TicketController::class, "index"]);
    Route::get("/tickets/{ticket}", [TicketController::class, "show"]); 
    Route::post("/tickets", [TicketController::class, "store"]);
    Route::put("/tickets/{ticket}", [TicketController::class, "update"]);
    Route::delete("/tickets/{ticket}", [TicketController::class, "destroy"]);
    
    // Category
    Route::get("/categories", [CategoryController::class, "index"]);
    
    // ADMINS ONLY   
    Route::middleware("admin")->group(function () {

        // Category Section
        Route::post("/categories", [CategoryController::class, "store"]);
        Route::put("/categories/{category}", [CategoryController::class, "update"]);
        Route::delete("/categories/{category}", [CategoryController::class, "destroy"]);

        // User Section
        Route::get("/users", [UserController::class, "index"]);
        Route::post("/users", [UserController::class, "store"]);
        Route::put("/users/{user}", [UserController::class, "update"]);
        Route::delete("/users/{user}", [UserController::class, "destroy"]);
    });
     
});

 
    

    
    
    
    