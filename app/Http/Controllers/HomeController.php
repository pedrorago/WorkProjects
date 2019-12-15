<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Sprint;
use App\Issues;

use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $versions = Sprint::currentSprint();
        $user = Auth::user();


        $doing = DB::table('histories')
        ->select('histories.*')
        ->limit(20)
        ->orderBy('histories.id', 'desc')
        ->get(); 

        $function_user = DB::table('functions')
        ->select('functions.*')
        ->where('functions.id', $user->function_id)
        ->get(); 


        
        $sprint029 = DB::table('issues')
        ->select('issues.*')
        ->where('issues.fixed_version_id', '3')
        ->where('issues.funcion_id', $user->function_id)
        ->count(); 

        $sprint033 = DB::table('issues')
        ->select('issues.*')
        ->where('issues.fixed_version_id', '56')
        ->where('issues.funcion_id', $user->function_id)
        ->count(); 

        $sprint034 = DB::table('issues')
        ->select('issues.*')
        ->where('issues.fixed_version_id', '57')
        ->where('issues.funcion_id', $user->function_id)
        ->count(); 

        $sprint035 = DB::table('issues')
        ->select('issues.*')
        ->where('issues.fixed_version_id', '58')
        ->where('issues.funcion_id', $user->function_id)
        ->count(); 



        if(Sprint::countVersions() != 0)
        {
            
            $totalIssues = Issues::countIssues('fixed_version_id', $versions->id);
            
            if($totalIssues != 0)
            {
                $positivas = Issues::positiveIssue('fixed_version_id', $versions->id);
                $porcentagem = Issues::conclusionIssues($positivas, $totalIssues);
            }
            else
            {
                $porcentagem = 0;
            }

            $pending = Issues::pendingIssue('fixed_version_id', $versions->id);


        }else
        {
           $totalIssues = 0;
           $pending = 0;
           $porcentagem = 0;
        }
        return view('home')->with(['doing' => $doing, 'function_user' => $function_user, 'sprint029' => $sprint029, 'sprint033' => $sprint033, 'sprint034' => $sprint034, 'sprint035' => $sprint035, 'versions' => $versions, 'totalIssues' => $totalIssues, 'pending' => $pending, 'porcentagem' => $porcentagem]);

    }
}
