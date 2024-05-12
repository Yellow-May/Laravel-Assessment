<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::group(['middleware' => "auth:sanctum"], function () {
    Route::delete('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('lookups')->name('lookups.')->group(function () {
        Route::get("categories", [CategoryController::class, "all"])->name("categories");
    });

    Route::group(["prefix" => "products", "name" => "products"], function () {
        Route::get('', [ProductController::class, 'all'])->name('all');
        Route::post('', [ProductController::class, 'create'])->name('create');
        Route::get('{id}', [ProductController::class, 'single'])->name('single');
        Route::patch('{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('{id}', [ProductController::class, 'delete'])->name('delete');
    });
});
