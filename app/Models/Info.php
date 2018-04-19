<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Info extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location', 'phone',
    ];

    /**
     * Get the user of the info.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
