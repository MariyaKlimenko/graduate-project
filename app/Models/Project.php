<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'duration',
        'started_at',
        'finished_at',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function labels()
    {
        return $this->hasMany(Label::class);
    }
}
