<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pracownik;
use Illuminate\Support\Facades\Auth;
use DB;

class LoginController extends Controller
{

	public function pracownik()
	{
		return view("pracownik");
	}

	public function dodajpracownika()
	{
		return view("dodajpracownika");
	}
	
	public function listapracownikow()
	{
		return view("listapracownikow");
	}

	public function home()
	{
		if(Auth::check())
		{
			Auth::logout();
		}
		return view("welcome");
	}

	public function usun(Request $request)
	{
		pracownik::usun($request);
		return view("listapracownikow");
	}

	public function postAdd(Request $request)
	{
		
		pracownik::nowy($request);
		return redirect()->route('pracownik'); 
	}


	public function postZmien(Request $request)
	{
		pracownik::aktualizuj($request);		
		return redirect()->route('pracownik'); 
	}

	public function postLogin(Request $request)
	{
		if (Auth::attempt(['login' => $request['login'], 'password' => $request['pass']])) {


			DB::update('update pracownicy set ostatnio_aktywny = ? where login = ?' , [date("Y-m-d H:i:s") ,$request['login']]);

			$root = DB::table('pracownicy')->where('id', 1)->pluck('login');

				if($root=="root")
				{
					return view('zmiendane');
				}

			return redirect()->route('pracownik');	
        }
        return redirect()->back();
	}
}

