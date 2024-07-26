<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function detail($id){
        $sp = Product::where('id', $id)->first();
        return view('detail', compact(['sp']));
    }
    function chitiet(){
        return view('detail');
    }
    
}
