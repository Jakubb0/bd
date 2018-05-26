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
                ->orderBy('time', 'desc')
                ->get();
    			


    			if($logs)
	    		{
	    			foreach($logs as $key => $log)
	    			{
                        $bgcolor = DB::table('logs')
                        ->where('id', $log->id)
                        ->pluck('value')->first();

                        

	    				$output .= '<tr>
	    								<td>'. $i++ .'</td>
	    								<td>'. $log->ip .'</td>
	    								<td>'. $log->login .'</td>
	    								<td>'. $log->message .'</td>
	    								<td>'. $log->time .'</td>

	    							</tr>';
                                    
	    			}
	    			return Response($output);
	    		}
    		}	
    		else
    		{
    			$logs = DB::table('logs')->orderBy('time', 'desc')->get();
    			
    			if($logs)
	    		{
	    			foreach($logs as $key => $log)
	    			{
	    				$output .= '<tr>
	    								<td>'. $i++ .'</td>
	    								<td>'. $log->ip .'</td>
	    								<td>'. $log->login .'</td>
	    								<td>'. $log->message .'</td>
	    								<td>'. $log->time .'</td>
	    							</tr>';
	    			}
	    			return Response($output);
	    		}
    		}
    	}
    }

    public function searchNumberClient(Request $request)
    {
        if($request->ajax())
        {
            $output = "";

            $clientNumber = DB::table('client')->where('clientNumber','LIKE','%'.$request->search.'%')
                                        ->get();
            if($clientNumber)
            {
                $i = 0;

                $output .= '<ul id="clientList">';

                foreach($clientNumber as $key => $number)
                {
                    $output .= '
                        <li onClick="selectNumberClient(\''. $number->clientNumber .'\');">'. $number->clientNumber .'</li>
                    ';
                }

                $output .= '</ul>';

                return $output;
            }
        }
    }

}
