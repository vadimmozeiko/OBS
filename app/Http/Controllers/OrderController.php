<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
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

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validator = Validator::make($request->all(),
            [
                'user_name' => 'required | string | max:255',
                'user_email' => 'required | string | email | max:255',
                'user_phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/ | min:9',
                'order_date' => 'required | date | after: yesterday'
            ],
            [
                'user_name.required' => 'Please fill the name field',
                'user_name.max' => 'Name is too long',
                'user_phone.required' => 'Please fill the phone no. field',
                'user_phone.regex' => 'Invalid phone no.',
                'order_date.after' => 'Incorrect date (for today bookings contact directly)'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $isBooked = Order::where('product_id', $order->product_id)
            ->where('date', $request->order_date)
            ->where('status', '!=', 'completed')
            ->where('status', '!=', 'cancelled')
            ->first();
        if (!empty($isBooked) && $order->getOriginal('date') != $request->order_date) {
            return redirect()->back()->with('info_message', 'Not available for selected date');
        }

        $order->user_name = $request->user_name;
        $order->user_email = $request->user_email;
        $order->user_phone = $request->user_phone;
        $order->date = $request->order_date;
        $order->price = $order->orderProducts->price;
        $order->status = 'not confirmed';
        $order->save();

        $user = User::where('name', auth()->user()->name ?? null)->first();

//        $this->mail->orderChange($order);

        return redirect()->route('user.orders', $user->id)->with('success_message', 'Booking details changed successfully');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->status = 'cancelled';
        $order->save();
        return redirect()->back()->with('success_message', 'Booking cancellation submitted successfully');
    }
}
