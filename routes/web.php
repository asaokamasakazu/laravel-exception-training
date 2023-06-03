<?php

declare(strict_types=1);

use App\Http\Controllers\Division\DivisionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DivisionController::class, 'index'])->name('division');
Route::post('/calculate', [DivisionController::class, 'calculate'])->name('calculate');
