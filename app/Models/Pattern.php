<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    // Define the fillable fields that can be mass-assigned
    protected $fillable = [
        'title',
        'feature_image_url',
        'category_id',
        'materials',
        'pdk_link',
        'youtube_link',
        'user_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }
}
