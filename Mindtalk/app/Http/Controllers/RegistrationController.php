<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Users;
use Illuminate\Http\Request;
use Hash;

class RegistrationController extends Controller
{
    public function index(){
        if(Session::has('loginId')){
            Session::pull('loginId');
        }
        return view('registration');
    }

    public function check(Request $request){
        $request->validate([
            'fname'=>'required|min:1',
            'lname'=>'required|min:1',
            'email'=>'required|email|unique:users',
            'username'=>'required|unique:users|min:3',
            'password'=>'min:6'	
        ]);

        $user = new Users();

        $user->fname = strip_tags($request->fname);
        $user->lname = strip_tags($request->lname);
        $user->email = $request->email;
        $user->username = strip_tags($request->username);
        $user->verified = false;
        $user->password = Hash::make($request->password);

        if($user->fname == ""){
            return back()->with('fail', 'Invalid First Name');
        }else if($user->lname == ""){
            return back()->with('fail', 'Invalid Last Name');
        }else if($user->username == ""){
            return back()->with('fail', 'Invalid Username');
        }

        $result = $user->save();

        if($result){
            //return 'success';
            $log = Users::where('email', '=', $user->email)->first();
            $request->session()->put('loginId', $log->id);
            return redirect(route('homepage'));
            //return back()->with('success', 'You have registered');
        }else{
            //return 'failure';
            return back()->with('fail', 'Something wrong');
        }
    }
}
