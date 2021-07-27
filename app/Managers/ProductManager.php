<?php


namespace App\Managers;


use App\Http\Requests\ProductCreateRequest;
use App\Models\Product;
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

    public function getAll($model)
    {
       return $this->productRepository->getAll($model);
    }

    public function store(ProductCreateRequest $request)
    {
       return $this->productRepository->store($request);
    }

    public function update(ProductCreateRequest $request, Product $product)
    {
       $this->productRepository->update($request, $product);
    }
}
