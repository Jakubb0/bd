<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class depots extends Model
{
    public $timestamps = false;


    public static function new(Request $request)
    {
		$name = $request["name"];
		$desc = $request["desc"];

		$depots = new depots();

		$depots->name = $name;
		$depots->description = $desc;

		$depots->save();
    }
}
