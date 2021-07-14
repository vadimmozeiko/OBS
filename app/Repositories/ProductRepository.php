<?php


namespace App\Repositories;


use App\Models\Product;
use Illuminate\Support\Collection;

class ProductRepository extends BaseRepository
{
    public function getBookableOnly(Collection $orders)
    {
        $unavailable = [];
        foreach ($orders as $order) {
            $unavailable[] = $order->product_id;
        }

        return Product::whereNotIn('id', $unavailable)->get();
    }
}
