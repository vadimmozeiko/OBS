<?php


namespace App\Managers;


use App\Http\Requests\ProductCreateRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Carbon\Carbon;

class ProductManager
{

    public function __construct(
        private ProductRepository $productRepository
    )
    {
    }

    public function getUnavailableDates(Product $product)
    {
       return $this->productRepository->getUnavailableDates($product);
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

    public function changeStatus(Product $product, string $status)
    {
        $this->productRepository->changeStatus($product, $status);
    }

    public function insertImage(ProductCreateRequest $request, Product $product)
    {
        $image = $request->file('image');
        $imageName = $request->get('title') . '-' . Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();

        $path = public_path() . '/assets/img/products/';

        $url = asset('assets/img/products/' . $imageName);

        $image->move($path, $imageName);

        $this->productRepository->changeImage($product, $url);

    }

    public function deleteOldImage(Product $product)
    {
        $imagePath = explode('/', $product->image);
        $imageName = array_pop($imagePath);
        $imagePath = explode('/', $product->image);
        $path = public_path() . '/assets/img/products/' . $imageName;
        if(file_exists($path)) {
            unlink($path);
        }
    }
}
