<?php


namespace App\Services;


use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;

class OrderService
{
    public static function isBooked(OrderCreateRequest|OrderUpdateRequest $request): Order|null
    {
        return Order::where('product_id', $request->product_id)
            ->where('date', $request->date)
            ->where('status_id', '!=', '5')
            ->where('status_id', '!=', '6')
            ->first();
    }

    public static function isEditable(Order $order): bool
    {
        if ($order->user_id != auth()->user()->id ||
            $order->status_id == '5' ||
            $order->status_id == '6') {

            return true;
        }
        return false;

    }
}
