<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issues;
use App\Comments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        Comments::create($request->all());

        $issue = DB::table('issues')
        ->select('issues.*')
        ->where('author_id', $request->author_id)
        ->where('id', $request->issue)
        ->get();

        $request->session()->flash('alert-success', 'Comentário adicionado com sucesso!');
        $comments = DB::table('comments')
        ->where('issue_id', $_GET['issue'])
        ->count();

        if($comments < 1)
        {
            $comments = 0;
        }
        Issues::find($_GET['issue'])->update(['comments_count' => $comments]);
        return redirect()->route('issues.show', ['issue' => $issue[0]->id]);
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
    public function edit(Request $request, $id)
    {
        $request->session()->flash('create-comment', 'Adicionar um comentário');
        $issue = Issues::getIssues('issues.id', $id);
        if($issue[0]->status_id == 2)
        {
            $author = Auth::user()->name;
            $authorPic = Auth::user()->avatar; 

        }else
        {
            $author = '';
            $authorPic = '';
        }


        
        return view('issues.show')->with(['issue' => $issue, 'author' => $author, 'authorPic' => $authorPic]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Comments::find($id)->delete();
        $comments = DB::table('comments')
        ->where('issue_id', $_GET['issue'])
        ->count();

        if($comments < 1)
        {
            $comments = 0;
        }
        Issues::find($_GET['issue'])->update(['comments_count' => $comments]);
        $request->session()->flash('alert-success', 'Comentário removido com sucesso!');
        return redirect()->route('issues.show', ['issue' => $request->issue_id]);
    }
}
