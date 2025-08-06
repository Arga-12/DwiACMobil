<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/pelanggan', function () {
    return view('pelanggan');
});

Route::get('/layanan', function () {
    return view('layanan');
});

Route::get('/welcome', function () {
    return view('welcome');
});
