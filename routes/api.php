<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;

Route::prefix('book')->group(function(){
    Route::get("/all", [BookController::class, "index"]);
    Route::get("/detail/{id}", [BookController::class, "detail"]);
    Route::post("/add", [BookController::class, "store"]);
    Route::put("/edit/{id}", [BookController::class, "edit"]);
    Route::delete("/delete/{id}", [BookController::class, "delete"]);
});

Route::prefix('category')->group(function(){
    Route::get("/all", [CategoryController::class, "index"]);
    Route::get("/detail/{id}", [CategoryController::class, "detail"]);
    Route::post("/add", [CategoryController::class, "store"]);
    Route::put("/edit/{id}", [CategoryController::class, "edit"]);
    Route::delete("/delete/{id}", [CategoryController::class, "delete"]);
});

Route::prefix('author')->group(function(){
    Route::get("/all", [AuthorController::class, "index"]);
    Route::get("/detail/{id}", [AuthorController::class, "detail"]);
    Route::post("/add", [AuthorController::class, "store"]);
    Route::put("/edit/{id}", [AuthorController::class, "edit"]);
    Route::delete("/delete/{id}", [AuthorController::class, "delete"]);
});
