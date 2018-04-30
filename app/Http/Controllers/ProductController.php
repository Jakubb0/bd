<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use File;
use App\logs;

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

        $request->validate([
            'name' => 'required|min:3'           
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
             'category' => $request['category'],
             'description' => $request['description'],
             'image' => $fileName,
             'created_at' => date("Y-m-d H:i:s"),
             'updated_at' => date("Y-m-d H:i:s")
             ]
        ]);

        logs::addLog("Dodano nowy produkt ". $request['name'], "good");

        return redirect()->route('getProduct');  

    }
} 
