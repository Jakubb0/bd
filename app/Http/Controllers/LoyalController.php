<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loyalclient;
use App\logs;
use DB;

class LoyalController extends Controller
{
    public function loyalclientView()
    {
    	return view("loyal.loyalclientList");
    }

    public function loyalclientDelete(Request $request)
    {
		
		$id = $request["delete"];
		DB::table('loyalclients')->where('id', '=', $id)->delete();

		logs::addLog("Usunięto stałego klienta", "bad", "loyal");

		return view("loyal.loyalclientList");
    }

    public function add()
    {
    	return view("loyal.loyalclientAdd");
	}

	public function loyalclientAdd(Request $request)
	{
		
		/*
		$request->validate([
    		'firstname' => 'required',
    		'lastname' => 'required',
    		'phone' => 'required|regex:/[1-9]{1}[0-9]{8}/|max:9|unique: loyalclients'
		]);
		*/

		loyalclient::loyalAdd();
		logs::addLog("Dodano stałego klienta", "good", "loyal");
		
		return redirect()->route('loyalView'); 
		
	}
}
