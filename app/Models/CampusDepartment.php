<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'campus_id',
        'name',
        'passing_grade'
    ];
}
