@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row justify-content-center"
             style="text-align: center; position: absolute; transform:translate(-50%, -50%); left:50%; top:50%; width:100%">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('product.index')}}">
                            <label for="date">Pick the date: </label>
                            <input type="date" id="date" name="order_date" placeholder="your date here">
                            <button type="submit">Check availability</button>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
