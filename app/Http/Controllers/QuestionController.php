<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionAnswer;

class QuestionController extends Controller
{
    public function get($id)
    {
        $data = [
            'question' => Question::find($id)->question,
            'answers' => QuestionAnswer::where('question_id', $id)->get(),
        ];
        
        return json_encode($data);
    }

    public function adminGet($id)
    {
        $question = Question::find($id);

        $data = [
            'question' => $question->question,
            'true_answer' => $question->question_answer_id,
            'explanation' => $question->explanation,
            'answers' => QuestionAnswer::where('question_id', $id)->get(),
        ];

        return json_encode($data);
    }

    public function updateQuestion(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|numeric',
            'question' => 'required',
        ]);

        Question::find($request->id)->update([
            'question' => $request->question,
        ]);

        return redirect()->back();
    }

    public function updateExplanation(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|numeric',
            'explanation' => 'required',
        ]);

        Question::find($request->id)->update([
            'explanation' => $request->explanation,
        ]);

        return redirect()->back();
    }

    public function updateTrueAnswer(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|numeric',
            'question_answer_id' => 'required|numeric',
        ]);

        Question::find($request->id)->update([
            'question_answer_id' => $request->question_answer_id,
        ]);

        return 'Jawaban benar berhasil diganti';
    }

}
