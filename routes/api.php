<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::prefix('book')->group(function(){
    Route::get("/", [BookController::class, "index"]);
    Route::get("/detail/{id}", [BookController::class, "show"]);
    Route::post("/add", [BookController::class, "store"]);
    Route::put("/update/{id}", [BookController::class, "update"]);
    Route::delete("/delete/{id}", [BookController::class, "destroy"]);
});
