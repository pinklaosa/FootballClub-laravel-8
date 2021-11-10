<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class CustomAuthController extends Controller
{
    //this just show page
    public function login(){
        return view('user.login');
    }
    public function register(){
        return view('user.create');
    }

    //process
  

   public function postRegister(Request $request)
   {
       $request->validate([
            'name'=>'required',
            'username'=>'required|unique:users',
            'password'=>'required',
            'type'=>'required',
       ]);
    //    $user = new User;
    //    $user->name = $request->name;
    //    $user->username = $request->username;
    //    $user->password = $request->password;
    //    $user->type = $request->type;
    //    $query = $user->save();

    $query = DB::table('users')
                ->insert([
                    'name'=>$request->name,
                    'username'=>$request->username,
                    'password'=>$request->password,
                    'type'=>$request->type
                ]);

       if($query){
           return back()->with('success','You have been successfully registered');
       }else{
           return back()->with('fail','Something fail');
       }
   }

   public function postLogin(Request $request)
   {
       $request->validate([
           'username'=>'required',
            'password'=>'required'
       ]);
    //    $user = User::where('username','=',$request->username)->first();
       $user = DB::table('users')
                ->where('username',$request->username)
                ->first();

       if($user){
            if($request->password == $user->password){
                $request->session()->put('LoggedUser',$user->id);

                $type = DB::table('users')
                    ->where('id',session('LoggedUser'))
                    ->value('type');
                if($type == "Admin"){       
                    session(['type'=>$type]);
                    return redirect('register');
                }else if($type == "Player"){
                    session(['type'=>$type]);
                    return redirect('member');
                }else if($type == "Coach"){
                    session(['type'=>$type]);
                    return redirect('member');
                }
            }else{
                return back()->with('fail','Invail password.');
            }
       }else{
           return back()->with('fail','No account found for this username.');
       }
   }

   public function logout()
   {
       if(session()->has('LoggedUser')){
           session()->pull('LoggedUser');
           return redirect('login');
       }
   }

}
