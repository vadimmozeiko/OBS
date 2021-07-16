<?php


namespace App\Repositories;


use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use Illuminate\Support\Collection;

class OrderRepository extends BaseRepository
{

    public function getAllOrderDate()
    {
        return Order::orderBy('date')->paginate(10)->withQueryString();
    }

    public function isBooked(OrderCreateRequest|OrderUpdateRequest $request): Order|null
    {
        return Order::where('product_id', $request->product_id)
            ->where('date', $request->date)
            ->where('status_id', '!=', '6')
            ->where('status_id', '!=', '7')
            ->first();
    }

    public function isEditable(Order $order): bool
    {
        if ($order->user_id != auth()->user()->id ||
            $order->status_id == '6' ||
            $order->status_id == '7') {

            return true;
        }
        return false;
    }

    public function getByStatusOrderDate(int $status)
    {
        return Order::where('status_id', $status)
            ->orderBy('date')
            ->paginate(10)
            ->withQueryString();
    }

    public function getOrdersByIdByStatus(int $userId, int $status)
    {
        return Order::where([['user_id', $userId], ['status_id', $status]])
            ->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();
    }

    public function getReservedOrders(string $date): Collection|array
    {
        return Order::where('date', $date)
            ->where('status_id', '4')
            ->get();
    }

    public function getConfirmedOrders(string $date): Collection|array
    {
        return Order::where('date', $date)
            ->where('status_id', '5')
            ->get();
    }

    public function getAvailableOnly(string $date)
    {
        return Order::where('date', $date)
            ->where('status_id', '!=', '6')
            ->where('status_id', '!=', '7')
            ->get();
    }

    public function getOrdersByDate(string $search)
    {
        return Order::where('date', 'like', "%$search%")
            ->orderBy('date')
            ->paginate(10)
            ->withQueryString();
    }

}
