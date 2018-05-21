<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\fuels;
use App\logs;
use DB;

class fuelsController extends Controller
{
    public function fuelsView()
    {
    	return view("fuels.fuelsList");
    }

    public function fuelsDelete(Request $request)
    {
		
		$id = $request["delete"];
		DB::table('fuels')->where('id', '=', $id)->delete();

		logs::addLog("Usuni�to paliwo", "bad", "fuels");

		return view("fuels.fuelsList");
    }

    public function add()
    {
    	return view("fuels.fuelsAdd");
	}

	public function fuelsAdd(Request $request)
	{
		fuels::fuelsAdd($request);
		logs::addLog("Dodano paliwo", "good", "fuels");

		return redirect()->route('fuelsView'); 
	}
}