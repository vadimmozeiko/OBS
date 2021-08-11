<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Managers\OrderManager;
use App\Managers\UserManager;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct(
        private OrderManager $orderManager,
        private UserManager $userManager,
        private NotificationController $notificationController)
    {
    }

    public function index(): View
    {
        return view('orders.index');
    }

    public function create(Product $product, Request $request): View|RedirectResponse
    {
        $orderNumber = $this->orderManager->getOrderNumber();
        $user = $this->userManager->getAuthUser();
        if (!$request->order_date) {
            return redirect()->back()
                ->with('info_message', 'Select the date and check availability')
                ->with('style', 'background-color:#ffd1d1;');
        }
        return view('orders.create', ['user' => $user, 'product' => $product, 'request' => $request,
            'orderNumber' => $orderNumber + 1]);
    }

    public function store(OrderCreateRequest $request): RedirectResponse
    {

//        dd($request);
        $product = $this->orderManager->getFirstProductById($request);
        $date = str_replace('-', '', "$request->date");

        if ($this->orderManager->isBooked($request)) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }
        $order = $this->orderManager->store($request);
        $this->orderManager->sendNotConfirmed($order);
        return redirect()->route('order.index')->with(['order' => $order, 'product' => $product, 'date' => $date]);
    }

    public function show(Order $order): View
    {
        return view('orders.show', ['order' => $order]);
    }

    public function edit(Order $order, User $user): View|RedirectResponse
    {

        if ($this->orderManager->isEditable($order)) {
            return redirect()->back()->with('info_message', 'Whoops, looks like something went wrong');
        }
        return view('orders.edit', ['order' => $order, 'user' => $user]);
    }

    public function update(OrderUpdateRequest $request, Order $order): RedirectResponse
    {
        if ($this->orderManager->isBooked($request) && $order->getOriginal('date') != $request->date) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }

        $this->orderManager->changeOrderStatus($order, Order::STATUS_NOT_CONFIRMED);
        $this->orderManager->update($request, $order);
        $user = $this->userManager->getAuthUser();
        $this->orderManager->sendOrderChange($order);
        $this->notificationController->store('updated',$order);
        return redirect()->route('user.orders', $user)->with('success_message', 'Booking details changed successfully');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $this->orderManager->changeOrderStatus($order, Order::STATUS_CANCELLED);
        $this->orderManager->save($order);
        $this->orderManager->sendCancelled($order);
        $this->notificationController->store('cancelled',$order);
        return redirect()->back()->with('success_message', 'Booking cancellation submitted successfully');
    }
}
