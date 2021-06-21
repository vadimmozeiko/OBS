<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        //
    }


    public function create(Product $product, Request $request)
    {
        $product = $product->id;
        $user = User::where('name', Auth::user()->name ?? null)->get();
        if(!Auth::user()){
            return view('auth.login');
        }
       return view('orders.create', ['user' => $user, 'product' => $product]);
    }


    public function store(Request $request)
    {

        $order = new Order;
        $order->user_name = $request->user_name;
        $order->user_email = $request->user_email;
        $order->user_phone = $request->user_phone;
        $order->user_message = $request->user_message;
        $order->user_id = $request->user_id;
        $order->product_id = $request->product_id;
        $order->status = 'not confirmed';
        $order->save();
        return redirect()->route('order.index');
    }


    public function show(Order $order)
    {
        //
    }


    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
