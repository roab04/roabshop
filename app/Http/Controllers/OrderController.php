<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    function order(){
        return view('order');
    }
    function checkout(){
        return view('checkout');
    }
    function thankyou(){
        return view('thankyou');
    }
    
}