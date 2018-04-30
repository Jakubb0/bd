<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class loyalclient extends Model
{
	public $timestamps = false;
	
	public static function loyalAdd(Request $request)
	{
		$name = $request["name"];
		$surn = $request["surn"];
		$tel = $request["tel"];
		$city = $request["city"];
		$loyalclient = new loyalclient();
		$loyalclient->name = $name;
		$loyalclient->surname = $surn;
		$loyalclient->phone = $tel;
		$loyalclient->city = $city;
		
		$loyalclient->save();
	}
}
