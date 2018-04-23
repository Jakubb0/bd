<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use File;

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

    public function postNewProduct(request $request)
    {


        if ($request->hasFile('file')) {

          //  $file = $request->file;
          //  $fileName = $file->getClientOriginalName();
          // Storage::disk('local')->put('images/product/', $file->name);

          /*  $file = $request->file;
            $name = $request->file->getClientOriginalName();
            $ext = $request->file->getClientOriginalExtension();

            $path = "images/product/";

            $fileName = time().'-'.$name;

            Storage::disk('local')->put($path.$fileName, file_get_contents($file));
        */

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

        return redirect()->route('getProduct');  

    }
} 
