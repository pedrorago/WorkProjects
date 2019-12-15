<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issues;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\History;
use App\Checklist;
use App\Sprint;

class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return DB::table('custom_fields')
        // ->where('id', 1)
        // ->get();
        
        if(isset($_GET['sprint']) && !empty($_GET['sprint']) && !isset($_GET['function']) && !isset($_GET['attr']))
        {
            $sprintFilter = $_GET['sprint'];

            $issues = Issues::getIssues('issues.fixed_version_id', $sprintFilter);

        }else if(isset($_GET['sprint']) && !empty($_GET['sprint']) && isset($_GET['function']) && !empty($_GET['function']) && !isset($_GET['attr']))
        {
            $sprintFilter = $_GET['sprint'];
            $functionFilter = $_GET['function'];
            $issues = Issues::getIssuesFunction('issues.funcion_id', $functionFilter, $sprintFilter);
        
        }else if(isset($_GET['attr']) && !empty($_GET['attr']) && isset($_GET['sprint'])  && !empty($_GET['sprint'])){
            $sprintFilter = $_GET['sprint'];
            $attrFilter = $_GET['attr'];
            $issues = Issues::getIssuesFunction('issues.assigned_to_id', $attrFilter, $sprintFilter);
        }else
        {
            $issues = Issues::getIssues();
        }

        $Users  = User::getUsers();
        $Backlog = Sprint::getBacklog();

        $LastVersions = Sprint::lastVersions();
        $LastVersions = $LastVersions->reverse();
        return view('issues.index')->with(['issues' => $issues, 'users' => $Users, 'backlog' => $Backlog, 'lastVersios' => $LastVersions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = DB::table('projects')
        ->select('projects.*')
        ->get();

        $versions = DB::table('versions')
        ->select('versions.*')
        ->orderBy('versions.name', 'asc')
        ->get();

        $trackers = DB::table('trackers')
        ->select('trackers.*')
        ->get();

        
        $Functions = DB::table('functions')
        ->select('functions.*')
        ->get();

        $users = DB::table('users')
        ->select('users.*')
        ->where('users.id',  '!=', 69)
        ->get();


        return view('issues.create')->with(['projects' => $projects, 'versions' => $versions, 'trackers' => $trackers, 'Functions' => $Functions, 'users' => $users]);

    }
    public function createSprint()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     
    public function store(Request $request)
    {
        Issues::create($request->all());
        $issue = DB::table('issues')
        ->select('issues.*')
        ->where('author_id', $request->author_id)
        ->where('fixed_version_id', $request->fixed_version_id)
        ->where('tracker_id', $request->tracker_id)
        ->where('subject', $request->subject)
        ->get();

        $request->session()->flash('alert-success', 'Tarefa adicionada com sucesso!');

        return redirect()->route('issues.show', ['issue' => $issue[0]->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        $issue = Issues::getIssues('issues.id', $id);

        $comments = DB::table('comments')
        ->join('users', 'comments.author_id', '=', 'users.id')
        ->select('comments.*', 'users.name as user_name', 'users.avatar as avatar', 'users.id as user_id', 'users.created_at as create')
        ->where('issue_id', $id)
        ->get();

        if(isset($_GET['comment']) && $_GET['comment'] == 'true')
        {
            $request->session()->flash('create-comment', 'Adicionar um comentário');
        }

        if(empty($comments[0]))
        {
            $comments = 'Sem comentários existentes';
        }
        if($issue[0]->status_id == 2)
        {
            $author = Auth::user()->name;
            $authorPic = Auth::user()->avatar; 

        }else
        {
            $author = '';
            $authorPic = '';
        }


        $getChecklist = Checklist::getChecklist($id);


        return view('issues.show')->with(['issue' => $issue, 'author' => $author, 'authorPic' => $authorPic, 'comments' => $comments, 'checklist' => $getChecklist]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $issue = Issues::getIssues('issues.id', $id);
        
        $projects = DB::table('projects')
        ->select('projects.*')
        ->get();

        $versions = DB::table('versions')
        ->select('versions.*')
        ->orderBy('versions.name', 'desc')
        ->get();

        $trackers = DB::table('trackers')
        ->select('trackers.*')
        ->get();

        $Functions = DB::table('functions')
        ->select('functions.*')
        ->get();

        $users = DB::table('users')
        ->select('users.*')
        ->where('users.id',  '!=', 69)
        ->get();

        return view('issues.edit')->with(['issue' => $issue, 'projects' => $projects, 'versions' => $versions, 'trackers' => $trackers, 'Functions' => $Functions, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateMenu(Request $request)
    {

    }
    public function update(Request $request, $id)
    {   
        if(isset($request->form)){

            $id = $request->id;
            $id =explode(' ', $id);

            if($request->form == 'status'){
                 $status = $request->status;
                 foreach($id as $value){
                    Issues::find($value)->update(['status_id' => $status]);
                 }

            }elseif($request->form == 'attr'){
                $attr = $request->attr;
                foreach($id as $value){
                    Issues::find($value)->update(['assigned_to_id' => $attr]);
                }
            }elseif($request->form == 'priority'){
                $priority = $request->priority;
                foreach($id as $value){
                    Issues::find($value)->update(['priority_id' => $priority]);
                }
            }elseif($request->form == 'versions'){
                $versions = $request->versions;
                foreach($id as $value){
                    Issues::find($value)->update(['fixed_version_id' => $versions]);
                }
            }            
         

            $request->session()->flash('alert-success', 'Tarefa editada com sucesso!');

            return;

        }else{


        if($request->status_id == 2)
        {
            $author = Auth::user()->name;
            $authorPic = Auth::user()->avatar; 
            $request->merge(['author_name' => $author, 'author_pic' => $authorPic]);

        }


        if($request->status_id == 1)
        {
            $status = 'A Fazer';
        }
        elseif($request->status_id == 2)
       {
        $status = 'Fazendo';
       }
        elseif($request->status_id == 3)
        {
            $status = 'Feito';
        }
        elseif($request->status_id == 4)
        {
            $status = 'Bloqueado';
        }
        else
       {
        $status = 'Aprovado';
       }
       $request->merge(['issue_status' => $status]);

        History::create($request->all());

        $comments = DB::table('comments')
        ->where('issue_id', $id)
        ->count();

        if($comments < 1)
        {
            $comments = 0;
        }
        Issues::find($id)->update(['comments_count' => $comments]);
        Issues::find($id)->update($request->all());

        }

        $request->session()->flash('alert-success', 'Tarefa editada com sucesso!');

        return redirect()->route('issues.show', ['issue' => $id]);
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
            $request->session()->flash('alert-danger', 'Visitantes não pode remover atividades.');
            return redirect()->route('issues.index');
        }
        Issues::find($id)->delete();
        $request->session()->flash('alert-success', 'Tarefa #'.$id.' removida com sucesso!');

        if($request->url == 'internal')
        {
            return redirect()->route('issues.index');
        }else
        {
            return redirect($request->url);

        }
    }
}
