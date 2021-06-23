<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{

    public function index()
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


    public function show(User $user)
    {

    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }


    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(),
            [
                'user_name' => ['required', 'string', 'max:255'],
                'user_address' => ['required', 'string', 'max:255'],
                'user_phone' => ['required', 'numeric', 'min:11'],
                'user_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email']
            ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->address = $request->user_address;
        $user->phone = $request->user_phone;
        $user->save();
        return redirect()->route('user.index');
    }


    public function destroy(User $user)
    {
        //
    }
}
