<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'games' => GameController::class,
    'genres' => GenreController::class
]);
