<?php


namespace App\Repositories;


use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\ProductCreateRequest;
use App\Models\Order;
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

        return Product::whereNotIn('id', $unavailable)
            ->where('status', Product::STATUS_AVAILABLE)
            ->get();
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

    public function changeStatus(Product $product, string $status)
    {
        $product->update([
            'status' => $status
        ]);
    }

    public function changeImage(Product $product, string $url)
    {
        $product->update(['image' => $url]);
    }

    public function getUnavailableDates(Product $product)
    {
        return Order::where('product_id', $product->id)
            ->where('status', '!=' , Order::STATUS_COMPLETED)
            ->where('status', '!=' , Order::STATUS_CANCELLED)
            ->orderBy('date')
            ->get(['date']);
    }
}
