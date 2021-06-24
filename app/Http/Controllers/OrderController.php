<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class OrderController extends Controller
{

    public function index()
    {
        return view('orders.index');
    }


    public function create(Product $product, Request $request)
    {
        $product = $product->id;
        $user = User::where('name', Auth::user()->name ?? null)->get();
        if (!Auth::user()) {
            return view('auth.login');
        }
        return view('orders.create', ['user' => $user, 'product' => $product, 'request' => $request]);
    }


    public function store(Request $request)
    {
        $product = Product::where('id', $request->product_id)->get();

        $validator = Validator::make($request->all(),
            [
                'user_name' => 'required | string | max:255',
                'user_email' => 'required | string | email | max:255',
                'user_address' => 'required | string | max:255',
                'user_phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/ | min:9',
                'order_date' => 'required | date | after: today'

            ],
            [
                'user_name.required' => 'Please fill the name field',
                'user_name.max' => 'Name is too long',
                'user_address.required' => 'Please fill the address field',
                'user_address.max' => 'Address is too long',
                'user_phone.required' => 'Please fill the phone no. field',
                'user_phone.regex' => 'Invalid phone no.',
                'order_date.after' => 'Incorrect date (for today bookings contact directly)'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $isBooked = Order::where('product_id', $request->product_id)->where('date', $request->order_date)->first();
        if(!empty($isBooked)){
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }


        $order = new Order;
        $order->user_name = $request->user_name;
        $order->user_email = $request->user_email;
        $order->user_phone = $request->user_phone;
        $order->user_message = $request->user_message;
        $order->date = $request->order_date;
        $order->user_id = $request->user_id;
        $order->product_id = $request->product_id;
        $order->status = 'not confirmed';
        $order->save();
        return redirect()->route('order.index')->with(['order' => $order, 'product' => $product]);
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
