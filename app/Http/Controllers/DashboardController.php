<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Managers\OrderManager;
use App\Managers\ProductManager;
use App\Managers\UserManager;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        private OrderManager $orderManager,
        private UserManager $userManager,
        private ProductManager $productManager
    )
    {
    }

    public function index()
    {
        $notConfirmed = $this->orderManager->getByStatusOrderDate(Order::STATUS_NOT_CONFIRMED);
        return view('admin.index', ['notConfirmed' => $notConfirmed]);
    }

    public function createOrder()
    {
        $orderNumber = $this->orderManager->getOrderNumber();
        $products = $this->productManager->getAvailableProducts()->sortBy('title');
        $users = $this->userManager->getAllUsers(User::class)->sortBy('name');
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
        $users = $this->userManager->getAllUsers(User::class)->sortBy('name');
        $userId = $request->get('user_id');
        $orderStatus = $request->get('order_status');
        $search = $request->get('search');
        $orders = $this->orderManager->getAllOrderDate();
        $products = $this->orderManager->getAll(Product::class);
        $productsId = $request->get('product');

        if ($orderStatus) {
            $orders = $this->orderManager->getByStatus(Order::class, $orderStatus);
        }

        if ($userId) {
            $orders = $this->orderManager->getByUser(Order::class, $userId);
        }

        if ($productsId) {
            $orders = $this->orderManager->getByProductId($productsId);
        }

        if ($userId && $orderStatus) {
            $orders = $this->orderManager->getOrdersByIdByStatus($userId, $orderStatus);
        }

        if ($userId && $productsId) {
            $orders = $this->orderManager->getOrdersByIdByProduct($userId, $productsId);
        }

        if ($userId && $orderStatus && $productsId) {
            $orders = $this->orderManager->getOrdersByIdByStatusByProduct($userId, $orderStatus, $productsId);
        }

        if ($search) {
            $orders = $this->orderManager->search($search);
        }

        return view('admin.orders.index',
            ['orders' => $orders, 'orderStatus' => $orderStatus ?? 0, 'users' => $users, 'userId' => $userId,
              'search' => $search, 'products' => $products, 'productId' => $productsId]);
    }


    public function listUser(Request $request)
    {
        $userStatus = $request->status;
        $search = $request->search;
        $users = $this->userManager->getAllOrderName();

        if ($userStatus) {
            $users = $this->userManager->getByStatusOrderName($userStatus);
        }

        if ($search) {
            $users = $this->userManager->search($search);
        }
        return view('admin.users.index',
            ['users' => $users, 'userStatus' => $userStatus, 'search' => $search]);
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
        $status = $request->get('status');

        $orderStatus = $this->orderManager->getStatus($order);

        if ($orderStatus == $status) {
            return redirect()->back()->with('info_message', 'Cannot change to same status');
        }

        $this->orderManager->changeOrderStatus($order, $status);
        $this->orderManager->save($order);

        if($status == Order::STATUS_COMPLETED) {
            $this->orderManager->SendCompleted($order);
        }
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
