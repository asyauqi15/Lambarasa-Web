<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\QuestionType;

class QuestionTypeController extends Controller
{
    public function create(Request $request)
    {
        $request['slug'] = Str::slug($request->name);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'unique:question_types',
            'exam_type_id' => 'required'
        ]);

        QuestionType::create([
            'exam_type_id' => $request->exam_type_id,
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $request['slug'] = Str::slug($request->name);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'unique:question_types'
        ]);

        QuestionType::find($request->id)->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        QuestionType::find($request->id)->delete();

        return redirect()->back();
    }
}
