<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuestionPacket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_packet_id',
        'completed',
        'score',
        'ended_at',
        'trueAnswer',
        'falseAnswer',
        'nullAnswer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questionPacket()
    {
        return $this->belongsTo(QuestionPacket::class);
    }

    public static function getPacket( $user_id, $question_packet_id )
    {
        return UserQuestionPacket::where([['user_id', $user_id],
                                          ['question_packet_id', $question_packet_id]])->first();
    }
}
