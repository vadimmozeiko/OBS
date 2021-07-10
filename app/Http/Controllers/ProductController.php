<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request): View|string
    {
        if ($request->order_date <= now()->toDateString()) {
            return redirect()->back()->with('info_message', 'Invalid date (for today\'s bookings contact directly)' );
        }

        $reserved = Order::where('date', $request->order_date)
            // TODO change too many where
            ->where('status_id', '!=', '4')
            ->where('status_id', '!=', '5')
            ->where('status_id', '!=', '6')
            ->get();
        if ($request->order_date) {
            $unavailable = [];
            $products = Order::where('date', $request->order_date)
                ->where('status_id', '4')
                ->get();
            if($request->available_only){
                $products = Order::where('date', $request->order_date)
                    ->where('status_id', '3')
                    ->get();
            }
            foreach ($products as $product) {
                $unavailable[] = $product->product_id;
            }
            $products = Product::whereNotIn('id', $unavailable)->get();
        } else {
            $products = Product::all();
        }
        return view('products.index', ['products' => $products, 'request' => $request, 'reserved' => $reserved]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Product $product): View
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
