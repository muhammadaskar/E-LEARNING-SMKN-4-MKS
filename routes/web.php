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

use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

Route::get('send-email', function () {
    $mailData = [
        'title' => 'Sample Title From Mail',
        'body' => 'This is sample content we have added for this test mail'

    ];

    Mail::to("muhammadaskar74@gmail.com")->send(new TestEmail($mailData));

    dd("Mail Sent Successfully!");
});
