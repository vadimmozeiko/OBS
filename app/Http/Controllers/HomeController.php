<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private OrderRepository $orderRepository;
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->productRepository = new ProductRepository();
    }


    public function index(): View
    {
        if (auth()->check() && auth()->user()->status_id == 1) {
            return $this->resetPassword();
        }
        return view('index');
    }

    public function products(Request $request): RedirectResponse|View
    {
        $orderDate = $request->order_date;
        $products = $this->productRepository->getAll(Product::class);
        $reserved = collect();
        $today = Carbon::now();

        if ($orderDate) {
            if (Carbon::parse($orderDate) < $today) {
                return redirect()->back()->with('info_message', 'Invalid date (for today bookings contact directly)');
            }

            $reserved = $this->orderRepository->getNotAvailable($orderDate);
//            $reserved = $this->orderRepository->getReservedOrders($orderDate);
//            $products = $this->orderRepository->getConfirmedOrders($orderDate);

            if ($request->available_only) {
                $products = $this->orderRepository->getNotAvailable($orderDate);
                $products = $this->productRepository->getBookableOnly($products);
            }
//            $products = $this->productRepository->getBookableOnly($products);
        }
        return view('products', ['products' => $products, 'reserved' => $reserved]);
    }


    public function faq(): View
    {
        return view('faq');
    }

    public function admin(): View
    {
        return view('admin_login');
    }

    private function resetPassword(): View
    {
        return view('reset', auth()->user());
    }
}
