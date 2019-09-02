<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Validator;
use DB;
use Auth;
use Mail;



class AdminController extends Controller
{
    //
    function isadmin(){
    	if (Auth::id() == 1) {
    		return Redirect::to('/admin');
    	} else{
    		Session::flash("error", ["You are not admin"]);
            return Redirect::to('/home');
    	}
    }

    function goToAdminPage(){
    	$users = User::where('id', '!=', 1)->where('verify', '!=', 1)->get();
        $message = Message::all();
		return view("adminPage")->with('users', $users)->with('message', $message);
    }

   

    function verify($id){

		$user = User::find($id);
			DB::table('users')->where('id', $user->id)->update(['verify' => 1]);
            $email = DB::table('users')->where('id', $user->id)->value('email');
             Mail::send('mail', $data, function($message) use($email) {
         $message->to($email, "Admin")->subject
            ('Your account is active!');
         $message->from('arminekhachatryan02@gmail.com',"Admin");
      });
        return Redirect::to('/admin');


	}

	function delete($id){
		$user = User::find($id);
			DB::table('users')->where('id', $user->id)->delete();
            $email = DB::table('users')->where('id', $user->id)->value('email');
             Mail::send('mail', $data, function($message) use($email) {
         $message->to($email, "Admin")->subject
            ('Sorry your account was deleted!');
         $message->from('arminekhachatryan02@gmail.com',"Admin");
      });
        return Redirect::to('/admin');
	}

     function message(Request $r){
        // var_dump($r);
        // die; 
       
        $validator = Validator::make(

            [
                'name' => $r->name,
                'email' => $r->email,
                'subject' => $r->subject,
                'message' => $r->message,
            ],
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'subject' => 'required',
                'message' => 'required',
            ]
        );
 
        if ($validator->fails()) {

              return redirect('/home')
                        ->withErrors($validator)
                        ->withInput();
        } else {
        $obj = new Message();
        $obj->user_id = Auth::id();
        $obj->user_name = $r->name;
        $obj->subject = $r->subject;
        $obj->message = $r->message;

        // $obj->save();
        // var_dump($obj); die;

        return view('message')->with('message', ['Please wait until the administrator responds to your request']);
        }
    }

	
}
