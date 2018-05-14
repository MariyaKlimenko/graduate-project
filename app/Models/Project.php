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

    /**
     * Get the owner of project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get labels.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function labels()
    {
        return $this->hasMany(Label::class);
    }
}