<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices;
use App\logs;

class InvoicesController extends Controller
{
    public function view()
    {
    	return view("invoices.invoicesView");
    }

    public function new(Request $request)
    {
		$request->validate([
    		'name' => 'required|unique:invoices',
    		'nip' => 'required|regex:/[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}/|unique:invoices',
    		'tax' => 'required'
		]);

    	invoices::add($request);
    	logs::addLog("Dodano dane do faktury", "good", "invoices");
    	return redirect()->route("viewInvoices");
    }

    public function add(Request $request)
    {
    	return view("invoices.invoicesAdd");
    }
}
