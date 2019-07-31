<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplicantion extends Model
{
    protected $fillable = [
        'job_post_id', 'user_id',
    ];
}
