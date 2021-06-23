@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row justify-content-center"
             style="text-align: center; position: absolute; transform:translate(-50%, -50%); left:50%; top:50%; width:100%">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="input-group justify-content-center mt-5 mb-5">
                            <form style="width: 50%;" action="{{route('product.index')}}">
                                <span class="input-group-addon" id="basic-addon1">Pick the date:</span>
                                <input class="form-control mb-3 text-center" type="text"
                                       name="order_date" required>
                                <button class="card-link m-1 btn btn-primary" type="submit">Check availability</button>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
