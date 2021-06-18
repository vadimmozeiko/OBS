@extends('layouts.app')


@section('content')
    <div class="container d-flex flex-wrap justify-content-around">
        @foreach($products as $product)
            <div style="cursor: pointer;" class="col-sm-6 col-md-4 col-lg-4 mb-5">
                <div class="card text-center">
                    <div onclick="window.location='{{route('product.show', $product)}}'">
                        <h3 class="mt-5">{{$product->title}}</h3>
                        <img class="card-img-top w-75" src="{{$product->image}}" alt="Bounce Image">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p>Category: {{$product->category}}</p>
                            <p>Price: {{$product->price / 100}} Eur</p>
                            <p>Price: {{$product->short_description}} Eur</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <a class="card-lin km-1 btn btn-primary" href="#">BOOK NOW</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

