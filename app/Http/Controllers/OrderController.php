<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    private MailController $mail;
    private Order $order;

    public function __construct()
    {
        $this->mail = new MailController();
        $this->order = new Order();
        $this->middleware('verified');
    }

    public function index(): View
    {
        return view('orders.index');
    }


    public function create(Product $product, Request $request): View|RedirectResponse
    {
        $user = User::where('id', auth()->user()->id ?? null)->first();
        if (!$request->order_date) {
            return redirect()->back()
                ->with('info_message', 'Select the date and check availability')
                ->with('style', 'background-color:#ffd1d1;');
        }
        return view('orders.create', ['user' => $user, 'product' => $product, 'request' => $request]);
    }


    public function store(OrderCreateRequest $request): RedirectResponse
    {
        $product = Product::where('id', $request->product_id)->first();
        $date = str_replace('-', '', "$request->date");

        if ($this->order->isBooked($request)) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }

        $order = $this->order->create($request->validated());
        $this->mail->notConfirmed($order);
        return redirect()->route('order.index')->with(['order' => $order, 'product' => $product, 'date' => $date]);
    }


    public function show(Order $order): View
    {
        return view('orders.show', ['order' => $order]);
    }


    public function edit(Order $order, User $user): View|RedirectResponse
    {

        if ($this->order->isEditable($order)) {
            return redirect()->back()->with('info_message', 'Invalid details');
        }
        return view('orders.edit', ['order' => $order, 'user' => $user]);
    }

    public function update(OrderUpdateRequest $request, Order $order): RedirectResponse
    {

        $isBooked = Order::where('product_id', $order->product_id)
            ->where('date', $request->order_date)
            ->where('status', '!=', 'completed')
            ->where('status', '!=', 'cancelled')
            ->first();
        if (!empty($isBooked) && $order->getOriginal('date') != $request->order_date) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }
        $order->update($request->validated());

        $user = User::where('id', auth()->user()->id ?? null)->first();

        $this->mail->orderChange($order);

        return redirect()->route('user.orders', $user->id)->with('success_message', 'Booking details changed successfully');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->status = 'cancelled';
        $order->save();
        return redirect()->back()->with('success_message', 'Booking cancellation submitted successfully');
    }
}
