<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'banner_path',
    ];

    public function questionTypes()
    {
        return $this->hasMany(QuestionType::class);
    }
}
