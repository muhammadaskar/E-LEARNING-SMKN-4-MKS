<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('admin.index');
});

Route::get('/tables', function () {
    return view('admin.tables');
});

Route::get('/tes', function () {
    $data = "123.String";
    $whatIWant = substr($data, strpos($data, ".") + 1);
    echo $whatIWant;
});
