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
            $image = $request->file('image');
            $imageName = $request->get('title') . '-' . Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();

            $path = public_path() . '/assets/img/products/';

            $url = asset('assets/img/products/' . $imageName);

            $image->move($path, $imageName);

            $product->update(['image' => $url]);
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
        $this->productManager->update($request, $product);

        return redirect()->route('product.index')->with('success_message', 'Product updated successfully');
    }


    public function changeStatus(Product $product, Request $request)
    {
        $status = $request->get('status');
        $this->productManager->changeStatus($product, $status);

        return redirect()->route('product.index')->with('success_message', 'Product deleted successfully');
    }
}
