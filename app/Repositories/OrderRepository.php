<?php


namespace App\Repositories;


use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use function React\Promise\all;

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

    public function getNotAvailable(string $date)
    {
        return Order::where('date', $date)
            ->where('status_id', '!=', '6')
            ->where('status_id', '!=', '7')
            ->get();
    }

    public function search(string $search)
    {
        return Order::where('date', 'like', "%$search%")
            ->orWhere('user_name', 'like', "%$search%")
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
        $order->status_id = $status;
    }

    public function getStatus(Order $order)
    {
        return $order->status_id;
    }

    public function getByProductId(int $productsId)
    {
        return Order::where('product_id', $productsId)->paginate(10)->withQueryString();
    }

    public function getOrdersByIdByProduct(int $userId, int $productsId)
    {
        return Order::where([['user_id', $userId], ['product_id', $productsId]])
            ->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();
    }

    public function getOrdersByIdByStatusByProduct(int $userId, int $orderStatus, int $productsId)
    {
        return Order::where([['user_id', $userId], ['status_id', $orderStatus] ,['product_id', $productsId]])
            ->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();
    }

}
