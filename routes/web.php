<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function() {
    return view('about', ['nama' => 'Nizartio Candra Adinata']);
});

Route::get('/blog', function() {
    return view('blog');
});

Route::get('/contact', function() {
    return view('contact');
});

Route::resource('employees', EmployeeController::class);
