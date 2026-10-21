<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $data['produk'] = produk::take(3)->get();
        return view('home',$data);
    }
}
