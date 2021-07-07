<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{

    private Order $order;
    private MailController $mail;

    public function __construct()
    {
        $this->mail = new MailController();
        $this->order = new Order();
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function createOrder()
    {
        $products = Product::all()->sortBy('title');
        $users = User::where('status', 'active')->get()->sortBy('name');
        return view('admin.create_order', ['products' => $products, 'users' => $users]);
    }

    public function storeOrder(OrderCreateRequest $request)
    {
        if ($this->order->isBooked($request)) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }

        $order = $this->order->create($request->validated());
//        $this->mail->notConfirmed($order);
        return redirect()->back()->with('success_message', 'Booking created successfully');
    }
}
