<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'question_packet_id',
        'question',
        'question_answer_id',
        'explanation'
    ];

    public function packet()
    {
        return $this->belongsTo(QuestionPacket::class);
    }

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class)->get();
    }

    public function userQuestionPacketAnswers()
    {
        return $this->hasMany(UserQuestionPacketAnswers::class);
    }
}
