<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submissions';
    protected $fillable = ['id_challenge', 'id_user', 'link', 'score', 'host_feedback', 'desc'];
}
