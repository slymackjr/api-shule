<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{

    use HasFactory;
    protected $table = 'exams';
    protected $fillable = [
        'name',
        'type',
    ];
    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

}
