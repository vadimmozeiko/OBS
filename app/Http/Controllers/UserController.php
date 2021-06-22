<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {

        return view('user.index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(User $customer)
    {

    }

    public function edit(User $customer)
    {
        //
    }


    public function update(Request $request, User $customer)
    {
        //
    }


    public function destroy(User $customer)
    {
        //
    }
}
