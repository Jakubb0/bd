<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cashbox;
use DB;
use Illuminate\Support\Facades\Auth;


class CashboxController extends Controller
{
    public function view()
    {
    	return view("cashboxes.cashboxes");
    }

    public function add()
    {


    	$cashbox = new cashbox();
    	$cashbox->openTime = date("Y-m-d H:i:s");
    	$cashbox->closeTime = date("Y-m-d H:i:s");
    	$cashbox->save();
    	return redirect()->route("cashboxes");
    }

    public function select()
    {
    	return view("cashboxes.cashboxesSelect");
    }

    public function use()
    {
		DB::table('cashboxes')->where('id', $_POST['cashbox_number'])->update(array(
                     'employee_id'=>Auth::Id(),
		));
    	return view("cashboxes.cashboxesUse");
    }
}
