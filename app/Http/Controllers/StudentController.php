<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ExamType;
use App\Models\QuestionType;
use App\Models\QuestionPacket;
use App\Models\Question;
use App\Models\UserQuestionPacket;
use App\Models\UserQuestionPacketAnswer;

class StudentController extends Controller
{
    public function dashboard()
    {
        switch (Auth::user()->role()->name) {
            case 'Admin':
                return redirect()->route('admin.dashboard');
            case 'School':
                return redirect()->route('school.dashboard');
            case 'Student':
                return view('student.dashboard');
        }
    }
    
    public function examList()
    {
        $exams = ExamType::where('status', 1)->get();
        return view('student.examlist', ['exams' => $exams]);
    }

    public function questionTypeList($slug)
    {
        $exam = ExamType::where('slug', $slug)->first();
        if( !$exam->status ) return abort(404);

        $questionTypes = $exam->questionTypes()->where('status', 1);
        return view('student.questionTypeList', ['questionTypes' => $questionTypes,
                                                 'exam' => $exam]);
    }

    public function questionPacketInstruction($exam, $packet)
    {
        $examType= ExamType::where('slug', $exam)->first();
        $questionPacket = QuestionPacket::where('slug', $packet)->first();

        if( !$examType || !$questionPacket || !$examType->status || !$questionPacket->status ) return abort(404);

        return view('student.instruction', ['exam' => $examType,
                                            'questionPacket' => $questionPacket]);
    }

    public function testStart($exam, $packet)
    {
        $exam = ExamType::where('slug', $exam)->first();
        if( !$exam->status ) return abort(404);

        $questionPacket = QuestionPacket::where('slug', $packet)->first();
        if( !$questionPacket || !$questionPacket->status ) return abort(404);

        $questions = $questionPacket->questions();

        // Check if any data of user question packet
        $userQuestionPacket = UserQuestionPacket::where([['user_id', Auth::user()->id],
                                                         ['question_packet_id', $questionPacket->id]])->first();

        if( !$userQuestionPacket )
        {
            for ( $i = 0 ; $i < $questions->count(); $i++)
            {
                UserQuestionPacketAnswer::create([
                    'user_id' => Auth::user()->id,
                    'question_packet_id' => $questionPacket->id,
                    'question_id' => $questions[$i]->id,
                ]);
            }

            $userQuestionPacket = UserQuestionPacket::create([
                'user_id' => Auth::user()->id,
                'question_packet_id' => $questionPacket->id,
                'ended_at' => date('Y-m-d H:i:s', strtotime('now +'.$questionPacket->time.' minutes +5 seconds')),
            ]);
        }

        $userAnswers =  UserQuestionPacketAnswer::getAnswers( Auth::user()->id, $questionPacket->id );

        return view('student.questionList', ['questions' => $questions,
                                             'userAnswers' => $userAnswers,
                                             'questionPacket' => $questionPacket,
                                             'exam' => $exam,
                                             'endedAt' => $userQuestionPacket->ended_at]);
    }

    public function answerUpdate(Request $request)
    {
        $validated = $request->validate([
            'question_id' => 'required',
            'question_answer_id' => 'required',
        ]);

        $userAnswer = UserQuestionPacketAnswer::getAnswer( Auth::user()->id, $request->question_id );
        $userAnswer->update([
            'question_answer_id' => $request->question_answer_id,
        ]);

        return 'Success';
    }

    public function testResult($exam, $packet)
    {
        $exam = ExamType::where('slug', $exam)->first();
        if( !$exam->status ) return abort(404);

        $questionPacket = QuestionPacket::where('slug', $packet)->first();
        if( !$questionPacket || !$questionPacket->status ) return abort(404);

        $userAnswers = UserQuestionPacketAnswer::getAnswers( Auth::user()->id, $questionPacket->id );
        $questions = $questionPacket->questions();

        $nullAnswer = 0;
        $trueAnswer = 0;
        $falseAnswer = 0;

        for ( $i = 0 ; $i < $questions->count(); $i++)
        {
            if( $userAnswers[$i]->question_answer_id == NULL ) continue;
            else if( $userAnswers[$i]->question_answer_id == $questions[$i]->question_answer_id ) $trueAnswer++;
            else $falseAnswer++;
        }

        $score = $trueAnswer / $questions->count();

        $userQuestionPacket = UserQuestionPacket::getPacket( Auth::user()->id, $questionPacket->id );
        $userQuestionPacket->update([
            'completed' => '1',
            'score' => $score,
            'trueAnswer' => $trueAnswer,
            'falseAnswer' => $falseAnswer,
            'nullAnswer' => $nullAnswer,
        ]);

        return view('student.testResult', ['userQuestionPacket' => $userQuestionPacket,
                                           'questions' => $questions,
                                           'questionPacket' => $questionPacket,
                                           'exam' => $exam,]);
    }

    public function testDiscussion( $exam, $packet )
    {
        $questionPacket = QuestionPacket::where('slug', $packet)->first();
        if( !$questionPacket || !$questionPacket->status ) return abort(404);

        $questions = $questionPacket->questions();

        // Check if any data of user question packet
        $userQuestionPacket = UserQuestionPacket::where([['user_id', Auth::user()->id],
                                                         ['question_packet_id', $questionPacket->id]])->first();

        $userAnswers =  UserQuestionPacketAnswer::getAnswers( Auth::user()->id, $questionPacket->id );

        return view('student.testDiscussion', ['questions' => $questions,
                                             'userAnswers' => $userAnswers,
                                             'questionPacket' => $questionPacket]);
    }
}
