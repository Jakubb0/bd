<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class cashbox extends Model
{
    public $timestamps = false;

    public static function addInvoicesData()
    {

    	if( isset($_POST['invoicesCompany']) ) {
           	$invoicesName = $_POST['invoicesCompany'];
        }
        elseif( (isset($_POST['invoicesFirstname'])) AND (isset($_POST['invoicesLastname'])) )
        {
            $invoicesName = $_POST['invoicesFirstname'] .' '. $_POST['invoicesLastname'];
        }

		$invoicesPostalCode = $_POST['invoicesPostalCode'];
        $invoicesPlace = $_POST['invoicesPlace'];
        $invoicesStreet = $_POST['invoicesStreet'];
        $invoicesHouseNumber = $_POST['invoicesHouseNumber'];
        $invoicesNIP = $_POST['invoicesNIP'];

		$addInvoices = new invoices();
		$addInvoices->name = $invoicesName;
		$addInvoices->NIP = $invoicesNIP;
		$addInvoices->tax_percent = 23;
		$addInvoices->place = $invoicesPlace;
		$addInvoices->postalcode = $invoicesPostalCode;
		$addInvoices->street = $invoicesStreet;
		$addInvoices->number = $invoicesHouseNumber;

		$addInvoices->save();
    }

}
