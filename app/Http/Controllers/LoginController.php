<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\pracownik;
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
		return redirect()->route('employeeList'); 
	}
	public function postUpdate(Request $request)
	{
		pracownik::loginupdate($request);		
		return redirect()->route('dashboard'); 
	}
	public function postLogin(Request $request)
	{
		$request->validate([
    		'login' => 'required',
    		'pass' => 'required'
    	]);
    	
		if (Auth::attempt(['login' => $request['login'], 'password' => $request['pass']])) {
			
			DB::update('update pracownicy set login_date = ? where login = ?' , [date("Y-m-d H:i:s") ,$request['login']]);
			$root = DB::table('pracownicy')->where('id', 1)->pluck('login');
				if($root[0]=="root")
				{		
					return view('employeeUpdate');
				}
			return redirect()->route('dashboard');	
        }
        return redirect()->back();
	}
	public function getLogout()
	{
		Auth::logout();
		return redirect()->route('home');
	}
}
