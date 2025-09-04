<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');


Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::apiResource('users', UsersController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('articles', ArticleController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('units', UnitController::class);
Route::apiResource('entries', EntryController::class);
Route::apiResource('issues', IssueController::class);
Route::apiResource('persons', PersonController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('presentations', PresentationController::class);


