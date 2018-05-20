<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompletedIssues extends Model
{
    protected $table = 'completed_issues';

    protected $fillable = [
        'issue_id'
    ];

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
