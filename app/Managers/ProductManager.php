<?php


namespace App\Managers;


use App\Repositories\ProductRepository;

class ProductManager
{

    public function __construct(
        private ProductRepository $productRepository
    )
    {
    }

    public function getAvailableProducts()
    {
        return $this->productRepository->getAvailableProducts();
    }
}
