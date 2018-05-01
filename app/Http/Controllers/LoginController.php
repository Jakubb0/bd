<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\pracownik;
use App\logs;
use Illuminate\Support\Facades\Auth;
use DB;
class LoginController extends Controller
{


	public function employeeView()
	{
		return view("employee");
	}

	public function employeeAdd()
	{
		return view("employeeAdd");
	}
	
	public function employeeList()
	{
		return view("employeeList");
	}
	public function home()
	{
		return view("welcome");
	}

	public function employeeDelete(Request $request)
	{
		logs::addLog("Usunięto użytkownika", "bad", "employee");
		pracownik::employeeDelete($request);
		return view("employeeList");
	}
	public function postAdd(Request $request)
	{
		$request->validate([
    		'login' => 'required|unique:pracownicy',
    		'pass' => 'required|min:8',
    		'name' => 'required',
    		'surn' => 'required',
    		'tel' =>  'required|regex:/[1-9]{1}[0-9]{8}/|max:9'
    		
		]);
		pracownik::employeeNew($request);
		logs::addLog("Dodano użytkownika", "good", "employee");

		return redirect()->route('employeeList'); 
	}
	public function postUpdate(Request $request)
	{
		/*
		$request->validate([
    		'login' => 'required|unique:pracownicy',
    		'pass' => 'required|min:8',
    		'name' => 'required',
    		'surn' => 'required',
    		'tel' =>  'required|regex:/[1-9]{1}[0-9]{8}/|max:9'
    		
		]);*/

		pracownik::loginupdate($request);	
		logs::addLog("Zaktualizowano dane", "good", "employee");	

		return redirect()->route('dashboard'); 
	}
	public function postLogin(Request $request)
	{
		$request->validate([
    		'login' => 'required',
    		'pass' => 'required'
    	]);
    	
		if (Auth::attempt(['login' => $request['login'], 'password' => $request['pass']])) {
			


			DB::table('pracownicy')->where('id', Auth::id())->update(array(
                                 'login_date'=>date("Y-m-d H:i:s"),
			));

			$password_changed = DB::table('pracownicy')->where('id', Auth::id())->pluck('password_changed');
				
			if($password_changed[0]==0)
			{
				$root = DB::table('pracownicy')->where('id', 1)->pluck('login');

					if($root[0]=="root")
					{		
						return view('employeeUpdate');
					}
				
					
        	}
        	logs::addLog("Udana próba logowania", "good", "login");
    		return redirect()->route('dashboard');
        	
		}
		else 
		{
			logs::addLog("Nieudana próba logowania", "bad", "login");
			return redirect()->back();
		}
	}
	public function getLogout()
	{
		logs::addLog("Wylogowano", "bad", "login");
		Auth::logout();
		return redirect()->route('home');
	}
}
