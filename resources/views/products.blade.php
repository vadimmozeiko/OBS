@extends('layouts.app')

@section('content')
    <div class="d-flex flex-wrap justify-content-center">
        <form style="width: 80%;" action="{{route('products')}}">
            <div class="form-row text-center justify-content-center">
                <div class="col-10 col-sm-10 col-md-6 col-lg-6">
                    <input style="{{session()->get('style')}}" id="datepicker" class="datepicker form-control mb-3 text-center" type="text"
                           name="order_date"
                           @if(!empty(request()->has('order_date'))) value="{{request()->get('order_date')}}"
                           @else placeholder="Pick the date" @endif autocomplete="off" required>
                </div>
                <div class="col-12 col-sm-12">
                    <button class="btn btn-primary mb-3" type="submit">Check availability</button>
                    <input class="checkbox" type="checkbox" name="available_only"
                           {{request()->has('available_only') == 1 ? 'checked' : ''}} value="1">
                    <span class="input-group-addon search-checkbox text-white">Available only</span>
                </div>
            </div>
        </form>
    </div>
    <div class="container d-flex flex-wrap justify-content-around">
        @forelse($products as $product)
            <div style="cursor: pointer;" class="col-sm-12 col-md-6 col-lg-4 mb-5 hover-animate">
                <div class="card text-center p-4 h-100">
                    <div onclick="window.location='{{route('product.show', $product)}}'">
                        <img class="card-img-top w-75" src="{{$product->image}}" alt="Bounce Image">
                        <div class="card-body">
                            <h2 class="product-title mb-3">{{$product->title}}</h2>
                            <p>{{$product->category}}</p>
                            <p> &#128;{{number_format($product->price / 100, 2)}} / 12 hours</p>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{route('order.create', $product)}}">
                            <input type="hidden" name="order_date" value="{{request()->get('order_date')}}">
                            <button type="submit" class="card-link btn btn-primary"
                                    @if(isset($reserved) && ($reserved->contains('product_id', $product->id)))
                                    disabled>BOOKED
                            </button>
                            @else
                                >BOOK NOW</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <h3 class="text-white pt-5">Sorry, looks like we are fully booked :(</h3>
        @endforelse
    </div>
@endsection

