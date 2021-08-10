<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Managers\ProductManager;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(private ProductManager $productManager)
    {
    }

    public function index(): View
    {
        $products = $this->productManager->getAll(Product::class);

        return view('admin.products.index', ['products' => $products]);
    }


    public function create()
    {
        return view('admin.products.create');
    }


    public function store(ProductCreateRequest $request)
    {
        $product = $this->productManager->store($request);
        $product->update(['image' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg']);
        if ($request->has('image')) {
            $this->productManager->insertImage($request, $product);
        }
        return redirect()->route('product.index')->with('success_message', 'Product added successfully');
    }

    public function show(Product $product): View
    {
        return view('products.show', ['product' => $product]);
    }


    public function edit(Product $product)
    {
        return view('admin.products.edit', ['product' => $product]);
    }


    public function update(ProductCreateRequest $request, Product $product)
    {
        if($product->image && $request->has('image')) {
            $this->productManager->deleteOldImage($product);
        }

        $this->productManager->update($request, $product);

        if ($request->has('image')) {
            $this->productManager->insertImage($request, $product);
        } else if ($request->has('delete_image')) {
            $this->productManager->deleteOldImage($product);
            $product->update(['image' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg']);
        }

        return redirect()->route('product.index')->with('success_message', 'Product updated successfully');
    }


    public function changeStatus(Product $product, Request $request)
    {
        $status = $request->get('status');
        $product->status()->transitionTo($status);

        return redirect()->route('product.index')->with('success_message', 'Product status changed successfully');
    }
}
