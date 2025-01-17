<?php

use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\TenantsController;
use App\Http\Controllers\Dashboard\UsersController;
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->middleware('auth')->prefix('dashboard')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::resource('users', UsersController::class)->except('show');

    Route::resource('roles', RolesController::class)->except('show');

    Route::resource('tenants', TenantsController::class)->except('show');
});