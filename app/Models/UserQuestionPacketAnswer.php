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
        'answer_id'
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
}
