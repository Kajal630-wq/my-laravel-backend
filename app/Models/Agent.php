<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'image',
        'experience_years',
        'properties_sold',
    ];

    protected $casts = [
        'experience_years' => 'integer',
        'properties_sold' => 'integer',
    ];
}