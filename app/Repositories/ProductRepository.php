<?php


namespace App\Repositories;


use App\Models\Product;
use Illuminate\Support\Collection;

class ProductRepository extends BaseRepository
{
    public function getBookableOnly(Collection $productIds)
    {
        $unavailable = [];
        foreach ($productIds as $product) {
            $unavailable[] = $product->product_id;
        }
        return Product::whereNotIn('id', $unavailable)->get();
    }
}
