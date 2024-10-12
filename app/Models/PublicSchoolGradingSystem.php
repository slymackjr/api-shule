<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicSchoolGradingSystem extends Model
{
    use HasFactory;

    protected $table = 'public_school_grading_systems';
    protected $fillable = [
        'grade',
        'min',
        'max',
        'level'
    ];
}
