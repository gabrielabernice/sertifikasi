<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'welcome']);

Route::get('/books', [BookController::class, 'view']);
Route::post('/create_book', [BookController::class, 'create']);
Route::post('/update_book', [BookController::class, 'update']);
Route::post('/delete_book', [BookController::class, 'delete']);

Route::get('/members', [MemberController::class, 'view']);
Route::post('/create_member', [MemberController::class, 'create']);
Route::post('/update_member', [MemberController::class, 'update']);
Route::post('/delete_member', [MemberController::class, 'delete']);

Route::get('/categories', [CategoryController::class, 'view']);
Route::post('/create_category', [CategoryController::class, 'create']);
Route::post('/update_category', [CategoryController::class, 'update']);
Route::post('/delete_category', [CategoryController::class, 'delete']);