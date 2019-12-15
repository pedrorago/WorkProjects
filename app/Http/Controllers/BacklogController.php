<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\History;
use App\Checklist;
use App\Sprint;
class BacklogController extends Controller
{
    public function index()
    {
            
        $issues = DB::table('issues')
        ->join('trackers', 'issues.tracker_id', '=', 'trackers.id')
        ->join('projects', 'issues.project_id', '=', 'projects.id')
        ->join('issue_statuses', 'issues.status_id', '=', 'issue_statuses.id')
        ->join('enumerations', 'issues.priority_id', '=', 'enumerations.id')
        ->join('versions', 'issues.fixed_version_id', '=', 'versions.id')
        ->join('functions', 'issues.funcion_id', '=', 'functions.id')
        ->select('issues.id', 'issues.subject', 'trackers.name', 'projects.name as project', 'issue_statuses.name as status', 'enumerations.name as priority', 'versions.name as version', 'functions.name as function')
        ->where('issues.fixed_version_id', '3')
        ->orderBy('issues.fixed_version_id', 'desc')
        ->limit(1500)
        ->get();


        $Users  = User::getUsers();
        $Backlog = Sprint::getBacklog();

        $LastVersions = Sprint::lastVersions();
        $LastVersions = $LastVersions->reverse();


        return view('backlog.index')->with(['issues' => $issues,'users' =>  $Users, 'backlog' => $Backlog, 'lastVersios' => $LastVersions]);
    }
}
