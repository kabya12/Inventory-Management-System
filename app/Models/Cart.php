<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Other methods or properties related to the Cart model can be defined here

    // For example, you can define a method to retrieve the cart content
    public static function getCartContent()
    {
        // Retrieve cart content using the shopping cart package
        return \Anayarojo\Shoppingcart\Facades\Cart::content();
    }
}
