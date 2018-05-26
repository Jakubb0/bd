<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrder() 
    {
    	return view("orders.index");
    }

    public function getReceiptCashBox()
    {

    }

    public function postReceiptCashBox()
    {

    }

    public function getInvoiceCashBox()
    {

    }

    public function postInvoiceCashBox()
    {
    	
    }
}
