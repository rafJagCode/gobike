<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function addProduct(Request $request)
    {
        Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'availability'=>$request->availability,
            'description'=>$request->description,
            'img'=>$request->img
        ]);
    }
    public function getProducts()
    {
        $products = Product::all();
        return $products;
    }
    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        return $product;
    }
}
