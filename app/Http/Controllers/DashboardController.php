<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Managers\OrderManager;
use App\Managers\UserManager;
use App\Models\Order;
use App\Models\Product;
use App\Models\Statuses;
use App\Models\User;
use App\Repositories\OrderRepository;
use App\Repositories\StatusRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    private StatusRepository $statusRepository;

    public function __construct(
        private OrderManager $orderManager,
        private UserManager $userManager
    )
    {
        $this->statusRepository = new StatusRepository();
    }

    public function index()
    {
       $notConfirmed = $this->orderManager->getByStatusOrderDate(4);
        return view('admin.index', ['notConfirmed' => $notConfirmed]);
    }

    public function createOrder()
    {
        $orderNumber = $this->orderManager->getOrderNumber();
        $products = $this->orderManager->getAll(Product::class)->sortBy('title');
        $users = $this->userManager->getUserByStatus(User::class, 2)->sortBy('name');
        return view('admin.orders.create', ['products' => $products, 'users' => $users,
            'orderNumber' => $orderNumber + 1]);
    }

    public function storeOrder(OrderCreateRequest $request)
    {
        if ($this->orderManager->isBooked($request)) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }
        $order = $this->orderManager->store($request);
        $this->orderManager->SendNotConfirmed($order);
        return redirect()->back()->with('success_message', 'Booking created successfully');
    }

    public function listOrder(Request $request)
    {
        $users = $this->userManager->getUserByStatus(User::class, 2);
        $userId = $request->get('user_id');
        $orderStatus = $request->get('order_status');
        $search = $request->get('search');
        $orders = $this->orderManager->getAllOrderDate();

        // TODO REFACTOR | status repository to be deleted
        $statuses = $this->statusRepository->getOrderStatuses();

        if ($orderStatus) {
            $orders = $this->orderManager->getByStatus(Order::class, $orderStatus);
        }

        if ($userId) {
            $orders = $this->orderManager->getByUser(Order::class, $userId);
        }

        if ($userId && $orderStatus) {
            $orders = $this->orderManager->getOrdersByIdByStatus($userId, $orderStatus);
        }

        if($search) {
            $orders = $this->orderManager->search($search);
        }

        return view('admin.orders.index',
            ['orders' => $orders, 'orderStatus' => $orderStatus ?? 0, 'users' => $users, 'userId' => $userId,
            'statuses' => $statuses, 'search' => $search]);
    }


    public function listUser(Request $request)
    {
        // TODO REMAKE | status repository to be deleted
        $statuses = $this->statusRepository->getUserStatuses();
        $userStatus = $request->user_status;
        $search = $request->search;
        $users = $this->userManager->getAllOrderName();

        if ($userStatus) {
            $users = $this->orderManager->getByStatusOrderName($userStatus);
        }

        if($search) {
            $users = $this->userManager->search($search);
        }
        return view('admin.users.index',
            ['users' => $users, 'statuses' => $statuses, 'userStatus' => $userStatus, 'search' => $search]);
    }


    public function editOrder(Order $order)
    {
        return view('admin.orders.edit', ['order' => $order]);
    }

    public function updateOrder(OrderUpdateRequest $request, Order $order): RedirectResponse
    {
        if ($this->orderManager->isBooked($request) && $order->getOriginal('date') != $request->date) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }

        $this->orderManager->update($request, $order);

        // TODO configure mail send here
//        $this->mail->orderChange($order);

        return redirect()->back()->with('success_message', 'Booking details changed successfully');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }


    public function updateUser(UserUpdateRequest $request, User $user)
    {
        $this->userManager->update($request, $user);

        return redirect()->route('list.user')->with('success_message', 'Changes saved successfully');
    }

    public function statusChange(Order $order, Request $request)
    {
        $status = $request->get('status_id');

        $orderStatus = $this->orderManager->getStatus($order);

        if ($orderStatus == $status) {
            return redirect()->back()->with('info_message', 'Cannot change to same status');
        }

        $this->orderManager->changeOrderStatus($order, $status);
        $this->orderManager->save($order);

        // TODO configure status change mail send here
//        $this->mail->statusChange($order);

        return redirect()->back()->with('success_message', 'Booking status updated successfully');

    }

    public function loginAs($user): RedirectResponse
    {
        auth()->logout();
        Auth::loginUsingId($user, true);
        return redirect()->route('index');
    }

}
