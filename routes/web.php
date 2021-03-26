<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\QuestionTypeController;
use App\Http\Controllers\QuestionPacketController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionAnswerController;

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

Route::view('/', 'welcome');

Auth::routes();

// ExamType
Route::group(['prefix' => '/exam', 'as' => 'examtype.', 'middleware' => 'admin.auth'], function()
{
    Route::post('/create', [ExamTypeController::class, 'create'])->name('create');
    Route::post('/update', [ExamTypeController::class, 'update'])->name('update');
    Route::post('/delete', [ExamTypeController::class, 'delete'])->name('delete');
    Route::post('/release', [ExamTypeController::class, 'release'])->name('release');

});

// QuestionType
Route::group(['prefix' => '/questiontype', 'as' => 'questiontype.', 'middleware' => 'admin.auth'], function()
{
    Route::post('/create', [QuestionTypeController::class, 'create'])->name('create');
    Route::post('/update', [QuestionTypeController::class, 'update'])->name('update');
    Route::post('/delete', [QuestionTypeController::class, 'delete'])->name('delete');
    Route::post('/release', [QuestionTypeController::class, 'release'])->name('release');
});

// QuestionPacket
Route::group(['prefix' => '/questionpacket', 'as' => 'questionpacket.', 'middleware' => 'admin.auth'], function()
{
    Route::post('/create', [QuestionPacketController::class, 'create'])->name('create');
    Route::post('/update', [QuestionPacketController::class, 'update'])->name('update');
    Route::post('/delete', [QuestionPacketController::class, 'delete'])->name('delete');
    Route::post('/release', [QuestionPacketController::class, 'release'])->name('release');
});

// QuestionAnswer
Route::group(['prefix' => '/questionanswer', 'as' => 'questionanswer.', 'middleware' => 'admin.auth'], function()
{
    Route::post('/create', [QuestionAnswerController::class, 'create'])->name('create');
    Route::post('/udpate', [QuestionAnswerController::class, 'update'])->name('update');
    Route::post('/delete', [QuestionAnswerController::class, 'delete'])->name('delete');
});

// Question
Route::group(['prefix' => '/question', 'as' => 'question.', 'middleware' => 'admin.auth'], function()
{
    Route::post('/update/question', [QuestionController::class, 'updateQuestion'])->name('update.question');
    Route::post('/update/explanation', [QuestionController::class, 'updateExplanation'])->name('update.explanation');
    Route::post('/update/trueanswer', [QuestionController::class, 'updateTrueAnswer'])->name('update.trueanswer');
});

// Admin
Route::group(['prefix' => '/admin', 'middleware' => 'admin.auth'], function()
{
    Route::get('/', function(){ return redirect()->route('admin.dashboard'); });
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'userlist'])->name('admin.user.list');

    // Soal
    Route::group(['prefix' => '/soal'], function()
    {
        Route::get('/', [AdminController::class, 'examList'])->name('admin.exam.list');
        Route::get('/{type}', [AdminController::class, 'questionTypeList'])->name('admin.questiontype.list');
        Route::get('/{type}/{packet}', [AdminController::class, 'questionList'])->name('admin.question.list');
    });

    // Route::get('/question/{id}', [QuestionController::class, 'adminGet'])->name('admin');
});

// Student
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

    // Try Out
    Route::group(['prefix' => '/tryout'], function()
    {
        Route::get('/', [StudentController::class, 'examList'])->name('exam.list');
        Route::get('/{type}', [StudentController::class, 'questionTypeList'])->name('questiontype.list');
        Route::get('/{type}/{packet}', [StudentController::class, 'questionPacketInstruction'])->name('questionpacket.instruction');
        Route::get('/{type}/{packet}/start', [StudentController::class, 'testStart'])->name('test.start');
        Route::get('/{type}/{packet}/result', [StudentController::class, 'testResult'])->name('test.result');
        Route::get('/{type}/{packet}/discussion', [StudentController::class, 'testDiscussion'])->name('test.discussion');
        
        Route::post('/answer/update', [StudentController::class, 'answerUpdate'])->name('answer.update');
    });
});