<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class invoices extends Model
{
    public $timestamps = false;


    public static function add(Request $request)
    {
		$name = $request["name"];
		$nip = $request["nip"];
		$tax = $request["tax"];

		$invoice = new invoices();

		$invoice->name = $name;
		$invoice->nip = $nip;
		$invoice->tax_percent = $tax;

		$invoice->save();
    }
}
