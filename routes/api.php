<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;


// PUBLIC
Route::post("/login", [AuthController::class, "login"])
    ->middleware("throttle:5,1");
Route::post("/register", [AuthController::class, "register"])
    ->middleware("throttle:5,1");
Route::post("/forgot-password", [PasswordResetController::class, "sendResetLink"])
    ->middleware("throttle:5,1");
Route::post("/reset-password", [PasswordResetController::class, "resetPassword"])
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

    // Replies
    Route::get("/tickets/{ticket}/replies", [ReplyController::class, "index"]);
    
    // ADMINS ONLY   
    Route::middleware("admin")->group(function () {

        // Ticket Section
        Route::patch("/tickets/{ticket}/status", [TicketController::class, "updateStatus"]);
        Route::patch("/tickets/{ticket}/assigned", [TicketController::class, "updateAssigned"]);

        // Notes Section
        Route::get("/tickets/{ticket}/notes", [NoteController::class, "index"]);
        Route::post("/tickets/{ticket}/notes", [NoteController::class, "store"]);
        Route::get("/notes/{note}", [NoteController::class, "show"]);
        Route::put("/notes/{note}", [NoteController::class, "update"]);
        Route::delete("/notes/{note}", [NoteController::class, "destroy"]);
        // Replies Section
        Route::post("/tickets/{ticket}/replies", [ReplyController::class, "store"]);
        Route::get("/replies/{reply}", [ReplyController::class, "show"]);
        Route::put("/replies/{reply}", [ReplyController::class, "update"]);
        Route::delete("/replies/{reply}", [ReplyController::class, "destroy"]);
        // Category Section
        Route::post("/categories", [CategoryController::class, "store"]);
        Route::put("/categories/{category}", [CategoryController::class, "update"]);
        Route::delete("/categories/{category}", [CategoryController::class, "destroy"]);

        // User Section
        Route::get("/users", [UserController::class, "index"]);
        Route::get("/admins", [UserController::class, "admins"]);
        Route::put("/users/{user}", [UserController::class, "update"]);
        Route::get("/users/{user}", [UserController::class, "show"]);
        Route::delete("/users/{user}", [UserController::class, "destroy"]);
    });
     
});

 
    

    
    
    
    