<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Managers\ContactManager;
use App\Managers\OrderManager;
use App\Managers\ProductManager;
use App\Managers\UserManager;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function __construct(
        private OrderManager   $orderManager,
        private UserManager    $userManager,
        private ProductManager $productManager,
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
        $this->orderManager->sendNotConfirmed($order);
        return redirect()->back()->with('success_message', 'Booking created successfully');
    }

    public function listOrder(Request $request)
    {
        $users = $this->userManager->getAllUsers(User::class)->sortBy('name');
        $userId = $request->get('user_id');
        $orderStatus = $request->get('order_status');
        $orders = Order::filter($request)->sortable()->orderBy('name')->paginate(10)->withQueryString();
        $search = $request->get('search');
        $products = $this->orderManager->getAll(Product::class);
        $productsId = $request->get('product');

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

        $this->orderManager->sendOrderChange($order);

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

        if ($status == Order::STATUS_CANCELLED) {
            $this->orderManager->sendCancelled($order);
        }

        if ($status == Order::STATUS_CONFIRMED) {
            $this->orderManager->sendConfirmed($order);
        }

        if ($status == Order::STATUS_COMPLETED) {
            $pdf = $this->orderManager->generateInvoice($order);
            $this->orderManager->sendCompleted($order, $pdf);
            $this->orderManager->storeToFile($order, $pdf);
        }

        $this->orderManager->changeOrderStatus($order, $status);
        $this->orderManager->save($order);


        return redirect()->back()->with('success_message', 'Booking status updated successfully');

    }

    public function loginAs($user): RedirectResponse
    {
        auth()->logout();
        auth()->loginUsingId($user, true);
        return redirect()->route('index');
    }

}
