<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use Illuminate\Support\Facades\DB;


class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Projects::getProjects();

        $firstLetters = [];

        foreach($projects as $project)
        {
            $first = substr($project->name, 0, 1);
            array_push($firstLetters, $first);
        }

        array_unique($firstLetters);

        // $sql = DB::table('projects')
        // ->select(DB::raw('name, SUBSTR(`name`, 1, 1) as first'))
        // ->distinct('first')
        // ->orderBy('first')
        // ->get();

        // foreach($sql as $value)
        // {
        //     echo $value->first;
        // }


        return view('projects.index')->with(['projects' => $projects, 'firstLetters' => $firstLetters]);

    }

    public function show($id)
    {
        $project = Projects::getProjects('projects.id', $id);
        $parent = Projects::getParent($id);

        $issuesOnProject = Projects::getIssuesOnProject($id);

        if($id != 7)
        {
            
        $daddy = Projects::getProjects('projects.id', $project[0]->parent_id);

        if($daddy[0]->id != 7) {

            $gram = Projects::getProjects('projects.id', $daddy[0]->parent_id);

        }else
        {
            $gram = null;
        }

        $brothers = Projects::getProjects('projects.parent_id', $project[0]->parent_id);
        
        }else
        {
            $daddy = null;
            $gram = null;
            $brothers = null;
        }
        return view('projects.show')->with(['project' => $project, 'parent' => $parent, 'issuesOnProject' => $issuesOnProject, 'gram' => $gram, 'daddy' => $daddy, 'brothers' => $brothers]);
    }


    public function create()
    {
        $projects = Projects::getProjectsOrderBy();
        $functions = DB::table('functions')
        ->select('functions.*')
        ->get();
        return view('projects.create')->with(['projects' => $projects, 'functions' => $functions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $first = substr($request->name, 0, 1);
        $request->merge(['ordering' => $first]);



        Projects::create($request->all());

        $request->session()->flash('alert-success', 'Sprint adicionada com sucesso!');

        return redirect()->route('projects.index');
    }




}
