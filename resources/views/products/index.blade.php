@extends('layouts.app')


@section('content')
    <div class="container d-flex justify-content-around">
        <div class="row">
            @foreach($products as $product)
                <div class="col-sm mb-5">
                    <div class="card text-center " style="width: 18rem;">
                        <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->title}}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Category: {{$product->category}}</li>
                            <li class="list-group-item">Price: {{$product->price / 100}} Eur</li>
                        </ul>
                        <div class="card-body">
                            <a class="m-1 btn btn-primary" href="#" class="card-link">BOOK NOW</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

