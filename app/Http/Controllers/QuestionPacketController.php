<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\QuestionPacket;
use App\Models\Question;

class QuestionPacketController extends Controller
{
    public function create(Request $request)
    {
        $request['slug'] = Str::slug($request->name);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'unique:question_types',
            'question_type_id' => 'required',
            'amount' => 'required|numeric|max:500',
            'time' => 'required',
        ]);

        $questionPacket = QuestionPacket::create([
            'question_type_id' => $request->question_type_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'amount' => $request->amount,
            'time' => $request->time,
        ]);

        for ($i=1; $i <= $request->amount; $i++) { 
            Question::create([
                'question_packet_id' => $questionPacket->id,
                'question' => 'Soal nomor '.$i,
            ]);
        }

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $request['slug'] = Str::slug($request->name);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'unique:question_types',
            'amount' => 'required|numeric|max:500',
            'time' => 'required',
        ]);

        $questionPacket = QuestionPacket::find($request->id);
        $difference = $questionPacket->amount - $request->amount;
        
        if ( $difference > 0 )
            Question::where('question_packet_id', $questionPacket->id)->orderBy('id', 'desc')->take($difference)->delete();
        
        else if ( $difference < 0 )
            for ($i=$questionPacket->amount+1; $i <= $request->amount; $i++) { 
                Question::create([
                    'question_packet_id' => $questionPacket->id,
                    'question' => 'Soal nomor '.$i,
                ]);
            }
        
        
        $questionPacket->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'amount' => $request->amount,
            'time' => $request->time,
        ]);

        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        Question::where('question_packet_id', $request->id)->delete();
        QuestionPacket::find($request->id)->delete();

        return redirect()->back();
    }
}
