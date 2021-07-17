<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Statuses;
use App\Models\User;
use App\Repositories\OrderRepository;
use App\Repositories\StatusRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    private MailController $mail;
    private OrderRepository $orderRepository;
    private UserRepository $userRepository;
    private StatusRepository $statusRepository;

    public function __construct()
    {
        $this->mail = new MailController();
        $this->orderRepository = new OrderRepository();
        $this->userRepository = new UserRepository();
        $this->statusRepository = new StatusRepository();
    }

    public function index()
    {
       $notConfirmed = $this->orderRepository->getByStatusOrderDate(4);
        return view('admin.index', ['notConfirmed' => $notConfirmed]);
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

        $this->mail->notConfirmed($order);
        return redirect()->back()->with('success_message', 'Booking created successfully');
    }

    public function listOrder(Request $request)
    {
        $users = $this->orderRepository->getByStatus(User::class, 2);
        $userId = $request->user_id;
        $orderStatus = $request->order_status;
        $search = $request->search;
        $orders = $this->orderRepository->getAllOrderDate();
        $statuses = $this->statusRepository->getOrderStatuses();

        if ($orderStatus) {
            $orders = $this->orderRepository->getByStatus(Order::class, $orderStatus);
        }

        if ($userId) {
            $orders = $this->orderRepository->getByUser(Order::class, $userId);
        }

        if ($userId && $orderStatus) {
            $orders = $this->orderRepository->getOrdersByIdByStatus($userId, $orderStatus);
        }

        if($search) {
            $orders = $this->orderRepository->search($search);
        }

        return view('admin.orders.manage_order',
            ['orders' => $orders, 'orderStatus' => $orderStatus ?? 0, 'users' => $users, 'userId' => $userId,
            'statuses' => $statuses, 'search' => $search]);
    }


    public function listUser(Request $request)
    {
        $statuses = $this->statusRepository->getUserStatuses();
        $userStatus = $request->user_status;
        $search = $request->search;
        $users = $this->userRepository->getAllOrderName();

        if ($userStatus) {
            $users = $this->userRepository->getByStatusOrderName($userStatus);
        }

        if($search) {
            $users = $this->userRepository->search($search);
        }
        return view('admin.users.manage_user',
            ['users' => $users, 'statuses' => $statuses, 'userStatus' => $userStatus, 'search' => $search]);
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

        $this->mail->orderChange($order);

        return redirect()->back()->with('success_message', 'Booking details changed successfully');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit_user', ['user' => $user]);
    }


    public function updateUser(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('list.user')->with('success_message', 'Changes saved successfully');
    }

    public function statusChange(Order $order, Request $request)
    {
        $status = $request->status_id;

        if ($order->status_id == $status) {
            return redirect()->back()->with('info_message', 'Cannot change to same status');
        }
        $order->status_id = $status;
        $order->save();

        // TODO configure status change mail send here
        $this->mail->statusChange($order);

        return redirect()->back()->with('success_message', 'Booking status updated successfully');

    }
}
