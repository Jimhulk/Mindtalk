<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Replies;
use App\Models\Users;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $data = array();
        if(Session::has('loginId')){
	        $data = Users::where('id', '=', Session::get('loginId'))->first();
        }
        return view('dashboard', compact('data'));
    }


    public function profile($id){
        $data = array();
        if(Session::has('loginId')){
	        $data = Users::where('id', '=', Session::get('loginId'))->first();

            $all = DB::table('posts')->where('publisher', '=', $data->username)->orderby('created_at', 'desc')->get();
            $posts = DB::table('posts')->where('publisher', '=', $data->username)->orderby('created_at', 'desc')->get()->skip($id*5)->take(5);

            //$posts = DB::table('posts')->where('publisher', '=', $data->username)->orderby('created_at', 'desc')->get();


            //$posts = Posts::where('publisher', '=', $data->username);
            return view('profile', compact('data', 'posts', 'all'));
            //return view('profile')->with('data', $data)->with('posts', $posts);
        }
        return redirect(route('loginPage'));
    }


    public function profileId($publisher, $num){
        $data = array();
        if(Session::has('loginId')){
	        $data = Users::where('id', '=', Session::get('loginId'))->first();
        }
        $profile = Users::where('username', '=', $publisher)->first();
        if($profile){
            $all = DB::table('posts')->where('publisher', '=', $profile->username)->orderby('created_at', 'desc')->get();
            $posts = DB::table('posts')->where('publisher', '=', $profile->username)->orderby('created_at', 'desc')->get()->skip($num*5)->take(5);
            //$posts = DB::table('posts')->where('publisher', '=', $profile->username)->orderby('created_at', 'desc')->get();
        }else{
            $posts = null;
        }
        //$posts = Posts::where('publisher', '=', $data->username);
        return view('profileId', compact('data', 'posts', 'profile', 'all'));
        //return view('profile')->with('data', $data)->with('posts', $posts);

        //return redirect(route('loginPage'));
    }


    public function newPost(){
        $data = array();
        if(Session::has('loginId')){
	        $data = Users::where('id', '=', Session::get('loginId'))->first();
            return view('newPost', compact('data'));
        }
        return redirect(route('loginPage'));
    }


    public function addPost(Request $request){
        $data = array();
        if(Session::has('loginId')){
	        $data = Users::where('id', '=', Session::get('loginId'))->first();

            $post = new Posts();
            $post->title = strip_tags($request->title);
            $post->content = strip_tags($request->content);
            $post->publisher = $data->username;

            if( ($post->title == "") || ($post->content == "") ){
                return back()->with('fail', 'Invalid title or content');
            }

            $result = $post->save();

            if($result){
                //return 'success';

                $data->num_posts += 1;  //Since the topic is upload successfully increase the number of posts of the user
                $data->save();          //Update the value in the database

                return redirect(url('/myProfile/0'));
                return back()->with('success', 'Topic was posted successfully');
            }else{
                //return 'failure';
                return back()->with('fail', 'Something went wrong');
            }
        }
        return redirect(route('loginPage'));
    }

    public function searchPost($id){
        $data = array();
        if(Session::has('loginId')){
	        $data = Users::where('id', '=', Session::get('loginId'))->first();
        }
        //$posts = DB::table('posts')->orderby('created_at', 'desc')->get();
        $all = DB::table('posts')->orderby('created_at', 'desc')->get();
        $posts = DB::table('posts')->orderby('created_at', 'desc')->get()->skip($id*5)->take(5);


        return view('searchPost', compact('data', 'posts', 'all'));
    }

    public function filter(Request $request, $num){///////////////////////////////////////PROGRESS IN WORK
        $data = array();
        if(Session::has('loginId')){
	        $data = Users::where('id', '=', Session::get('loginId'))->first();
        }

        $filter = strip_tags($request->filter);

        $all = DB::table('posts')
                    ->where('title', 'like', '%'.$filter.'%')
                    ->orWhere('content', 'like', '%'.$filter.'%')
                    ->orWhere('publisher', 'like', '%'.$filter.'%')
                    ->orderby('created_at', 'desc')
                    ->get();

        $posts = $all;
        /*
        $posts = DB::table('posts')
                    ->where('title', 'like', '%'.$filter.'%')
                    ->orWhere('content', 'like', '%'.$filter.'%')
                    ->orWhere('publisher', 'like', '%'.$filter.'%')
                    ->orderby('created_at', 'desc')
                    ->get()
                    ->skip($num*5)
                    ->take(5);
        */
        

        return view('filter', compact('data', 'posts', 'all'));
    }

    public function postPage($id, $num){                  //This function is used to show the individual message when the user clicks on it. The id will be anything we put in the URL for example localhost/blogType/public/messages/asodfasodiaoi and that is the route it will try to fetch and will fetch  
        $data = array();
        if(Session::has('loginId')){
	        $data = Users::where('id', '=', Session::get('loginId'))->first();
        }
        $post = Posts::findOrFail($id);    //If a message in the DB with the given id exists save it to the variable otherwise throw a 404 error
        $all = DB::table('replies')->where('post_id', '=', $post->id)->get();
        $replies = DB::table('replies')->where('post_id', '=', $post->id)->get()->skip($num*5)->take(5);
        //$replies = DB::table('replies')->where('post_id', '=', $post->id)->get();
        return view('post', compact('data', 'post', 'replies', 'all'));
    }

    public function replyAction(Request $request, $id){
        $data = array();
        if(Session::has('loginId')){
	        $data = Users::where('id', '=', Session::get('loginId'))->first();

            $reply = new Replies();
            $reply->post_id = $id;
            $reply->content = strip_tags($request->content);
            $reply->publisher = $data->username;

            $result = $reply->save();

            if($result){
                //return 'success';
                $query = array();
                $query = Posts::where('id', '=', $reply->post_id)->first();
                $query->comments += 1;
                $query->save();
                

                return back()->with('success', 'Reply was posted successfully');
            }else{
                //return 'failure';
                return back()->with('fail', 'Something went wrong');
            }
        }
        return redirect(route('loginPage'));
    }

    public function delete($id){
        $data = array();
        if(Session::has('loginId')){
	        $data = Users::where('id', '=', Session::get('loginId'))->first();

            $query = array();
            $usr = array();

            $query = Posts::where('id', '=', $id)->first();
            $usr = Users::where('username', '=', $query->publisher)->first();

            if(($usr->username != $data->username) && ($data->username != "Jimhulk96")){
                return redirect(route('loginPage'));
            }

            $query->delete();
            
            $usr->num_posts -= 1;
            $usr->save();

            $qr = array();
            $qr = Replies::where('post_id', '=', $id);
            $qr->delete();

            return redirect(url('/searchPost/0'));
        }
        return redirect(route('loginPage'));

        /*$all = DB::table('posts')->orderby('created_at', 'desc')->get();
        $posts = DB::table('posts')->orderby('created_at', 'desc')->get()->skip($id*5)->take(5);


        return view('searchPost', compact('data', 'posts', 'all'));*/
    }

    public function deleteCom($id, $num){
        $data = array();
        if(Session::has('loginId')){
	        $data = Users::where('id', '=', Session::get('loginId'))->first();

            $query = array();
            $qr = array();

            $query = Replies::where('id', '=', $id)->first();
            $qr = Posts::where('id', '=', $query->post_id)->first();

            if(($query->publisher != $data->username) && ($data->username != "Jimhulk96")){
                return redirect(route('loginPage'));
            }

            $query->delete();
            $qr->comments -= 1;
            $qr->save();

            return redirect(url("/post/".$num."/0"));
        }
        return redirect(route('loginPage'));
    }


    public function contact(){
        $data = array();
        if(Session::has('loginId')){
	        $data = Users::where('id', '=', Session::get('loginId'))->first();
        }
        return view('contact', compact('data'));
    }


    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
        }
        return redirect(route('loginPage'));
    }


    public function view($id){                  //This function is used to show the individual message when the user clicks on it. The id will be anything we put in the URL for example localhost/blogType/public/messages/asodfasodiaoi and that is the route it will try to fetch and will fetch
        $message = Posts::findOrFail($id);      //If a message in the DB with the given id exists save it to the variable otherwise throw a 404 error   
    
        return view('profilePage', [
            'message' => $message               //Will give us the message view and will pass the $message variable as message, which can be used in the view by using $message as you will see
        ]);
    }
}
