@extends('layouts.app')


@section('content')
    <div class="container d-flex flex-wrap justify-content-around">
        @foreach($products as $product)
            <div style="cursor: pointer;" class="col-sm-6 col-md-4 col-lg-4 mb-5">
                <div class="card text-center">
                    <div onclick="window.location='{{route('product.show', $product)}}'">
                        <img class="card-img-top w-75" src="{{$product->image}}" alt="Bounce Image">
                        <div class="card-body">
                            <h2>{{$product->title}}</h2>
                            <p>{{$product->category}}</p>
                            <p>{{$product->price / 100}} Eur</p>
                            <p>{{$product->short_description}}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="
                            @if(!empty($request->order_date))
                        {{route('order.create', $product)}}"
                        @else
                            {{route('index')}}"
                            @endif
                        >
                            <input type="hidden" name="order_date" value="{{$request->order_date}}">
                            <button type="submit" class="card-link btn btn-primary">BOOK NOW</button>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

