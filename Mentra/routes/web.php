<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\StudyArticleController;
use App\Http\Controllers\StudyInfoController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\YouTubeAnalysisController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

Route::get('/todolist', [TodolistController::class, 'index'])->name('todolist.index');
Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders.index');
Route::get('/studyinfo', [StudyInfoController::class, 'index'])->name('studyinfo.index');
Route::get('/music', [MusicController::class, 'index'])->name('music.index');
Route::get('/chatbot', [MusicController::class, 'chatbot'])->name('chatbot.index');
Route::post('/chatbot-msg', [MusicController::class, 'chat'])->name('chatbot-msg');
Route::get('/articals', [MusicController::class, 'articalindex'])->name('articals.index');
Route::get('/community', [QuestionController::class, 'index'])->name('community');
Route::get('/top-focuzers', [ChallengeController::class, 'topFocuzers'])->name('topfocuzers.index');
Route::get('/study-challenges', [ChallengeController::class, 'showChallenges'])->name('userchallenges.index');


Route::middleware(['auth'])->group(function () {
    Route::get('/study_progress', [StudyInfoController::class, 'progressindex'])->name('study_progress.index');
    Route::post('/reminders/add', [ReminderController::class, 'store'])->name('reminders.store');
    Route::post('/todolist/add', [TodolistController::class, 'store'])->name('todolist.store');
    Route::post('/studyinfo/add', [StudyInfoController::class, 'store'])->name('studyinfo.store');
    Route::post('/studyinfo/search', [StudyInfoController::class, 'searchMonth'])->name('studyinfo.search');
    Route::delete('/reminders/{id}', [ReminderController::class, 'destroy'])->name('reminders.destroy');
    Route::put('/todolist/{todo}/markdone', [TodoListController::class, 'markDone'])->name('todolist.markdone');
    Route::delete('/todolist/{todo}', [TodoListController::class, 'delete'])->name('todolist.delete');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.submit');



    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
    Route::post('/questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');

    // admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/dash_users', [HomeController::class, 'dash_user'])->name('dash_users');
    Route::get('/dash_top', [HomeController::class, 'dash_top'])->name('dash_top');
    Route::get('/dash_feedbacks', [HomeController::class, 'dash_feedbacks'])->name('dash_feedbacks');
    Route::get('/dash_challenge', [HomeController::class, 'dash_challenge'])->name('dash_challenge');
    Route::get('/dash_viewchallenge', [ChallengeController::class, 'index'])->name('dash_viewchallenge');

    Route::get('/admin/challenges/create', [ChallengeController::class, 'index'])->name('challenges.create');
    Route::post('/admin/challenges', [ChallengeController::class, 'store'])->name('challenges.store');
    Route::get('/admin/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::post('/admin/challenges/{id}/delete', [ChallengeController::class, 'destroy'])->name('challenges.destroy');


    Route::post('/admin/Article', [StudyArticleController::class, 'store'])->name('Article.store');
    Route::get('/dash_article', [StudyArticleController::class, 'index'])->name('dash_article');
    Route::get('/admin/articles', [StudyArticleController::class, 'index_view'])->name('Article.index');
    Route::get('/admin/articles/{id}/edit', [StudyArticleController::class, 'edit'])->name('Article.edit');
    Route::put('/admin/articles/{id}', [StudyArticleController::class, 'update'])->name('Article.update');
    Route::delete('/admin/articles/{id}', [StudyArticleController::class, 'destroy'])->name('Article.destroy');
    Route::post('/admin/articles/{id}/restore', [StudyArticleController::class, 'restore'])->name('Article.restore');


});


// Route::get('/send-test-email', function () {
//     Mail::raw('Test email from Laravel', function ($message) {
//         $message->to('sanodyav@gmail.com')
//                 ->subject('Test Email');
//     });
//     return 'Test email sent!';
// });
