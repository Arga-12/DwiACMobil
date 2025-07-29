<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $seseorang = [
        "nama" => "Aeruga",
        "email" => "argarill226@gmail.com",
    ];
    dd($seseorang);
    return view('welcome');
});

Route::get('/beranda', function () {
    return view('beranda');
});
