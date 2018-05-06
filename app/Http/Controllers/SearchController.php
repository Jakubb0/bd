<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
    	if($request->ajax())
    	{
    		$output = "";

    		$products = DB::table('products')->where('name','LIKE','%Pepsi%')
    		                                 ->orWhere('barcode', 'LIKE', '%'.$request->search.'%')->get();

    		if($products)
    		{
    			foreach($products as $key => $prod)
    			{
    				$output .= '<tr>
    								<td>'. $prod->id .'</td>
    								<td>'. $prod->nazwa .'</td>
    								<td>'. $prod->price .'</td>
    							</tr>';
    			}

    			return Response($output);
    		}
    	}
    }
}
