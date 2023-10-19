<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // acessando querry string com 'request()' 
        $busca = request('search');

        return view('products', ['busca' => $busca]);
    }

    public function product($id)
    {
        return view('product', ['id' => $id]);
    }
}
