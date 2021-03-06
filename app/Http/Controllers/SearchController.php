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

            $prod2 = DB::table('products_in_depots')
                    ->leftJoin('products', 'products_in_depots.products_id', '=', 'products.id')
                    ->orWhere('products.name', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('barcode', 'LIKE', '%'.$request->search.'%')
                    ->where('products_in_depots.amount_in_depot', '>', 0)
                    ->get();

            if($prod2)
            {
                $i = 0;

                foreach($prod2 as $key => $prod)
                {
                        
                    if( $prod->vat == "8" ) { $p = ($prod->price * 0.08) + $prod->price; }
                    else { $p = ($prod->price * 0.23) + $prod->price; }

                    $output .= '
                        <div class="search-product">
                            <form action="'. route('product.addToCashbox', ['id' => $prod->id]) .'" method="GET">
                                    '. $prod->id .'
                                    '. $prod->name .'
                                    '. $p .'
                                    <div class="input-right">
                                        <input type="number" name="qty" id="qty" value="1">
                                        <input type="submit" name="add_product" class="btn btn-success product-list" role="button" value="Zamów">  
                                    </div>
                            </form>
                        </div>
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


    public function orderHistory(Request $request)
    {
        if($request->ajax())
        {
            $output = "";

            $products = DB::table('products_in_order')->where('orders_id',$request->id)
                                             ->get();

            if($products)
            {
                foreach($products as $key => $prod)
                { 
                    $output .= '<tr>
                                    <td>'. DB::table('products')->where('id',$prod->products_id)->pluck('name')->first() .'</td>
                                    <td>'. $prod->buying_price .'</td>
                                    <td>'. $prod->amount .'</td>
                                </tr>';
                }

                return Response($output);
            }
        }
    }

}
