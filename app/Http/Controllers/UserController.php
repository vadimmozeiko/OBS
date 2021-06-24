<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class UserController extends Controller
{

    public function index(): Factory|View|Application
    {
        $user = User::where('name', Auth::user()->name)->get();
        return view('user.index', ['user' => $user]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(User $user): Factory|View|Application
    {
        $userOrders = Order::where('user_id', Auth::user()->id)->get();
        $products = Product::all();

        return view('user.orders', ['user' => $user, 'userOrders' => $userOrders, 'products' => $products]);
    }

    public function edit(User $user): Factory|View|Application
    {
        return view('user.edit', ['user' => $user]);
    }


    public function update(Request $request, User $user): RedirectResponse
    {
        $validator = Validator::make($request->all(),
            [
                'user_name' => 'required | string | max:255',
                'user_address' => 'required | string | max:255',
                'user_phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/ | min:9',
                'user_email' => 'required | string | email | max:255'
            ],
            [
                'user_name.required' => 'Please fill the name field',
                'user_name.max' => 'Name is too long',
                'user_address.required' => 'Please fill the address field',
                'user_address.max' => 'Address is too long',
                'user_phone.required' => 'Please fill the phone no. field',
                'user_phone.regex' => 'Invalid phone no.',
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->address = $request->user_address;
        $user->phone = $request->user_phone;
        $user->save();
        return redirect()->route('user.index')->with('success_message', 'Changes saved successfully');
    }


    public function destroy(User $user)
    {
        //
    }
}
