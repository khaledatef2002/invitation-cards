<?php

use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/dashboard.php';
require_once __DIR__ . '/auth.php';

Route::middleware('tenant')->group(function(){
    Route::get('/', [InvitationController::class, 'index']);
    
    Route::post('/invitation/generate/{type}', [InvitationController::class, 'generate']);
    
    Route::get('/captacha/generate', [CaptchaController::class, 'generate']);
    Route::get('/captacha/read', [CaptchaController::class, 'read']);
});
