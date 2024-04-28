<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Calculator extends Controller
{
    public function view() {
        return view('calculator.view', [
            'title' => 'Calculator Project'
        ]);
    }
}
