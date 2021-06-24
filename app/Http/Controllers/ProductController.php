<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        if ($request->order_date) {
            $unavailable = [];
            $products = Order::where('date', $request->order_date)
                ->where('status', 'confirmed')
                ->get();
            foreach ($products as $product) {
                $unavailable[] = $product->product_id;
            }
            $products = Product::whereNotIn('id', $unavailable)->get();
        } else {
            $products = Product::all();
        }
        return view('products.index', ['products' => $products, 'request' => $request]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy(Product $product)
    {
        //
    }
}
