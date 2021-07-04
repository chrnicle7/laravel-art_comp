<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $table = 'challenges';
    protected $fillable = ['title', 'desc', 'id_tag', 'date_start_submission',
                            'date_end_submission', 'date_announcement', 'id_host',
                            'further_desc_link'];
}
