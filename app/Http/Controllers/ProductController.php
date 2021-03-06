<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Products;
use App\Order;
use DB;
use Illuminate\Support\Facades\Storage;
use File;
use App\logs;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function getProduct()
    {
        $products = Products::all();
    	return view("product.product", ['products' => $products]);
    }

    public function getProductCash()
    {
        $products = DB::table('products_in_depots')
                        ->leftJoin('products', 'products_in_depots.products_id', '=', 'products.id')
                        ->get();
        
        return view("product.productCash", ['products_depots' => $products]);
    }

    public function getNewProduct()
    {
    	return view("product.newProduct");
    }

    public function postNewProduct(Request $request)
    {

        $this->validate($request, [
            'name'=>'required|min:1',
            'price'=>'required',
            'vat'=>'required',
            'category'=>'required',
            'description'=>'required',
            'barcode'=>'required|min:5'
        ]);

        if ($request->hasFile('file')) {

            $file = $request->file;
            $name = $request->file->getClientOriginalName();
            $path = "images/product/";
            $fileName = $name;
            $file->move('images/product/', $file->getClientOriginalName());
        }
        else 
        {
            $fileName = '';
        }

        DB::table('products')->insert([
            ['name' => $request['name'], 
             'price' => $request['price'],
             'vat' => $request['vat'],
             'category' => $request['category'],
             'description' => $request['description'],
             'image' => $fileName,
             'barcode' => $request['barcode'],
             'created_at' => date("Y-m-d H:i:s"),
             'updated_at' => date("Y-m-d H:i:s")
             ]
        ]);

        logs::addLog("Dodano nowy produkt ". $request['name'], "good", "product");

        return redirect()->route('getProduct');  

    }


    public function getAddToCart(Request $request, $id) {
        $product = Products::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('getProduct');
    }


    public function getAddToCart2(Request $request) {

        foreach($request['qty'] as $r => $data)
        {
            
                $id = $r;
                $qty2 = $data;
            

            if($qty2 == 0) continue;
            
           

            $product = DB::table('products')->select('id')->where('id', '=', $id)->first();

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);

            //dd($product);
            $cart->add2($product, $id);

            
        }
       
        /*$product = Products::find($id);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        */
        $request->session()->put('cart', $cart);
        return redirect()->route('getProduct');
    }

    public function getAddToCashbox(Request $request, $id) {
      
        $product = Products::find($id);
        $oldCart = Session::has('cashbox') ? Session::get('cashbox') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cashbox', $cart);

        return redirect()->route('useCashbox');


    }

    public function getCart() {
        if (!Session::has('cart')) 
        {
            return view('orders.shopping-cart', ['products' => null]);
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);


        if (Session::has('cart'))
        {
            $value = session()->get('cart');
        }


        return view('orders.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function postCart(Request $request)
    {
        if(!Session::has('cart')) {
            return redirect()->route('product.shoppingCart');
        }

       $oldCart = Session::get('cart');
       $cart = new Cart($oldCart);

        $id = DB::table('orders')->insertGetId([     
                'providers_id' => 1,
                'pracownicy_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")    
        ]);


        if (Session::has('cart'))
        {
            $value = session()->get('cart');

            for( $i=1; $i <= count($value->items); $i++ )
            {

                $price = $value->items[$i]['price'];
                $amount = $value->items[$i]['qty'];

                $productNAME = $value->items[$i]['item']->name;
                $productID = DB::table('products')->select('id')->where('name', $productNAME)
                             ->get();

                foreach($productID as $key => $s)
                {
                    $productID = $s->id;
                }

                DB::table('products_in_order')->insert([
                    [
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                        'orders_id' => $id,
                        'products_id' => $productID,
                        'buying_price' => $price,
                        'amount' => $amount
                    ]
                ]);
            }

            session()->forget('cart');
        }
        


        return redirect()->route('product.getCart');


    }

    public function order(Request $request)
    {

        

        if(!Session::has('cart')) {
            return redirect()->route('product.shoppingCart');
        }

       $oldCart = Session::get('cart');
       $cart = new Cart($oldCart);

        $id = DB::table('orders')->insertGetId([     
                'providers_id' => 1,
                'pracownicy_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")    
        ]);

       
        foreach( $cart->items as $product ) 
        {
            //dd($product['item']['id']);
            $price = $product['price'];
            $amount = $product['qty'];
            $productID = $product['item']->id;


            DB::table('products_in_order')->insert([
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'orders_id' => $id,
                'products_id' => $productID,
                'buying_price' => $price,
                'amount' => $amount
            ]);


            $selectProduct = DB::table('products_in_depots')->select('products_id')->where('products_id', '!=', $productID)->get();


           // dd($productID);

            if( DB::table('products_in_depots')->where('products_id', '=', $productID)->first() )
            {
                

                
                $productAMOUNT = DB::table('products_in_depots')->where('products_id', '=', $productID)->get();
                $actualAmountProd = $productAMOUNT[0]->amount_in_depot;

                $newAmount = $actualAmountProd+$amount;

                DB::table('products_in_depots')
                    ->where('products_id', $productID)
                    ->update(['amount_in_depot' => $newAmount]);
                
            }
            else
            {
                DB::table('products_in_depots')->insert([
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'depots_id' => 1,
                    'products_id' => $productID,
                    'amount_in_depot' => $amount
                ]);
                
            }
            
        }       

         session()->forget('cart');
         return redirect()->route('product.getCart');
    }


    public function ordersHistory()
    {
        return view("product.orderList");
    }



} 
