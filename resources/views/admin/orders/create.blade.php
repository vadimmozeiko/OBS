@extends('layouts.dashboard')

@section('content')

    <h2 class="">Create new booking</h2>
    <div class="input-group pl-md-5 pr-md-5">
        <form style="width: 100%;" method="POST" action="{{route('store.order')}}"
              autocomplete="off"
              enctype="multipart/form-data">
            <div class="mt-3">
                <select id="user" class="form-control select-search w-100" name="user_id">
                    <option value="" selected>Select user</option>
                    @forelse($users as $user)
                        <option value="{{$user->id}}"
                                data-name="{{$user->name}}"
                                data-email="{{$user->email}}"
                                data-address="{{$user->address}}"
                                data-phone="{{$user->phone}}"
                        >#{{$user->id}} - {{$user->name}}</option>
                    @empty
                        <option value="0" disabled>No users</option>
                    @endforelse
                </select>
                @error('user_id')
                <div >
                    <small class="text-danger">{{ $message }}</small>
                </div>
                @enderror
            </div>
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Full name *</span>
            <input id="name" class="form-control @error('name') is-invalid @enderror" type="text"
                   name="name" value="{{old('name')}}" autocomplete="off">
            @error('name')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Email *</span>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email"
                   name="email" value="{{old('email')}}" autocomplete="off">
            @error('email')
            <small class="invalid-feedback " role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Address *</span>
            <input id="address" class="form-control @error('address') is-invalid @enderror" type="text"
                   name="address" value="{{old('address')}}" autocomplete="off">
            @error('address')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Phone no. *</span>
            <input id="phone" class="form-control @error('phone') is-invalid @enderror" type="number"
                   name="phone" value="{{old('phone')}}" autocomplete="off">
            @error('phone')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Booking date *</span>
            <input id="datepicker" class="form-control @error('date') is-invalid @enderror"
                   type="text" name="date"
                   value="{{old('date')}}" autocomplete="off">
            <div class="mt-3">
                <select id="product" class="form-control select-search product w-100" name="product_id">
                    <option selected>Select product</option>
                    @forelse($products as $product)
                        <option value="{{$product->id}}" data-price="{{number_format($product->price / 100, 2)}}">{{$product->title}}
                        </option>
                    @empty
                        <option value="0" disabled>No available products</option>
                    @endforelse
                </select>
                @error('product_id')
                <div>
                    <small class="text-danger">{{ $message }}</small>
                </div>
                @enderror
            </div>
            <span class="input-group-addon d-block mt-3 price" id="basic-addon1">Price. *</span>
            <input id="price" class="form-control @error('price') is-invalid @enderror" type="text"
                   name="price" value="{{old('price')}}" autocomplete="off">
            @error('price')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Message</span>
            <textarea class="form-control mb-3"
                      name="message">{{old('message', '')}}</textarea>
            <input type="hidden" name="status" value="{{\App\Models\Order::STATUS_NOT_CONFIRMED}}">
            <input type="hidden" name="order_number" value="{{$orderNumber}}">
            <small class="d-block mb-3">* Required info</small>
            <button class="btn btn-primary btn-m" type="submit">CREATE</button>
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

        $('#product').on('change', function () {
            const price = $(this).children('option:selected').data('price');
            $('#price').val(price);
        });

        $('#user').on('change', function () {
            const name = $(this).children('option:selected').data('name');
            const email = $(this).children('option:selected').data('email');
            const address = $(this).children('option:selected').data('address');
            const phone = $(this).children('option:selected').data('phone');
            $('#name').val(name);
            $('#email').val(email);
            $('#address').val(address);
            $('#phone').val(phone);
        });
    </script>
@endsection
