<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\distributors;
use App\logs;
use DB;


class DistributorsController extends Controller
{
    public function distributorsView()
    {
    	return view("distributors.distributorsList");
    }

    public function distributorsAdd()
    {
    	return view("distributors.distributorsAdd");
    }

    public function distributorsNew(Request $request)
    {

    	$fuels = $request->fuel;

    	foreach ($fuels as $key => $value) 
    	{
    		$dist = new distributors();

    		$dist->station = $request->distributor_id;
    		$dist->fuels_id = \App\fuels::where('type', $value)->pluck('id')->first();
    		
    		$dist->save();

    		
    	}

        logs::addLog("Dodano dystrybutor", "good", "distributors");
    	return redirect()->route("distributorsView");
    }
    
}
