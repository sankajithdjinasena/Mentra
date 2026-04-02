<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');








//chatbot
Route::get('/chatbot', [MusicController::class, 'chatbot'])->name('chatbot.index');
Route::post('/chatbot-msg', [MusicController::class, 'chat'])->name('chatbot-msg');