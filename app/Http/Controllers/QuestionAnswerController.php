<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionAnswer;


class QuestionAnswerController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'question_id' => 'required|numeric',
            'answer' => 'required',
        ]);

        QuestionAnswer::create([
            'question_id' => $request->question_id,
            'answer' => $request->answer,
        ]);

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|numeric',
            'answer' => 'required',
        ]);

        QuestionAnswer::find($request->id)->update([
            'answer' => $request->answer,
        ]);

        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|numeric',
        ]);

        QuestionAnswer::find($request->id)->delete();

        return redirect()->back();
    }
}
