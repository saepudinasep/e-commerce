<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return 'Product.index';
    }

    public function show()
    {
        return 'Product.show';
    }
}
