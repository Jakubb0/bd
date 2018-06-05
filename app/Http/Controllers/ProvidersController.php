<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\providers;
use App\logs;

class ProvidersController extends Controller
{
	public function providersList()
	{
		return view("providers.providersList");
	}

	public function providersAdd()
	{
		return view("providers.providersAdd");
	}

	public function providersNew(Request $request)
	{

		$providers = new providers();

		$providers->name = $request->name;
		$providers->nip = $request->nip;
		
		$providers->save();

		logs::addLog("Dodano dostawce", "good", "providers");
		return redirect()->route("providersList");
	}
}
