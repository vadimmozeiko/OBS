@extends('admin.dashboard')

@section('content')
    <h2 class="">Booking #{{$order->id}} details</h2>
    <div class="input-group ">
        <form style="width: 100%;" method="POST" action="{{route('update.order', $order)}}"
              enctype="multipart/form-data">
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Full name *</span>
            <input class="form-control @error('user_name') is-invalid @enderror" type="text"
                   name="user_name" value="{{old('user_name', $order->user_name)}}">
            @error('user_name')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Email *</span>
            <input class="form-control @error('user_email') is-invalid @enderror" type="email"
                   name="user_email" value="{{old('user_email', $order->user_email)}}">
            @error('user_email')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Phone no. *</span>
            <input class="form-control @error('user_phone') is-invalid @enderror" type="number"
                   name="user_phone" value="{{old('user_phone', $order->user_phone)}}">
            @error('user_phone')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Booking date: *</span>
            <input id="datepicker" class="form-control @error('date') is-invalid @enderror"
                   type="text" name="date" value="{{old('date', $order->date)}}">
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Price *</span>
            <input class="form-control @error('price') is-invalid @enderror" type="text"
                   name="price" value="{{old('price', $order->price / 100)}}">
            @error('price')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Created at: </span>
            <input class="form-control" type="text" value="{{$order->created_at}}" disabled>
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Last time updated at: </span>
            <input class="form-control" type="text" value="{{$order->updated_at}}" disabled>
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Status: </span>
            <input class="form-control" type="text" value="{{$order->orderStatus->status}}" disabled>
            <small class="d-block mt-3 mb-3">* Required info</small>
            <input type="hidden" name="product_id" value="{{$order->orderProducts->id}}">
            <button class="btn btn-primary btn-m
            @if($order->status_id > 5)
                d-none
                @endif
            " type="submit"
            >Save
            </button>
            <a class="card-link btn btn-primary m-1"
               href="{{url()->previous()}}">Back</a>
            @csrf
        </form>
    </div>
    <script>
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            weekStartDay: 1,
            minDate: function () {
                const date = new Date();
                date.setDate(date.getDate() + 1);
                return new Date(date.getFullYear(), date.getMonth(), date.getDate());
            },
            maxDate: function () {
                const date = new Date();
                date.setDate(date.getDate() + 90);
                return new Date(date.getFullYear(), date.getMonth(), date.getDate());
            },
            uiLibrary: 'bootstrap4',
            showRightIcon: false
        });
    </script>
@endsection
