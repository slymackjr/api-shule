<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Parents extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'parents';
    protected $fillable =
    [
        'first_name',
        'middle_name',
        'last_name',
        'phone_number',
        'postal_address',
        'ward_id',
        'district_id',
        'region_id',
        'street',
        'user_id',
        'is_paid',

    ];
    public function student_parents(): HasMany
    {
        return $this->hasMany(StudentParent::class);
    }
}
