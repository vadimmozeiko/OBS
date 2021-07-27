<?php


namespace App\Managers;


use App\Http\Controllers\MailController;
use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Models\User;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;

class OrderManager
{

    /**
     * OrderManager constructor.
     */
    public function __construct(
        private OrderRepository $orderRepository,
        private ProductRepository $productRepository,
        private MailController $mailController,
        private UserRepository $userRepository)
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

    public function getByStatus($model, int $status)
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

    public function SendNotConfirmed(Order $order): void
    {
        $this->mailController->notConfirmed($order);
    }

    public function SendOrderChange(Order $order): void
    {
        $this->mailController->orderChange($order);
    }

    public function SendCancelled(Order $order)
    {
        $this->mailController->cancelled($order);
    }

    public function SendWelcome(User $user)
    {
        $this->mailController->welcome($user);
    }

    public function changeOrderStatus(Order $order, string $status): void
    {
        $this->orderRepository->changeOrderStatus($order, $status);
    }


    public function getByUser($model, int $userId)
    {
        return $this->userRepository->getByUser($model, $userId);
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

    public function getOrdersByIdByProduct(int $userId, int $productsId)
    {
        return $this->orderRepository->getOrdersByIdByProduct($userId, $productsId);
    }

    public function getOrdersByIdByStatusByProduct(int $userId, int $orderStatus, int $productsId)
    {
        return $this->orderRepository->getOrdersByIdByStatusByProduct($userId, $orderStatus, $productsId);
    }

    public function getNotAvailable(string $orderDate)
    {
        return $this->orderRepository->getNotAvailable($orderDate);
    }

    public function getBookableOnly($products)
    {
        return $this->productRepository->getBookableOnly($products);
    }
}
