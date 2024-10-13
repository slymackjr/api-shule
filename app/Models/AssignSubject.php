<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignSubject extends Model
{
    use HasFactory;
    protected $table = 'assign_subjects';
    protected $fillable =[
        'class_id',
        'stream_id',
        'subject_id',
    ];
}
