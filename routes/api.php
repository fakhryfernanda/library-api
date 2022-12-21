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

Route::prefix('category')->group(function(){
    Route::get("/", [CategoryController::class, "index"]);
    Route::get("/detail/{id}", [CategoryController::class, "show"]);
    Route::post("/add", [CategoryController::class, "store"]);
    Route::put("/update/{id}", [CategoryController::class, "update"]);
    Route::delete("/delete/{id}", [CategoryController::class, "destroy"]);
});

Route::prefix('author')->group(function(){
    Route::get("/", [AuthorController::class, "index"]);
    Route::get("/detail/{id}", [AuthorController::class, "show"]);
    Route::post("/add", [AuthorController::class, "store"]);
    Route::put("/update/{id}", [AuthorController::class, "update"]);
    Route::delete("/delete/{id}", [AuthorController::class, "destroy"]);
});
