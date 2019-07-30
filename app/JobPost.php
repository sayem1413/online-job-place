<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $fillable = [
        'job_title', 'job_description', 'salary', 'location', 'country', 'user_id',
    ];
}
