<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Statuses;
use App\Models\User;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    private MailController $mail;
    private OrderRepository $orderRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->mail = new MailController();
        $this->orderRepository = new OrderRepository();
        $this->userRepository = new UserRepository();
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function createOrder()
    {
        $products = $this->orderRepository->getAll(Product::class)->sortBy('title');
        $users = $this->orderRepository->getByStatus(User::class, 2)->sortBy('name');
        return view('admin.orders.create_order', ['products' => $products, 'users' => $users]);
    }

    public function storeOrder(OrderCreateRequest $request)
    {
        if ($this->orderRepository->isBooked($request)) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }

        $order = Order::create($request->validated());

        // TODO configure confirmation mail send here
//        $this->mail->notConfirmed($order);
        return redirect()->back()->with('success_message', 'Booking created successfully');
    }

    public function listOrder(Request $request)
    {
        $users = $this->orderRepository->getByStatus(User::class, 2)->sortBy('name');;
        $userId = $request->user_id;
        $orderStatus = $request->order_status;
        $orders = $this->orderRepository->getAll(Order::class);


        if ($orderStatus) {
            $orders = $this->orderRepository->getByStatus(Order::class, $orderStatus);
        }

        if ($userId) {
            $orders = $this->orderRepository->getByUser(Order::class, $userId);
        }

        if ($userId && $orderStatus) {
            $orders = $this->orderRepository->getOrdersByIdByStatus($userId, $orderStatus);
        }

        return view('admin.orders.manage_order',
            ['orders' => $orders, 'orderStatus' => $orderStatus ?? 0, 'users' => $users, 'userId' => $userId]);
    }


    public function listUser(Request $request)
    {
        $statuses = Statuses::all();
        $userStatus = $request->user_status;
        $users = $this->userRepository->getAll(User::class);

        if ($userStatus) {
            $users = $this->userRepository->getByStatus(User::class, $userStatus);
        }
        return view('admin.users.manage_user',
            ['users' => $users, 'statuses' => $statuses, 'userStatus' => $userStatus]);
    }


    public function editOrder(Order $order)
    {
        return view('admin.orders.edit_order', ['order' => $order]);
    }

    public function updateOrder(OrderUpdateRequest $request, Order $order): RedirectResponse
    {
        if ($this->orderRepository->isBooked($request) && $order->getOriginal('date') != $request->date) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }

        $order->update($request->validated());

//        $user = auth()->user()->id ?? null;

        // TODO configure update mail send here
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

        // TODO configure status change mail send here
//        $result = match ($status) {
//            $status >= 'confirmed' => 'send confirm email',
//            $status >= 'complete' => 'send completed email',
//        };
        return redirect()->route('list.order')->with('success_message', 'Booking status updated successfully');

    }
}
