<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'name',
        'count'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
