<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Checklist;

class ChecklistController extends Controller
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
        $issue_id = $_GET['issue_id'];
        $name = $_GET['name'];
        $status = $_GET['status'];
       Checklist::insertChecklist($issue_id, $name, $status);
        return 'Feito';
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $status, $name)
    {
        if($id == 0) {
            $id = Checklist::getId($name);
            $id = $id[0]->id;
            Checklist::find($id)->update(['status' => $status]);
        }
        else
        {
            Checklist::find($id)->update(['status' => $status]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $name)
    {
         if($id == 0) {
            $id = Checklist::getId($name);
            $id = $id[0]->id;
            Checklist::find($id)->delete();
        }
        else
        {
        Checklist::find($id)->delete();

        }
    }
}
