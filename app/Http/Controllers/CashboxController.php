<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cashbox;
use App\NumberInWords;
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

    public function selectPOST() 
    {
        if(!session()->has('cashbox_actie'))
        {
            session()->put('cashbox_active', $_POST['cashbox_number']);
            return redirect()->route("useCashbox");
        }
        else
        {
            return redirect()->route("useCashbox");
        }
    }

    public function use()
    {
        if(session()->has('cashbox_active'))
        {
            DB::table('cashboxes')->where('id', session()->get('cashbox_active'))->update(array(
                     'employee_id'=>Auth::Id(),
            ));
        }
        else
        {
            session()->put('cashbox_active', $_POST['cashbox_number']);
        }

    	

        return view("cashboxes.cashboxesUse");   
    }

    public function postTransaction()
    {
        if($_POST['category'] == 1)
        {
           return view("cashboxes.receipt");
        }
        elseif ($_POST['category'] == 2)
        {

            if( !DB::select("SELECT * FROM invoices WHERE NIP='". $_POST['invoicesNIP'] ."'") )
            cashbox::addInvoicesData();

            return view("cashboxes.invoice");
        }
        else 
        {
            return view("cashboxes.cashboxesUse"); 
        }
    }

    public function saveTransaction()
    {
        if($_GET['category'] == 1)
        {
            
        }
        else 
        {

        }
    }


}
