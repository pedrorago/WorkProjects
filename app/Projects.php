<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Issues;
class Projects extends Model
{
    protected $fillable = [ 
        'name', 'parent_id', 'funcion_id_key', 'ordering'
    ];


    public static function getProjects($where = 'false', $whereValue = 'false')
    {

        if($where != 'false')
        {

            return DB::table('projects')
            ->select('projects.*')
            ->where($where, $whereValue)
            ->orderBy('projects.name')
            ->get();

        }else
        {
            return DB::table('projects')
            ->select('projects.*')
            ->orderBy('projects.name')
            ->get();
        }

    }

    public static function getProjectsOrderBy()
    {
            return DB::table('projects')
            ->select('projects.id', 'projects.name')
            ->orderByRaw('projects.name = "GERAL" DESC')
            ->get();

    }               

    
    public static function getParent($id)
    {
        return DB::table('projects')
        ->select('projects.name')
        ->where('projects.id', $id)
        ->get();
    }

    public static function getIssuesOnProject($id)
    {
            return Issues::getIssues('issues.project_id', $id);
    }





}
