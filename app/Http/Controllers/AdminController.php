<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use App\Models\ExamType;
use App\Models\QuestionType;
use App\Models\QuestionPacket;
use App\Models\Question;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function examList()
    {
        $exams = ExamType::all();
        return view('admin.examlist', ['exams' => $exams]);
    }

    public function questionTypeList($slug)
    {
        $exam = ExamType::where('slug', $slug)->first();
        $questionTypes = $exam->questionTypes();
        return view('admin.questionTypeList', ['questionTypes' => $questionTypes,
                                               'exam' => $exam]);
    }

    public function questionList($type, $packet)
    {
        $questionPacket = QuestionPacket::where('slug', $packet)->first();
        $questions = $questionPacket->questions();

        return view('admin.questionList', ['questions' => $questions,
                                           'questionPacket' => $questionPacket]);
    }

    public function userlist()
    {
        $users = User::where('role_id', 
                    Role::where('name', 'Student')->first()->id
                 )->get();
        return view('admin.userlist', ['users' => $users]);
    }

}
