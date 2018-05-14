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

                foreach($products as $key => $prod)
                {
                    
                    $output .= '<tr>
                                    <td>'. $prod->id .'</td>
                                    <td>'. $prod->name .'</td>
                                    <td>'. $prod->price .'</td>
                                    <td><input type="number" name="qty" id="qty"></input></td>'.
                                     "<td><a href=" . '"' . route('product.addToCashbox', ['id' => $prod->id]) . '"' . "class='btn btn-success' role='button'>Zamów</a></td>" .
                                '</tr>';
                }

                return Response($output);
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
