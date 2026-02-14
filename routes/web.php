<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('calculator');
});
Route::get('/calculator', function () {
    return view('calculator');
});
