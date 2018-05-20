<?php

namespace App\Models;

use App\Models\Education;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function education()
    {
        return $this->belongsToMany(Education::class);
    }

}
