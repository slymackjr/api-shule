<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateSchoolGradingSystem extends Model
{
    use HasFactory;

    protected $table = 'private_school_grading_systems';
    protected $fillable = [
        'grade',
        'min',
        'max',
        'level',
        'school_id',
    ];
}
