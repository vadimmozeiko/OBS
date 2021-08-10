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
            ->where('status', '!=', Order::STATUS_COMPLETED)
            ->where('status', '!=', Order::STATUS_CANCELLED)
            ->first();
    }

    public function isEditable(Order $order): bool
    {
        if ($order->user_id != auth()->user()->id ||
            $order->status == Order::STATUS_COMPLETED ||
            $order->status == Order::STATUS_CANCELLED) {

            return true;
        }
        return false;
    }

    public function getByStatusOrderDate(string $status)
    {
        return Order::where('status', $status)
            ->sortable()
            ->orderBy('date')
            ->paginate(10)
            ->withQueryString();
    }

    public function getOrdersByIdByStatus(int $userId, string $status)
    {
        return Order::where([['user_id', $userId], ['status', $status]])
            ->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();
    }

    public function getReservedOrders(string $date): Collection|array
    {
        return Order::where('date', $date)
            ->where('status', Order::STATUS_NOT_CONFIRMED)
            ->get();
    }

    public function getConfirmedOrders(string $date): Collection|array
    {
        return Order::where('date', $date)
            ->where('status', Order::STATUS_CONFIRMED)
            ->get();
    }

    public function getNotAvailable(string $date)
    {
        return Order::where('date', $date)
            ->where('status', '!=', Order::STATUS_COMPLETED)
            ->where('status', '!=', Order::STATUS_CANCELLED)
            ->get();
    }

    public function search(string $search)
    {
        return Order::where('date', 'like', "%$search%")
            ->orWhere('name', 'like', "%$search%")
            ->orWhere('order_number', 'like', "%$search%")
            ->orderBy('date')
            ->paginate(10)
            ->withQueryString();
    }

    public function getLastOrderNumber(): int
    {
        return Order::orderBy('order_number', 'desc')->first()->order_number;
    }

    public function store(OrderCreateRequest $request)
    {
        return Order::create($request->validated());
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        return $order->update($request->validated());
    }

    public function save(Order $order): void
    {
        $order->save();
    }

    public function changeOrderStatus(Order $order, string $status)
    {
        $order->status = $status;
    }

    public function getStatus(Order $order): string
    {
        return $order->status;
    }

    public function getByProductId(int $productsId)
    {
        return Order::where('product_id', $productsId)->paginate(10)->withQueryString();
    }
}
