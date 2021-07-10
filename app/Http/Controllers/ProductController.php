<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private OrderRepository $orderRepository;
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->productRepository = new ProductRepository();
    }

    public function index(Request $request): View|string
    {
        $orderDate = $request->order_date;
        $products = $this->orderRepository->getAll(Product::class);
        $reserved = $this->orderRepository->getReservedOrders($orderDate);

        if ($orderDate <= now()->toDateString()) {
            return redirect()->back()->with('info_message', 'Invalid date (for today\'s bookings contact directly)');
        }

        if ($orderDate) {
            $products = $this->orderRepository->getConfirmedOrders($orderDate);
            if ($request->available_only) {
                $products = $this->orderRepository->getReservedOrders($orderDate);
            }
            $products = $this->productRepository->getBookableOnly($products);
        }
        return view('products.index', ['products' => $products, 'request' => $request, 'reserved' => $reserved]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Product $product): View
    {
        return view('products.show', ['product' => $product]);
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy(Product $product)
    {
        //
    }
}
