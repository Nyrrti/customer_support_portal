<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// GET
Route::get('/tickets', [TicketController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);


//POST
Route::post('/tickets', [TicketController::class, 'store']);