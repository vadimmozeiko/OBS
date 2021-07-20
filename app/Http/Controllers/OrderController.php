<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private MailController $mail;
    private OrderRepository $orderRepository;

    public function __construct()
    {
        $this->mail = new MailController();
        $this->orderRepository = new OrderRepository();
        $this->middleware('verified');
    }

    public function index(): View
    {
        return view('orders.index');
    }

    public function create(Product $product, Request $request): View|RedirectResponse
    {

        // TODO MOVE | to repository or manager
        if (Order::all()->isEmpty()) {
            $year = Carbon::now()->year;
            $orderNumber = $year . sprintf("%'.04d\n", 0);
        } else {
            $orderNumber = Order::orderBy('order_number', 'desc')->first()->order_number;
        }
        $user = auth()->user() ?? null;
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
        $product = Product::where('id', $request->product_id)->first();
        $date = str_replace('-', '', "$request->date");

        if ($this->orderRepository->isBooked($request)) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }

        $order = Order::create($request->validated());
        $this->mail->notConfirmed($order);
        return redirect()->route('order.index')->with(['order' => $order, 'product' => $product, 'date' => $date]);
    }

    public function show(Order $order): View
    {
        return view('orders.show', ['order' => $order]);
    }

    public function edit(Order $order, User $user): View|RedirectResponse
    {

        if ($this->orderRepository->isEditable($order)) {
            return redirect()->back()->with('info_message', 'Whoops, looks like something went wrong');
        }
        return view('orders.edit', ['order' => $order, 'user' => $user]);
    }

    public function update(OrderUpdateRequest $request, Order $order): RedirectResponse
    {
        if ($this->orderRepository->isBooked($request) && $order->getOriginal('date') != $request->date) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }
        $order->status_id = '4';
        $order->update($request->validated());

        $user = auth()->user()->id ?? null;
        $this->mail->orderChange($order);

        return redirect()->route('user.orders', $user)->with('success_message', 'Booking details changed successfully');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->status_id = '7';
        $order->save();
        $this->mail->cancelled($order);
        return redirect()->back()->with('success_message', 'Booking cancellation submitted successfully');
    }
}
