<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'country_id',
        'university',
        'speciality',
        'degree',
        'started_at',
        'finished_at',
        'is_not_finished'
    ];

    public $timestamps = false;

    /**
     * Returns country, which is belonged to education.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    /**
     * Returns user, which education is belonged to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
