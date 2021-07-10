<?php


namespace App\Repositories;


use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class BaseOrderRepository
{
    public function getAllOrders(): Collection|array
    {
        return Order::all();
    }

    public function getOrderByStatus(int $status): Collection|array
    {
        return Order::where('status_id', $status)->get();
    }

    public function getOrderByUser(int $userId): Collection|array
    {
        return Order::where('user_id', $userId)->get();
    }

}
