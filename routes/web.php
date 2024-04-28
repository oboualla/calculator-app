<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Calculator\Calculator;

Route::get('/', function () {
    return redirect(route('calculator.view'));
});

Route::get('/calculator', [Calculator::class, 'view'])->name('calculator.view');
