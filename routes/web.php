<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang', function () {
    return view('tentang');

});

Route::get('/sapa/{nama}', function ($nama) {
    return "Halo, $nama! Selamat datang di Cuy toko.";
});

Route::get('/kategori/{nama?}', function ($nama = 'Selamat berbelanja') {
    return "Menampilkan Cuy toko: $nama";
});
