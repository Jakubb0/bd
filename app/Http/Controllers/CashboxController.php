<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cashbox;
use App\loyalclient;
use App\NumberInWords;
use App\Cart;
use DB;
use Session;
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

            if( !DB::select("SELECT * FROM loyalclients WHERE phone='". $_POST['clientPhone'] ."'"))
            loyalclient::addClientCard();

            $cCode = $_POST['clientCode'];
            $loyalclientID = DB::select("SELECT id FROM loyalclients WHERE clientCode = '". $cCode ."'");

            $idTransaction = DB::table('transactions')->insertGetId([     
                'client_id' => 1,
                'sum' => 1,
                'loyalclients_id' => $loyalclientID[0]->id,
                'distributor_id' => $_POST['distributor'],
                'payment_method' => 'cash',
                'proof' => '0',
                'cashboxes_id' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")    
            ]);

            /*
            if (Session::has('cashbox'))
            {
                $value = session()->get('cashbox');

                for( $i=1; $i <= count($value->items); ++$i )
                {
                    dd($value->items[$i]);
                    $price = $value->items[$i]['price'];
                    $amount = $value->items[$i]['qty'];

                    $productNAME = $value->items[$i]['item']->name;
                    $productID = DB::table('products')->select('id')->where('name', $productNAME)
                                 ->get();

                    foreach($productID as $key => $s)
                    {
                        $productID = $s->id;
                    }

                    DB::table('products_in_transaction')->insert([
                        [
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s"),
                            'transactions_id' => $idTransaction,
                            'products_id' => $productID,
                            'amount' => $amount
                        ]
                    ]);
                }

            }
            */

            //if( isset() )

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

    public function clientCode()
    {
        return view("cashboxes.clientCode");
    }


}
