<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Users;
use Hash;

class LoginController extends Controller
{
    public function index(){
        if(Session::has('loginId')){
            Session::pull('loginId');
        }
        return view('login');
    }

    public function check(Request $request){
        $user = Users::where('email', '=', $request->log_email)->first();

	
	    if($user){		//If the query was succesfull
		    if(Hash::check($request->log_psw, $user->password)){	//If the hash of the input is the same as the hash of the query above
			    $request->session()->put('loginId', $user->id);	//Start a session, save in the session variable loginId the id of the found user in the table in our DB
			    return redirect(route('homepage'));
		    }else{
			    return back()->with('fail', 'Incorrect password');
		    }
	    }else{
		    return back()->with('fail', 'This email is not registered');	//Used to show error message in the page like above in the registration
	    }
    }
}
