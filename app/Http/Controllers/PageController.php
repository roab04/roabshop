<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
        $dsSP = Product::with('category')->limit(12)->get();
        return view('home', compact(['dsSP']));
    }
}