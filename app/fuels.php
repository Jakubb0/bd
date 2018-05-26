<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class fuels extends Model
{
	public $timestamps = false;
	
	public static function fuelsAdd(Request $request)
	{
		$type = $request["type"];
		$price = $request["price"];
		$amount = $request["amount"];
		$fuels = new fuels();
		$fuels->type = $type;
		$fuels->price = $price;
		$fuels->amount = $amount;
		
		$fuels->save();
	}
}
