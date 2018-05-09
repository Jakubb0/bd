<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\depots;
use App\logs;
use DB;

class DepotsController extends Controller
{
    public function view()
    {
    	return view("depots.depotsList");
    }

    public function add()
    {
    	return view("depots.depotsAdd");
    }

    public function new(Request $request)
    {
		$request->validate([
    		'name' => 'required|unique:depots'
		]);

    	depots::new($request);
    	logs::addLog("Dodano magazyn: ".$request['name'], "good", "depots");
    	return redirect()->route('depots');
    }

    public function delete(Request $request)
    {
		$id = $request["delete"];
		DB::table('depots')->where('id', '=', $id)->delete();

    	logs::addLog("Usunięto magazyn: ".$request['name'], "bad", "depots");
    	return redirect()->route('depots');

    }

    public function addto()
    {
    	return view("depots.depotsAddto");
    }
}
