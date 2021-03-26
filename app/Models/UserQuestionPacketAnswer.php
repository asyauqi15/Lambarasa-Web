<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuestionPacketAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_packet_id',
        'question_id',
        'question_answer_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questionPacket()
    {
        return $this->belongsTo(QuestionPacket::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function questionAnswer()
    {
        return $this->belongsTo(QuestionAnswer::class);
    }

    public static function getAnswers( $user_id, $question_packet_id )
    {
        return UserQuestionPacketAnswer::where([['user_id', $user_id], ['question_packet_id', $question_packet_id]])
                                        ->orderBy('question_id')->get();
    }

    public static function getAnswer( $user_id, $question_id )
    {
        return UserQuestionPacketAnswer::where([['user_id', $user_id], ['question_id', $question_id]])
                                        ->first();
    }
}
