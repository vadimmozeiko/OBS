@extends('layouts.dashboard')

@section('content')

    <h2 class="">Product details #{{$product->id}}</h2>
    <div class="pl-md-5 pr-md-5 mb-5">
        <form method="POST" action="{{route('product.update', $product)}}">
            @csrf
            <div class="col-md-6 mb-md-2 p-md-4">
                <img src="{{$product->image}}" alt="product image">
                <input type="hidden" value="{{$product->image}}">
            </div>
            <div class="form-group row">
                <label for="title" class="col-md-10 col-form-label text-md-left">Title</label>

                <div class="col-md-10">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="name"
                           value="{{old('title', $product->title)}}" autocomplete="title" autofocus>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="category" class="col-md-10 col-form-label text-md-left">Category</label>

                <div class="col-md-10">
                    <input id="category" type="text" class="form-control @error('category') is-invalid @enderror"
                           name="category"
                           value="{{old('category', $product->category)}}" autocomplete="category">

                    @error('category')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-md-10 col-form-label text-md-left">Price</label>

                <div class="col-md-10">
                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror"
                           name="price"
                           value="{{old('price', number_format($product->price / 100, 2))}}" autocomplete="price">

                    @error('price')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-md-10 col-form-label text-md-left">Description</label>
                <div class="col-md-10">
                    <textarea rows="5" class="form-control"
                      name="description">{{old('description', $product->description)}}</textarea>
                </div>
            </div>

            <input type="hidden" name="status" value="{{\App\Models\Product::STATUS_AVAILABLE}}">
            <div class="form-group row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
