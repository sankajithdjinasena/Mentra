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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
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
Route::post('/articles', [StudyArticleController::class, 'storeuserartical'])->name('articles.store');


Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'storeOrUpdate'])->name('profile.update');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');

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
    Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');


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
    Route::post('/articles/{id}/approve', [StudyArticleController::class, 'approve'])->name('Article.approve');
    Route::post('/articles/{id}/unapprove', [StudyArticleController::class, 'unapprove'])->name('Article.unapprove');


});




// Route::get('/test-sms', function() {
//     // 1. Check if ENV variables exist
//     $host = env('INFOBIP_BASE_URL');
//     $apiKey = env('INFOBIP_API_KEY');

//     if (!$host || !$apiKey) {
//         return "Error: Missing Infobip credentials in .env file.";
//     }

//     try {
//         // 2. Setup Configuration
//         $configuration = new Configuration(
//             host: $host,
//             apiKey: $apiKey
//         );

//         $smsApi = new SmsApi(config: $configuration);

//         // 3. Build the Message
//         $destination = new SmsDestination(to: "94765536428"); // Removed '+' as some SDK versions prefer digits only

//         $message = new SmsTextualMessage(
//             destinations: [$destination],
//             text: "Hello from Mentra! Your SMS integration is working.",
//             from: "MentraApp" // Added a 'from' identifier
//         );

//         $request = new SmsAdvancedTextualRequest(messages: [$message]);

//         // 4. Send
//         $response = $smsApi->sendSmsMessage($request);

//         return dd($response);

//     } catch (Exception $e) {
//         return "Failed to send SMS: " . $e->getMessage();
//     }
// });


// Route::get('/test-sms', function () {

//     $host = env('INFOBIP_BASE_URL');
//     $apiKey = env('INFOBIP_API_KEY');

//     try {
//         $configuration = new \Infobip\Configuration(
//             host: $host,
//             apiKey: $apiKey
//         );

//         $smsApi = new \Infobip\Api\SmsApi(config: $configuration);

//         $destination = new \Infobip\Model\SmsDestination(
//             to: '94713545642'
//         );

//         $message = new \Infobip\Model\SmsTextualMessage(
//             destinations: [$destination],
//             text: "Hello from Mentra!",
//             from: "InfoSMS"
//         );

//         $request = new \Infobip\Model\SmsAdvancedTextualRequest(
//             messages: [$message]
//         );

//         $response = $smsApi->sendSmsMessage($request);

//      $details = $response->getMessages()[0];

//      $messageId = $details->getMessageId();

// return [
//     'messageId' => $messageId,
//     'status' => $details->getStatus()->getName(),
// ];

//     } catch (\Exception $e) {
//         return "Final Error Check: " . $e->getMessage();
//     }
// });