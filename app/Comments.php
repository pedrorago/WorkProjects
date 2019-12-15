<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [ 
        'author_id',
        'comments_text',
        'created_at',
        'updated_at',
        'issue_id',
    ];
}
