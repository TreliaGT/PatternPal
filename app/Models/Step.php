<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = ['pattern_id', 'title', 'steps'];

    public function pattern()
    {
        return $this->belongsTo(Pattern::class);
    }
}
