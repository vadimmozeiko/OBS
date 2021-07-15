<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View|RedirectResponse
    {

        if(auth()->check() && auth()->user()->status_id == 1) {
           return $this->firstLogin();
        }
        return view('index');
    }

    public function faq(): Renderable
    {
        return view('faq');
    }

    public function admin(): Renderable
    {
        return view('admin_login');
    }

    private function firstLogin()
    {
        return view('reset', auth()->user());
    }
}
