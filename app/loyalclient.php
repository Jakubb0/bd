<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class loyalclient extends Model
{
	public $timestamps = false;
	
	public static function addClientCard()
    {
    	$firstname = $_POST['clientFirstname'];
    	$lastname = $_POST['clientLastname'];
    	$phone = $_POST['clientPhone'];
    	$clientCode = $_POST['clientCode'];

    	$addClientCard = new loyalclient();
    	$addClientCard->firstname = $firstname;
    	$addClientCard->lastname = $lastname;
    	$addClientCard->phone = $phone;
    	$addClientCard->clientCode = $clientCode;

    	$addClientCard->save();
    }
}
