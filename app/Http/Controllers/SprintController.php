<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sprint;
use Illuminate\Support\Facades\DB;

class SprintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sprints = DB::table('versions')
        ->select('versions.*')
        ->where('versions.id', '!=', '3')
        ->orderBy('versions.id', 'desc')
        ->limit(1500)
        ->get();

        return view('sprints.index')->with(['sprints' => $sprints]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            
        $versions = DB::table('versions')
        ->select('versions.*')
        ->orderBy('versions.id', 'desc')
        ->limit(1)
        ->get();

        $totalIssues = DB::table('issues')
        ->where('issues.fixed_version_id', $versions[0]->id)
        ->count();

        if($totalIssues != 0)
        {
            $positivas = DB::table('issues')
            ->where('issues.fixed_version_id', $versions[0]->id)
            ->where('issues.status_id', 3)
            ->orWhere('issues.status_id', 5)
            ->where('issues.fixed_version_id', $versions[0]->id)
            ->count();

            $porcentagem = $positivas / $totalIssues * 100;
            $porcentagem = round($porcentagem);
        }
        else
        {
            $porcentagem = 0;
        }

        return view('sprints.create')->with(['totalIssues' => $totalIssues, 'versions' => $versions, 'porcentagem' => $porcentagem]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->active == 1)
        {
            DB::table('versions')
            ->where('versions.active', 1)
            ->update(['versions.active' => 0]);
        }

        Sprint::create($request->all());
        $request->session()->flash('alert-success', 'Sprint adicionada com sucesso!');

        return redirect()->route('sprints.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $versions = DB::table('versions')
        ->select('versions.*')
        ->where('versions.id', $id)
        ->get();


        $lastVersion = DB::table('versions')
        ->select('versions.*')
        ->orderBy('versions.id', 'desc')
        ->limit(1)
        ->get();

        $totalIssues = DB::table('issues')
        ->where('issues.fixed_version_id', $lastVersion[0]->id)
        ->count();

        if($totalIssues != 0)
        {
            $positivas = DB::table('issues')
            ->where('issues.fixed_version_id', $lastVersion[0]->id)
            ->where('issues.status_id', 3)
            ->orWhere('issues.status_id', 5)
            ->where('issues.fixed_version_id', $lastVersion[0]->id)
            ->count();

            $porcentagem = $positivas / $totalIssues * 100;
            $porcentagem = round($porcentagem);
        }
        else
        {
            $porcentagem = 0;
        }

        return view('sprints.edit')->with(['versions' => $versions, 'totalIssues' => $totalIssues, 'lastVersion' => $lastVersion, 'porcentagem' => $porcentagem]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->active == 1)
        {
            DB::table('versions')
            ->where('versions.active', 1)
            ->update(['versions.active' => 0]);
        }

        Sprint::find($id)->update($request->all());
        $request->session()->flash('alert-success', 'Sprint editada com sucesso!');

        return redirect()->route('sprints.index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if(Auth::user()->email == 'guest@geprojetos.com.br'){
            $request->session()->flash('alert-danger', 'Visitantes não pode remover sprints.');
            return redirect()->route('sprints.index');
        }

        Sprint::find($id)->delete();
        $request->session()->flash('alert-success', 'Sprint removida com sucesso!');
        return redirect()->route('sprints.index');
    }
}
