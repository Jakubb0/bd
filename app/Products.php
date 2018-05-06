<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
	public static function newProduct(Request $request)
	{
		$name = $request["name"];
		$price = $request["price"];
		$category = $request["category"];
		$description = $request["description"];
		
		$products = new produkt();
		$products->name = $name;
		$products->price = $price;
		$products->category = $category;
		$products->description = $description;


		$products->password_changed = false;

		$products->save();
	}
}
