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
   
   public static function employeeDelete(Request $request)
   {
   		$id = $request["delete"];
		if(Auth::id()!=$id and $id!=1)
		{
		DB::table('pracownicy')->where('id', '=', $id)->delete();
		}
   }
	
	public static function employeeNew(Request $request)
	{
		$login = $request["login"];
		$pass = bcrypt($request["pass"]);
		$name = $request["name"];
		$surn = $request["surn"];
		$tel = $request["tel"];
		$status = $request["status"];
		$employee = new pracownik();
		$employee->login = $login;
		$employee->password = $pass;
		$employee->name = $name;
		$employee->surname = $surn;
		$employee->phone = $tel;
		$employee->join_date = date("Y-m-d H:i:s");
		$employee->login_date = date("Y-m-d H:i:s");
		$status =="kierownik" ? $status="kierownik" : $status="pracownik";
		$employee->status = $status;

		$employee->password_changed = false;

		$employee->save();
	}
	
    public static function loginupdate(Request $request)
    {
    	$login = $request["login"];
		$pass = bcrypt($request["pass"]);
		$name = $request["name"];
		$surn = $request["surn"];
		$tel = $request["tel"];
		

		DB::table('pracownicy')->where('id', Auth::id())->update(array(
             'login'=>$login,
             'password'=>$pass,
             'name'=>$name,
             'surname'=>$surn,
             'phone'=>$tel,
             'password_changed'=>1,
		));

/*
		DB::update('update pracownicy set login = ? where id = 1' , [$login]);
		DB::update('update pracownicy set password =? where id = 1' , [$pass]);
		DB::update('update pracownicy set name = ? where id = 1' , [$name]);
		DB::update('update pracownicy set surname = ? where id = 1' , [$surn]);
		DB::update('update pracownicy set phone = ? where id = 1' , [$tel]);
		*/

	}
    
    public function orders() 
    {
    	return $this->hasMany('App\Order');
    }
}