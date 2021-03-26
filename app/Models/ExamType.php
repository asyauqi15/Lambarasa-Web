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
        'status',
    ];

    public function questionTypes()
    {
        return $this->hasMany(QuestionType::class)->get();
    }

    public function packetsCount()
    {
        $total = 0;
        $types = $this->hasMany(QuestionType::class)->get();
        foreach ($types as $type) {
            $total += $type->packets()->count();
        }

        return $total;
    }

    public function packetsReleasedCount()
    {
        $total = 0;
        $types = $this->hasMany(QuestionType::class)->get();
        foreach ($types as $type) {
            $total += $type->packets()->where('status', 1)->count();
        }

        return $total;
    }
}
