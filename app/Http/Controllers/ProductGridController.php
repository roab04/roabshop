<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductGridController extends Controller
{
    public function product_grid(){
        return view('productgrid');
    }
}
