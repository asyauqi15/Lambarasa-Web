<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\QuestionTypeController;
use App\Http\Controllers\QuestionPacketController;

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

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// ExamType
Route::group(['prefix' => '/exam', 'as' => 'examtype.', 'middleware' => 'admin.auth'], function()
{
    Route::post('/create', [ExamTypeController::class, 'create'])->name('create');
    Route::post('/update', [ExamTypeController::class, 'update'])->name('update');
    Route::post('/delete', [ExamTypeController::class, 'delete'])->name('delete');
});

// QuestionType
Route::group(['prefix' => '/questiontype', 'as' => 'questiontype.', 'middleware' => 'admin.auth'], function()
{
    Route::post('/create', [QuestionTypeController::class, 'create'])->name('create');
    Route::post('/update', [QuestionTypeController::class, 'update'])->name('update');
    Route::post('/delete', [QuestionTypeController::class, 'delete'])->name('delete');
});

// QuestionPacket
Route::group(['prefix' => '/questionpacket', 'as' => 'questionpacket.', 'middleware' => 'admin.auth'], function()
{
    Route::post('/create', [QuestionPacketController::class, 'create'])->name('create');
    Route::post('/update', [QuestionPacketController::class, 'update'])->name('update');
    Route::post('/delete', [QuestionPacketController::class, 'delete'])->name('delete');
});

// Admin
Route::group(['prefix' => '/admin', 'middleware' => 'admin.auth'], function()
{
    Route::get('/', function(){ return redirect()->route('admin.dashboard'); });
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'userlist'])->name('admin.user.list');
    Route::get('/soal', [AdminController::class, 'examList'])->name('admin.exam.list');
    Route::get('/soal/{type}', [AdminController::class, 'questionTypeList'])->name('admin.questiontype.list');
    Route::get('/soal/{type}/{packet}', [AdminController::class, 'questionList'])->name('admin.question.list');
});