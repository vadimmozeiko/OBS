<?php


namespace App\Managers;


use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Jobs\SendEmailJob;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Services\MailService;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class OrderManager
{

    /**
     * OrderManager constructor.
     */
    public function __construct(
        private OrderRepository   $orderRepository,
        private ProductRepository $productRepository,
        private UserRepository    $userRepository)
    {
    }

    public function isBooked(OrderCreateRequest|OrderUpdateRequest $request)
    {
        return $this->orderRepository->isBooked($request);
    }

    public function isEditable(Order $order)
    {
        return $this->orderRepository->isEditable($order);
    }

    public function getByStatusOrderDate(string $status)
    {
        return $this->orderRepository->getByStatusOrderDate($status);
    }

    public function getAll($model)
    {
        return $this->orderRepository->getAll($model);
    }

    public function getByStatus($model, string $status)
    {
        return $this->orderRepository->getByStatus($model, $status);
    }

    public function getOrderNumber(): int
    {
        if ($this->orderRepository->getAll(Order::class)->isEmpty()) {
            $year = Carbon::now()->year;
            $orderNumber = $year . sprintf("%'.06d\n", 0);
        } else {
            $orderNumber = $this->orderRepository->getLastOrderNumber();
        }

        return $orderNumber;
    }

    public function getAllOrderDate()
    {
        return $this->orderRepository->getAllOrderDate();
    }

    public function getFirstProductById(OrderCreateRequest $request)
    {
        return $this->productRepository->getFirstProductById($request);
    }

    public function store(OrderCreateRequest $request)
    {
        return $this->orderRepository->store($request);
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        return $this->orderRepository->update($request, $order);
    }

    public function save(Order $order)
    {
        $this->orderRepository->save($order);
    }

    public function sendNotConfirmed(Order $order): void
    {
        dispatch(new SendEmailJob('not confirmed', $order))->delay(now()->addSeconds(30));
    }

    public function sendConfirmed(Order $order): void
    {
        dispatch(new SendEmailJob('confirmed', $order))->delay(now()->addSeconds(30));
    }

    public function sendOrderChange(Order $order): void
    {
        dispatch(new SendEmailJob('order change', $order))->delay(now()->addSeconds(30));
    }

    public function sendCancelled(Order $order)
    {
        dispatch(new SendEmailJob('cancelled', $order))->delay(now()->addSeconds(30));
    }

    public function sendCompleted(Order $order, $pdf)
    {
        dispatch(new SendEmailJob('completed', $order, $pdf))->delay(now()->addSeconds(30));
    }

    public function changeOrderStatus(Order $order, string $status): void
    {
        $this->orderRepository->changeOrderStatus($order, $status);
    }


    public function getByUser($model, int $userId)
    {
        return $model::select('*')
            ->where('user_id', $userId)
            ->sortable()
            ->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();
    }

    public function getOrdersByIdByStatus(int $userId, string $orderStatus)
    {
        return $this->orderRepository->getOrdersByIdByStatus($userId, $orderStatus);
    }

    public function search(string $search)
    {
        return $this->orderRepository->search($search);
    }

    public function getByStatusOrderName(int $userStatus)
    {
        return $this->orderRepository->getByStatusOrderDate($userStatus);
    }

    public function getStatus(Order $order)
    {
        return $this->orderRepository->getStatus($order);
    }

    public function getByProductId(int $productsId)
    {
        return $this->orderRepository->getByProductId($productsId);
    }

    public function getNotAvailable(string $orderDate)
    {
        return $this->orderRepository->getNotAvailable($orderDate);
    }

    public function getBookableOnly($products)
    {
        return $this->productRepository->getBookableOnly($products);
    }

    public function generateInvoice(Order $order)
    {
        $time = Carbon::now()->timezone('Europe/Vilnius');
        $pdf = PDF::loadView('layouts.pdf', ['order' => $order, 'time' => $time]);
        return $pdf->output();
    }

    public function storeToFile(Order $order, $pdf)
    {
        $fileName = "$order->order_number" . '.pdf';
        $path = public_path() . '/assets/invoices/' . $fileName;
        file_put_contents($path, $pdf);
        $order->update(['invoice' => $path]);

    }
}
