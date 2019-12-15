<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sprint extends Model
{
    protected $table = 'versions';

    protected $fillable = [ 
        'project_id',
        'name',
        'description',
        'created_at',
        'updated_at',
        'status',
        'active',
        'start_date',
        'finish_date',
    ];

    public static function countVersions()
    {
        return DB::table('versions')
        ->select('versions.*')
        ->where('versions.active', '1')
        ->count();
        
    }


    public static function getBacklog()
    {
        return DB::table('versions')
        ->select('versions.*')
        ->where('versions.id', '3')
        ->get();
        
    }


    public static function lastVersions()
    {
        return DB::table('versions')
        ->select('versions.*')
        ->orderBy('versions.id', 'desc')
        ->limit(3)
        ->get();
        
    }



    public static function currentSprint()
    {
        if(Sprint::countVersions() != 0)
        {
            $versions = DB::table('versions')
            ->select('versions.*')
            ->where('versions.active', '1')
            ->limit(1)
            ->get();
        }
        else
        {
            $versions = [
                $object = (object) [
                   'id'  => '0',
                   'name' => 'Sem sprint atual'
                ]
            ];
        }

        return $versions[0];
    }


    
}

