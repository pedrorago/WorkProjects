<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class History extends Model
{
    protected $fillable = [ 
        'issue_name',
        'issue_status',
        'issue_id',
        'author_name_histories',
        'author_id',
        'created_at',
        'updated_at',
        'author_pic_histories'
    ];


    // public static function getHistory ()
    // {
    //     return DB::table('history')
    //     ->select('')
    //     ->where()
    //     ->limit(1500)
    //     ->get();
    // }


    

}


