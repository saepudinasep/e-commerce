<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::orderBy('rating', 'desc')->get();
        return view('product', compact('products'));
    }

    public function show($id)
    {
        $product = Products::findOrFail($id);

        // Get 5 related products (excluding the current product)
        $relatedProducts = Products::where('id', '!=', $product->id)
            ->limit(5)
            ->get();

        return view('product_show', compact('product', 'relatedProducts'));
    }
}
