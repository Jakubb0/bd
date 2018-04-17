<?php

namespace App;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class pracownik extends Model implements Authenticatable
{
	use \Illuminate\Auth\Authenticatable;  
	public $timestamps = false;
    protected $table = "pracownicy";
   
   public static function usun(Request $request)
   {
   		$id = $request["usun"];
		if(Auth::id()!=$id and $id!=1)
		{
		DB::table('pracownicy')->where('id', '=', $id)->delete();
		}
   }

	


	public static function nowy(Request $request)
	{

		$login = $request["login"];
		$pass = bcrypt($request["pass"]);
		$name = $request["name"];
		$surn = $request["surn"];
		$tel = $request["tel"];
		$kier = $request["kierownik"];

		$pracownik = new pracownik();

		$pracownik->login = $login;
		$pracownik->password = $pass;
		$pracownik->imie = $name;
		$pracownik->nazwisko = $surn;
		$pracownik->telefon = $tel;
		$pracownik->data_dolaczenia = date("Y-m-d H:i:s");
		$pracownik->ostatnio_aktywny = date("Y-m-d H:i:s");
		$kier =="kierownik" ? $kier="kierownik" : $kier="pracownik";
		$pracownik->status = $kier;

		$pracownik->save();
	}
    public static function aktualizuj(Request $request)
    {
    	$login = $request["login"];
		$pass = bcrypt($request["pass"]);
		$name = $request["name"];
		$surn = $request["surn"];
		$tel = $request["tel"];
		

		DB::update('update pracownicy set login = ? where id = 1' , [$login]);
		DB::update('update pracownicy set password = ? where id = 1' , [$pass]);
		DB::update('update pracownicy set imie = ? where id = 1' , [$name]);
		DB::update('update pracownicy set nazwisko = ? where id = 1' , [$surn]);
		DB::update('update pracownicy set telefon = ? where id = 1' , [$tel]);
	}
    
}
