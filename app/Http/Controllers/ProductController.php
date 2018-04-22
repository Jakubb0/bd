<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function getProduct()
    {
    	return view("product.product");
    }

    public function getNewProduct()
    {
    	return view("product.newProduct");
    }

    public function postNewProduct(Request $request)
    {

        DB::table('products')->insert([
            ['name' => $request['name'], 
             'price' => $request['price'],
             'category' => $request['category'],
             'description' => $request['description'],
             'image' => $request['image'],
             'created_at' => date("Y-m-d H:i:s"),
             'updated_at' => date("Y-m-d H:i:s")
             ]
        ]);

        return redirect()->route('getProduct');  

    }
}
