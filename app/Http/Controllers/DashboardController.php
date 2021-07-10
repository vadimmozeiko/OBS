<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
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
        $users = User::where('status_id', '2')->get()->sortBy('name');
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
        $users = User::where('status_id', '2')->get()->sortBy('name');;
        $userId = $request->user_id;
        $orderStatus = $request->order_status;

        // filter by status

        if ($orderStatus) {
            if ($orderStatus == 0) {
                $orders = Order::all();
            } else {
                $orders = Order::where('status_id', $orderStatus)->get();
            }
        } else {
            $orders = Order::all();
        }

        // filter by ID

        if ($userId) {
            if ($userId == 0) {
                $orders = Order::where('status_id', $orderStatus)->get();
            } else {
                $orders = Order::where('user_id', $userId)->get();
            }
        }

        // filter by both

        if ($userId && $orderStatus) {
            $orders = Order::where([['user_id', $userId], ['status_id', $orderStatus]])->get();
        }

        return view('admin.orders.manage_order',
            ['orders' => $orders, 'orderStatus' => $orderStatus ?? 0, 'users' => $users, 'userId' => $userId]);
    }


    public function editOrder(Order $order)
    {
        return view('admin.orders.edit_order', ['order' => $order]);
    }

    public function updateOrder(OrderUpdateRequest $request, Order $order): RedirectResponse
    {
        if (OrderService::isBooked($request) && $order->getOriginal('date') != $request->date) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }

        $order->update($request->validated());

        $user = auth()->user()->id ?? null;
//        $this->mail->orderChange($order);

        return redirect()->route('list.order')->with('success_message', 'Booking details changed successfully');
    }

    public function statusChange(Order $order, Request $request)
    {
        $status = $request->status_id;

        if ($order->status_id == $status) {
            return redirect()->route('list.order')->with('info_message', 'Cannot change to same status');
        }
        $order->status_id = $status;
        $order->save();
//        $result = match ($status) {
//            $status >= 'confirmed' => 'send confirm email',
//            $status >= 'complete' => 'send completed email',
//        };
        return redirect()->route('list.order')->with('success_message', 'Booking status updated successfully');

    }
}
