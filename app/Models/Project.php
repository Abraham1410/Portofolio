<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'long_description',
        'category', 'tech_stack', 'image', 'url_live',
        'url_github', 'featured', 'order', 'is_active',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'featured'   => 'boolean',
        'is_active'  => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}
