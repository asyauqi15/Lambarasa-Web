<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'exam_type_id',
        'name',
        'slug',
        'banner_path',
        'status',
    ];

    protected $rules = [
        'slug' => 'unique:question_types',
    ];

    public function packets()
    {
        return $this->hasMany(QuestionPacket::class)->get();
    }

    public function examType()
    {
        return $this->belongsTo(ExamType::class);
    }
}
