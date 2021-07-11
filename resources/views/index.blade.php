@extends('layouts.app')

@section('content')
    <div class="container d-flex">
        <div class="row main justify-content-center"
             style="text-align: center; position: absolute; transform:translate(-50%, -50%); left:50%; top:50%; width:100%">
            <h1 class="main-title">The journey to the fun world starts here</h1>
            <form class="w-75" action="{{route('product.index')}}">
                <div class="form-row text-center d-flex flex-wrap justify-content-center">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                        <input id="datepicker" class="search form-control mb-3" type="text"
                               name="order_date" placeholder="Pick the date" autocomplete="off" required>
                    </div>
                    <div>
                        <button class="btn btn-primary search" type="submit">Check availability</button>
                    </div>
                    @csrf
                </div>
            </form>
        </div>
    </div>
@endsection
