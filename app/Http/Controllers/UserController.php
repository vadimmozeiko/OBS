<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(): View
    {
        $user = auth()->user();
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


    public function orders(User $user, Request $request): View
    {
        $products = Product::all();
        $orderStatus = 0;
        $userOrders = Order::where('user_id', auth()->user()->id)->get();
        if ($request->order_status) {
            $orderStatus = $request->order_status;
            $userOrders = $user->userOrders();
        }

        return view('user.orders', ['user' => $user, 'userOrders' => $userOrders, 'products' => $products, 'orderStatus' => $orderStatus]);
    }

    public function edit(User $user): View
    {
        return view('user.edit', ['user' => $user]);
    }


    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        return redirect()->route('user.index')->with('success_message', 'Changes saved successfully');
    }

    public function destroy(User $user, Request $request)
    {
        $currentPass = auth()->user()->getAuthPassword();
        $inputCurrentPass = $request->current_password;

        if (Hash::check($inputCurrentPass, $currentPass)) {
            $user->status = 'inactive';
            $user->email = 'deleted: id#' . auth()->user()->id . $user->email;
            $user->save();
            Auth::logout();
            return redirect()->route('index')->with('success_message', 'Account was deleted successfully');
        } else {
            return redirect()->back()->withErrors('Password doesnt match our records');
        }
    }

    public function deleteConfirm(User $user)
    {
        return view('user.delete', ['user' => $user]);
    }


    public function passEdit(User $user)
    {
        return view('user.password', ['user' => $user]);
    }

    public function passUpdate(PasswordUpdateRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->new_password)]);
        return redirect()->route('user.index')->with('success_message', 'Password changed successfully');
    }
}
