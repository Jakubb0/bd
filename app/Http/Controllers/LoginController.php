<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pracownik;
use Illuminate\Support\Facades\Auth;
use DB;

class LoginController extends Controller
{

	public function empView()
	{
		return view("emp");
	}

	public function empAdd()
	{
		return view("empAdd");
	}
	
	public function empList()
	{
		return view("empList");
	}

	public function home()
	{
		if(Auth::check())
		{
			Auth::logout();
		}
		return view("welcome");
	}

	public function empDelete(Request $request)
	{
		pracownik::empdelete($request);
		return view("empList");
	}

	public function postAdd(Request $request)
	{
		
		pracownik::empnew($request);
		return redirect()->route('empList'); 
	}


	public function postUpdate(Request $request)
	{
		pracownik::loginupdate($request);		
		return redirect()->route('dashboard'); 
	}

	public function postLogin(Request $request)
	{
		if (Auth::attempt(['login' => $request['login'], 'password' => $request['pass']])) {
			
			DB::update('update pracownicy set login_date = ? where login = ?' , [date("Y-m-d H:i:s") ,$request['login']]);

			$root = DB::table('pracownicy')->where('id', 1)->pluck('login');

				if($root[0]=="root")
				{		
					return view('empUpdate');
				}

			return redirect()->route('dashboard');	
        }
        return redirect()->back();
	}
}

