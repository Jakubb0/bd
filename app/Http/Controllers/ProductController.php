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

class ProductController extends Controller
{
    public function getProduct()
    {
        $products = Products::all();
    	return view("product.product", ['products' => $products]);
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
       // dd($request->session()->get('cart'));
        return redirect()->route('getProduct');
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

            for( $i=1; $i <= count($value->items); ++$i )
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



} 
