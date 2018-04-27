<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    const IS_NOT_FINISHED = 'is-not-finished';

    protected $fillable = [
        'country_id',
        'university',
        'speciality',
        'degree',
        'started_at',
        'finished_at',
        'is_finished'
    ];

    public $timestamps = false;

    public function country()
    {
        return $this->hasOne(Country::class);
    }

    public function user()
    {
        return $this->belongsToOne(User::class);
    }
}
