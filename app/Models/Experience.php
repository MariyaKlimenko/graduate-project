<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name',
        'duration'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}