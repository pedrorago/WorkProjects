<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Checklist extends Model
{
    protected $fillable = [ 
        'issue_id',
        'name',
        'status',
        'created_at',
        'updated_at',
    ];


    public static function getChecklist($issue_id)
    {
        return DB::table('checklists')
        ->select('checklists.*')
        ->where('issue_id', $issue_id)
        ->orderBy('id','asc')
        ->get();
    }
    public static function insertChecklist($issue_id, $name, $status)
    {
        return DB::table('checklists')->insert([
            ['issue_id' => $issue_id, 'name' => $name, 'status' => $status]
        ]);
    }

    public static function getId($name)
    {
        return DB::table('checklists')
        ->select('checklists.id')
        ->where('name', $name)
        ->limit(1)
        ->get();
    }
}
