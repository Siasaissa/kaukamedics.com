<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function about()
    {
        return view('about');
    }

    public function service()
    {
        return view('service');
    }

    public function contact()
    {
        return view('contact');
    }

    public function products()
    {
        return view('products');
    }
    public function cart(){
        return view('cart');
    }
    public function login(){
        return view('login');
    }
}
