<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ExamType;

class ExamTypeController extends Controller
{
    public function create(Request $request)
    {
        $request['slug'] = Str::slug($request->name);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'unique:exam_types',
        ]);

        ExamType::create([
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
            'slug' => 'unique:exam_types'
        ]);

        ExamType::find($request->id)->update([
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

        ExamType::find($request->id)->delete();

        return redirect()->back();
    }

    public function release(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        $et = ExamType::find($request->id);

        if($et->status) $et->update(['status' => 0]);
        else $et->update(['status' => 1]);

        return redirect()->back();
    }
}
