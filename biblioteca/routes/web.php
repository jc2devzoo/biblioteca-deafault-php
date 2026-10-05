<?php


use App\Http\Controllers\UsersControllers;
use Illuminate\Support\Facades\Route;

Route::get('/', [UsersControllers::class, 'index'])->name('index');
