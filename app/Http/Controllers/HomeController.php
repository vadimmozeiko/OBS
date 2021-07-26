<?php

namespace App\Http\Controllers;

use App\Managers\OrderManager;
use App\Managers\UserManager;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(
        private OrderManager $orderManager,
        private UserManager $userManager
    )
    {
    }

    public function index(): View
    {
        $user = $this->userManager->getAuthUser();
        if (auth()->check() && $user->status == User::STATUS_NOT_VERIFIED) {
            return $this->resetPassword();
        }
        return view('index');
    }

    public function products(Request $request): RedirectResponse|View
    {
        $orderDate = $request->order_date;
        $products = $this->orderManager->getAll(Product::class);
        $reserved = collect();
        $today = Carbon::now();

        if ($orderDate) {
            if (Carbon::parse($orderDate) < $today) {
                return redirect()->back()->with('info_message', 'Invalid date (for today bookings contact directly)');
            }

            $reserved = $this->orderManager->getNotAvailable($orderDate);

            if ($request->available_only) {
                $products = $this->orderManager->getNotAvailable($orderDate);
                $products = $this->orderManager->getBookableOnly($products);
            }
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
