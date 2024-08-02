<?php

use App\Http\Controllers\BestReplyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/replies/{reply}/best', BestReplyController::class);
