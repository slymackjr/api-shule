<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\SchoolRequestController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Routes for fetching regions, districts, and wards
Route::get('/regions', [ResourcesController::class, 'regions'])->name('regions');
Route::get('/district', [ResourcesController::class, 'districts'])->name('districts');
Route::get('/wards', [ResourcesController::class, 'wards'])->name('wards');
Route::post("/school-registration", [SchoolRequestController::class, 'store'])->name('schoolrequest.store');
Route::post('/teacher-login', [LoginController::class, 'authenticateTeacher']);
Route::middleware(['auth:sanctum','abilities:Teacher'])->get('/teacher-details', [LoginController::class, 'teacherDetails']);
