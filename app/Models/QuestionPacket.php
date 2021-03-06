<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionPacket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'question_type_id',
        'name',
        'slug',
        'banner_path',
        'amount',
        'time',
        'status',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class)->get();
    }

    public function type()
    {
        return $this->belongsTo(QuestionType::class);
    }

    public function userQuestionPackets()
    {
        return $this->hasMany(UserQuestionPacket::class);
    }

    public function userQuestionPacketAnswers()
    {
        return $this->hasMany(UserQuestionPacketAnswer::class);
    }

    public function getUserPacket( $user_id )
    {
        return $this->hasMany(UserQuestionPacket::class)->where('user_id', $user_id)->first();
    }
}
