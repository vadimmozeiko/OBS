<?php


namespace App\Repositories;


use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\ProductCreateRequest;
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

    public function getFirstProductById(OrderCreateRequest $request)
    {
        return Product::where('id', $request->product_id)->first();
    }

    public function getAvailableProducts()
    {
        return Product::where('status', Product::STATUS_AVAILABLE)->get();
    }

    public function store(ProductCreateRequest $request)
    {
        return Product::create($request->validated());
    }

    public function update(ProductCreateRequest $request, Product $product)
    {
        $product->update($request->validated());
    }
}
