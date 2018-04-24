<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class logs extends Model implements Authenticatable
{
	use \Illuminate\Auth\Authenticatable;  

    public $timestamps = false;

    public static function addLog(string $action, string $value)
    {
				$login = DB::table('pracownicy')->where('id', Auth::id())->pluck('login');
				$ip  = $_SERVER['REMOTE_ADDR'];

				$log = new logs();
				$log->login = isset($login[0])?$login[0]:$POST_['login'];
				$log->ip = $ip;
				$log->message = $action;
				$log->value = $value;
				$log->time = date("Y-m-d H:i:s");

				$log->save();
    }

}
