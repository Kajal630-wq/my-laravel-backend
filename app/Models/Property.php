<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'location', 'price', 'price_value', 'beds', 'baths',
        'sqft', 'image', 'description', 'features', 'built_year',
        'tag', 'tag_color', 'is_featured'
    ];

    protected $casts = [
        'features' => 'array',
        'is_featured' => 'boolean',
    ];
}