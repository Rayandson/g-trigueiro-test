<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SigninController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\SignoutController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [HomeController::class, "index"])
    ->name("home")
    ->middleware("auth");

Route::get("/register", [RegisterController::class, "index"])
    ->name("register")
    ->middleware("guest");
Route::post("/register", [RegisterController::class, "register"])->name("register");

Route::get("/signin", [SigninController::class, "index"])
    ->name("signin")
    ->middleware("guest");
Route::post("/signin", [SigninController::class, "signin"])->name("signin");

Route::post("/logout", [SignoutController::class, "logout"])->name("logout");

Route::get("/records", [RecordController::class, "index"])->name("records");

Route::post("/update-record-status", [RecordController::class, "updateStatus"])->name("updateRecordStatus");

Route::post("/create-record", [RecordController::class, "create"])->name("createRecord");

Route::post("/create-record-by-upload", [RecordController::class, "createByUpload"])->name("createRecordByUpload");

Route::get("new-record", [RecordController::class, "newRecord"])->name("newRecord");
