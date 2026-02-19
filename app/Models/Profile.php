<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'title', 'tagline', 'about', 'email', 'phone',
        'location', 'github', 'linkedin', 'instagram', 'twitter',
        'avatar', 'skills', 'services',
    ];

    protected $casts = [
        'skills'   => 'array',
        'services' => 'array',
    ];

    public static function getProfile()
    {
        return static::first();
    }
}
