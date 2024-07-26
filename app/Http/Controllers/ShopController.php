<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    function shop(){
        $dsSP = Product::with('category')->get();
        return view('shop', compact(['dsSP']));
    }
    function detail(){

    }
}