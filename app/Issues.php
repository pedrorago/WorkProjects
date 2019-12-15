<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Sprint;

class Issues extends Model
{
    protected $fillable = [ 
        'tracker_id',
        'project_id',
        'subject',
        'description',
        'due_date',
        'status_id',
        'assigned_to_id',
        'priority_id',
        'fixed_version_id',
        'author_id',
        'updated_on',
        'created_at',
        'updated_at',
        'funcion_id',
        'version_active',
        'author_name',
        'author_pic',
        'comments_count',
        'created_name'
    ];



    public static function countIssues($where = 'false', $whereValue = 'false')
    {
   
        if($where != 'false')
        {
            return DB::table('issues')
            ->where($where, $whereValue)
            ->count();
        }else
        {
            return DB::table('issues')
            ->count();
        }
    }

    public static function positiveIssue($where = 'false', $whereValue = 'false')
    {

        if($where != 'false')
        {
            return DB::table('issues')
            ->where($where, $whereValue)
            ->where('issues.status_id', 3)
            ->orWhere('issues.status_id', 5)
            ->where($where, $whereValue)
            ->count();
        }else
        {
            return DB::table('issues')
            ->where('issues.status_id', 3)
            ->orWhere('issues.status_id', 5)
            ->count();
        }

 
    }
    public static function conclusionIssues($first, $second)
    {
        $conclusion = $first / $second * 100;
        $conclusion = round($conclusion);
        return $conclusion;
    }

    public static function pendingIssue($where = 'false', $whereValue = 'false')
    {
        if($where != 'false')
        {
            return DB::table('issues')
            ->where($where, $whereValue)
            ->where('issues.status_id', 1)
            ->orWhere('issues.status_id', 4)
            ->where($where, $whereValue)
            ->count();
        }else
        {
            return DB::table('issues')
            ->where('issues.status_id', 1)
            ->orWhere('issues.status_id', 4)
            ->count();
        }
    }

    public static function getIssues($where = 'false', $whereValue = 'false')
    {
        if($where != 'false')
        {
            return DB::table('issues')
            ->join('trackers', 'issues.tracker_id', '=', 'trackers.id')
            ->join('projects', 'issues.project_id', '=', 'projects.id')
            ->join('issue_statuses', 'issues.status_id', '=', 'issue_statuses.id')
            ->join('enumerations', 'issues.priority_id', '=', 'enumerations.id')
            ->join('versions', 'issues.fixed_version_id', '=', 'versions.id')
            ->join('users', 'issues.assigned_to_id', '=', 'users.id')
            ->join('functions', 'issues.funcion_id', '=', 'functions.id')
            ->select('issues.id', 'issues.subject', 'issues.description', 'issues.status_id', 'issues.assigned_to_id', 'issues.author_id', 'issues.due_date', 'issues.author_name', 'issues.author_pic', 'issues.comments_count','issues.created_name','trackers.name', 'projects.name as project', 'issue_statuses.name as status', 'enumerations.name as priority', 'versions.name as version', 'functions.name as function', 'users.name as attr', 'users.avatar as attr_img', 'users.id as attr_id')
            ->where($where, $whereValue)
            ->limit(1500)
            ->get();

        }else
        {
            return DB::table('issues')
            ->join('trackers', 'issues.tracker_id', '=', 'trackers.id')
            ->join('projects', 'issues.project_id', '=', 'projects.id')
            ->join('issue_statuses', 'issues.status_id', '=', 'issue_statuses.id')
            ->join('enumerations', 'issues.priority_id', '=', 'enumerations.id')
            ->join('versions', 'issues.fixed_version_id', '=', 'versions.id')
            ->join('users', 'issues.assigned_to_id', '=', 'users.id')
            ->join('functions', 'issues.funcion_id', '=', 'functions.id')
            ->select('issues.id', 'issues.subject', 'issues.description', 'issues.status_id','issues.assigned_to_id', 'issues.author_id', 'issues.due_date', 'issues.author_name', 'issues.author_pic', 'issues.comments_count', 'issues.created_name','trackers.name', 'projects.name as project', 'issue_statuses.name as status', 'enumerations.name as priority', 'versions.name as version', 'functions.name as function',  'users.name as attr', 'users.avatar as attr_img', 'users.id as attr_id')
            ->where('issues.fixed_version_id', '!=', '3')
            ->orderBy('issues.fixed_version_id', 'desc')
            ->limit(1500)
            ->get();
        }
    }


    public static function getIssuesFunction($where, $whereValue, $sprint)
    {
      
            return DB::table('issues')
            ->join('trackers', 'issues.tracker_id', '=', 'trackers.id')
            ->join('projects', 'issues.project_id', '=', 'projects.id')
            ->join('issue_statuses', 'issues.status_id', '=', 'issue_statuses.id')
            ->join('enumerations', 'issues.priority_id', '=', 'enumerations.id')
            ->join('versions', 'issues.fixed_version_id', '=', 'versions.id')
            ->join('users', 'issues.assigned_to_id', '=', 'users.id')
            ->join('functions', 'issues.funcion_id', '=', 'functions.id')
            ->select('issues.id', 'issues.subject', 'issues.description', 'issues.assigned_to_id', 'issues.due_date', 'issues.author_name', 'issues.author_pic', 'issues.comments_count','trackers.name', 'projects.name as project', 'issue_statuses.name as status', 'enumerations.name as priority', 'versions.name as version', 'functions.name as function',  'users.name as attr', 'users.avatar as attr_img', 'users.id as attr_id')
            ->where($where, $whereValue)
            ->where('issues.fixed_version_id', $sprint)
            ->limit(1500)
            ->get();

       
    }


    

}


