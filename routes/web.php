<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function (User $user) {

    return view('welcome');
});

Route::get('/Mariam', function () {
    return response()->json(['message' => 'Hello, World!']);
});

Route::get('/Mariam', function () {







    return response()->json(['message' => 'Hello, World!']);
});
