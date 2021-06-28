@extends('layouts.app')


@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card mb-3">
            <div class="row no-gutters bg-light position-relative">
                <div class="col-md-6 mb-md-0 p-md-4">
                    <img src="{{$product->image}}" class="w-100" alt="...">
                </div>
                <div class="col-md-6 position-static p-4 pl-md-0">
                    <h2 class="mt-3 mb-4">{{$product->title}}</h2>
                    <p><b>Category:</b> {{$product->category}}</p>
                    <p><b>Price:</b> {{$product->price / 100}} Eur for 12 hours</p>
                    <p>{{$product->description}}</p>
                    <a class="card-link m-1 btn btn-primary" href="
                    @if(!empty($request->order_date))
                        {{route('order.create', $product)}}"
                    @else
                        {{route('product.index')}}"
                        >Check availability</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
