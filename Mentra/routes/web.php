<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('/');

Auth::routes();

Route::get('/home', function () {
    return view('welcome');
})->name('/home');


Route::get('/sleepredict', [App\Http\Controllers\PredictController::class, 'index'])->name('sleepredict');
Route::post('/sleepredict_result', [App\Http\Controllers\PredictController::class, 'predict'])->name('sleepredict_result');


Route::get('/youtube-form', function () {
    return view('youtube_form');
})->name('youtube_video');



Route::post('/analyze-youtube', [YouTubeAnalysisController::class, 'analyze'])->name('analyze.youtube');


//chatbot
Route::get('/chatbot', [MusicController::class, 'chatbot'])->name('chatbot.index');
Route::post('/chatbot-msg', [MusicController::class, 'chat'])->name('chatbot-msg');