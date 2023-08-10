<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateLimitDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rate_limit()
    {
        return $this->belongsTo(RateLimit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
