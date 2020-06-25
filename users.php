<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\user;



class users extends Controller
{
    //
	
	
	function list()
	{
		
		
		$user=user::all();
		return view('userlist' , ['user'=>$user]);
		
	}
	
	function create()
	{
		
		return view('create');
		
	}
	
	public function loginsubmit(Request $req)
	{
		user::select('*')->where(
		[
		['email','=',$req->email],
		['password','=',$req->password]
		]
		)->get();
		$req->session()->put('logData',[$req->input()]);
		
		return redirect('/list');
		
		//$user_list = DB::select('select * from users');
		//print_r($user_list);
	}
	
	public function createsubmit(Request $req)
	{
		
		$user = new User;
		$user->name=$req->name;
		$user->email=$req->email;
		$user->password=$req->password;
		$user->save();
		$result=$user->save();
		if($result)
		{
			
			return redirect('/list');
			
		}
		
		
	}
}
