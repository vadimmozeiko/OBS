<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    private MailController $mail;

    public function __construct()
    {
        $this->mail = new MailController();
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function createOrder()
    {
        $products = Product::all()->sortBy('title');
        $users = User::where('status', 'active')->get()->sortBy('name');
        return view('admin.orders.create_order', ['products' => $products, 'users' => $users]);
    }

    public function storeOrder(OrderCreateRequest $request)
    {
        if (OrderService::isBooked($request)) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }

        $order = Order::create($request->validated());
//        $this->mail->notConfirmed($order);
        return redirect()->back()->with('success_message', 'Booking created successfully');
    }

    public function listOrder(Request $request)
    {
        $users = User::where('status', 'active')->get()->sortBy('name');;
        $userId = $request->user_id;
        $orderStatus = $request->order_status;

        // filter by status

        if ($orderStatus) {
            if ($orderStatus == 0) {
                $orders = Order::all();
            } else {
                $orders = Order::where('status', $orderStatus)->get();
            }
        } else {
            $orders = Order::all();
        }

        // filter by ID

        if ($userId) {
            if ($userId == 0) {
                $orders = Order::where('status', $orderStatus)->get();
            } else {
                $orders = Order::where('user_id', $userId)->get();
            }
        }

        // filter by both

        if ($userId && $orderStatus) {
            $orders = Order::where([['user_id', $userId], ['status', $orderStatus]])->get();
        }

        return view('admin.orders.manage_order',
            ['orders' => $orders, 'orderStatus' => $orderStatus ?? 0, 'users' => $users, 'userId' => $userId]);
    }
}
