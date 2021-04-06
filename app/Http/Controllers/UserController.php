<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('auth.register');
    }
    public function edit($request, User $user)
    {   
        $user = Auth::user();
        

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



        return view('users.edit', compact('user'))->with(['function_user' => $function_user, 'sprint029' => $sprint029, 'sprint033' => $sprint033, 'sprint034' => $sprint034, 'sprint035' => $sprint035]);
    }

    public function update(Request $request, User $user)
    { 

        if($user->email == 'guest@geprojetos.com.br'){
            request()->session()->flash('alert-danger', 'Visitantes não podem fazer alterações no perfil. Sentimos muito!');
            return back();
        }


       if(isset($request->id_user_modify)){
             User::find($request->id_user_modify)->update(['notification' => 0]);
             return;
       }else{
        if(Auth::user()->email == request('email')) {
        
            request()->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
    
            request()->avatar->storeAs('avatars',$avatarName);
    
            $user->avatar = '/img/avatars/avatars/'.$avatarName;

            $this->validate(request(), [
                    'name' => 'required',
                  //  'email' => 'required|email|unique:users',

                ]);
        
                $user->name = request('name');
               // $user->email = request('email');

               if(request('password') == request('password_confirmation')){
                    if(request('passoword') != ''){
                        $user->password = bcrypt(request('password'));
                   }
                    $user->save();
                    request()->session()->flash('alert-success', 'Usuário editado com sucesso!');
                    return back();
               }
               else
               {
                request()->session()->flash('alert-danger', 'As senhas não são iguais');
                return back();
               }

                
            }
            else{
                     
            request()->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
    
            request()->avatar->storeAs('avatars',$avatarName);
    
            $user->avatar = '/storage/avatars/'.$avatarName;
            $this->validate(request(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6|confirmed',
                ]);
        
                $user->name = request('name');
                $user->email = request('email');

                if(request('password') == request('password_confirmation')){
                     if(request('passoword') != ''){
                        $user->password = bcrypt(request('password'));
                   }
                    $user->save();
                    request()->session()->flash('alert-success', 'Usuário editado com sucesso!');
                    return back();
               }
               else
               {
                request()->session()->flash('alert-danger', 'As senhas não são iguais');
                return back();
               }

                
            }
       }
    }


}