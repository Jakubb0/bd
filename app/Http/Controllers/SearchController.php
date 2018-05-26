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

    		$products = DB::table('products')->where('name','LIKE','%'.$request->search.'%')
    		                                 ->orWhere('barcode', 'LIKE', '%'.$request->search.'%')->get();

    		if($products)
    		{
    			foreach($products as $key => $prod)
    			{


                    $output .= '<tr>
    								<td>'. $prod->id .'</td>
    								<td>'. $prod->name .'</td>
    								<td>'. $prod->price .'</td>
    							</tr>';
    			}

    			return Response($output);
    		}
    	}
    }


    public function searchCashbox(Request $request)
    {
        if($request->ajax())
        {
            $output = "";

            $products = DB::table('products')->where('name','LIKE','%'.$request->search.'%')
                                             ->orWhere('barcode', 'LIKE', '%'.$request->search.'%')->get();
            if($products)
            {
                $i = 0;

                foreach($products as $key => $prod)
                {
                        
                    if( $prod->vat == "8" ) { $p = ($prod->price * 0.08) + $prod->price; }
                    else { $p = ($prod->price * 0.23) + $prod->price; }

                    $output .= '
                        <form action="'. route('product.addToCashbox', ['id' => $prod->id]) .'" method="GET">
                                '. $prod->id .'
                                '. $prod->name .'
                                '. $p .'
                                <input type="number" name="qty" id="qty">
                                <input type="submit" name="add_product" class="btn btn-success product-list" role="button" value="Zamów">  
                        </form>
                    ';
                }

                return $output;
            }
        }
    }

    public function searchLogs(Request $request)
    {
    	if($request->ajax())
    	{
    		$output = "";
    		$i = 1;	

    		if($request->category != "selectAll")
    		{
    			$logs = DB::table('logs')
                ->where('category','LIKE','%'.$request->category.'%')
                ->orderBy('id', 'desc')
                ->get();
    			
    			if($logs)
	    		{
	    			foreach($logs as $key => $log)
	    			{
	    				$output .= '<tr>
	    								<td>'. $i++ .'</td>
	    								<td>'. $log->ip .'</td>
	    								<td>'. $log->login .'</td>
	    								<td>'. $log->category .'</td>
	    								<td>'. $log->time .'</td>
	    							</tr>';
	    			}
	    			return Response($output);
	    		}
    		}	
    		else
    		{
    			$logs = DB::table('logs')->get();
    			
    			if($logs)
	    		{
	    			foreach($logs as $key => $log)
	    			{
	    				$output .= '<tr>
	    								<td>'. $i++ .'</td>
	    								<td>'. $log->ip .'</td>
	    								<td>'. $log->login .'</td>
	    								<td>'. $log->category .'</td>
	    								<td>'. $log->time .'</td>
	    							</tr>';
	    			}
	    			return Response($output);
	    		}
    		}
    	}
    }

}
