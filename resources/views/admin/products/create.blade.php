@extends('layouts.dashboard')

@section('content')

    <h2 class="">Add new product</h2>
    <div class="pl-md-5 pr-md-5 mb-5">
        <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="image" class="col-md-10 col-form-label text-md-left">Image </label>
                <div class="col-md-10">
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                           value="{{old('image')}}" autocomplete="image" autofocus>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                     <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="title" class="col-md-10 col-form-label text-md-left">Title *</label>
                <div class="col-md-10">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                           value="{{old('title')}}" autocomplete="title" autofocus>
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                     <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="category" class="col-md-10 col-form-label text-md-left">Category *</label>
                <div class="col-md-10">
                    <input id="category" type="text" class="form-control @error('category') is-invalid @enderror"
                           name="category"
                           value="{{old('category')}}" autocomplete="category">
                    @error('category')
                    <span class="invalid-feedback" role="alert">
                     <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-md-10 col-form-label text-md-left">Price *</label>
                <div class="col-md-10">
                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror"
                           name="price"
                           value="{{old('price')}}" autocomplete="price">
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                     </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-md-10 col-form-label text-md-left">Description </label>
                <div class="col-md-10">
                    <textarea rows="5" class="form-control"
                              name="description">{{old('description')}}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-md-10 col-form-label text-md-left">Status *</label>
                <div class="col-md-10">
                    <select class="form-control mb-3 @error('status') is-invalid @enderror" name="status" >
                        <option value="0">Select status</option>
                        @foreach(\App\Models\Product::STATUSES as $status)
                            <option value="{{$status}}">{{$status}}</option>
                        @endforeach
                    </select>
                    @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                     </span>
                    @enderror
                </div>
            </div>
            <small class="d-block mb-3">* Required info</small>
            <div class="form-group row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
