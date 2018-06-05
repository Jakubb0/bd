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
        if(!session()->has('cashbox_active'))
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
<<<<<<< HEAD
	
	
		
=======
>>>>>>> 7437db143fc27320212b78f96e00e5e494ef35b2
    public function postTransaction()
    {
        dd(session('cashbox'));
        if($_POST['category'] == 1)
        {
           return view("cashboxes.receipt");
        }

        elseif ($_POST['category'] == 2)
        {
            $token = $_POST['datatoken'].$_POST['_token'];
            if( !DB::select("SELECT * FROM transactions WHERE token='". $token ."'") )
            {
                if( !DB::select("SELECT * FROM invoices WHERE NIP='". $_POST['invoicesNIP'] ."'") )
                cashbox::addInvoicesData();
                if(isset($_POST['clientPhone']))
                {
                    if( !DB::select("SELECT * FROM loyalclients WHERE phone='". $_POST['clientPhone'] ."'"))
                    loyalclient::addClientCard();
                    $cCode = $_POST['clientCode'];
                    $loyalID = $loyalclientID = DB::select("SELECT id FROM loyalclients WHERE clientCode = '". $cCode ."'");
                }
                else 
                {
                    $loyalID = 1;
                }

                if( isset($_POST['fuelPrice']) ) 
                {
                    $distributor = $_POST['distributor']; 
                    $fuelQty = $_POST['fuelQtySelect'];

                    //$selectActualAmount = DB::select("SELECT amount FROM fuels WHERE type = '". $_POST['fuelTypeSelect'] ."'");

                    $selectActualAmount = DB::table('fuels')->where('type', $_POST['fuelTypeSelect'])->first();
                    $actualAmount = $selectActualAmount->amount;
                    
                    
                    $fuelAmount = $actualAmount-$fuelQty;

<<<<<<< HEAD
                    DB::table('fuels')->where('type', $_POST['fuelTypeSelect'])->update(array(
                     'amount'=>$fuelAmount));
=======

            /*
            if (Session::has('cashbox'))
            {
                $value = session()->get('cashbox');
>>>>>>> 859df6b053dce1818e0e98afc5fdc40d98c7774d

                }
                else 
                {
                    $distributor = 1;
                }
                
                $idTransaction = DB::table('transactions')->insertGetId([     
                    'client_id' => 1,
                    'sum' => 1,
                    'loyalclients_id' => $loyalID,
                    'distributor_id' => $distributor,
                    'payment_method' => 'cash',
                    'proof' => '0',
                    'cashboxes_id' => '1',
                    'token' => $token,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")    
                ]);

                $products = session()->get('cashbox');
                //dd($products);
                if( $products != '' )
                {
                    $i = 0;

                    foreach( $products->items as $product )
                    {
                        $productID = DB::select("SELECT id FROM products WHERE name = '". $product['item']['name'] ."'");

                        foreach($productID as $key => $s)
                        {
                            $productID = $s->id;
                        }

                        DB::table('products_in_transaction')->insert([
                            'transactions_id' => $idTransaction,
                            'products_id' => $productID,
                            'amount' => $product['qty']
                        ]);   
                    }
                }
                

                return view("cashboxes.invoice");
            }
            else
            {
                return view("cashboxes.invoice");
            }

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

    public function back()
    {
        session()->forget('cashbox');
        return view("cashboxes.cashboxesUse"); 
    }
}