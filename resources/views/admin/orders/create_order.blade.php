@extends('admin.dashboard')

@section('content')

    <h2 class="">Create new booking</h2>
    <div class="input-group pl-md-5 pr-md-5">
        <form style="width: 100%;" method="POST" action="{{route('store.order')}}"
              autocomplete="off"
              enctype="multipart/form-data">
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Full name *</span>
            <input class="form-control @error('user_name') is-invalid @enderror" type="text"
                   name="user_name" value="{{old('user_name')}}" autocomplete="off">
            @error('user_name')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Email *</span>
            <input class="form-control @error('user_email') is-invalid @enderror" type="email"
                   name="user_email" value="{{old('user_email')}}" autocomplete="off">
            @error('user_email')
            <small class="invalid-feedback " role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Address *</span>
            <input class="form-control @error('user_address') is-invalid @enderror" type="text"
                   name="user_address" value="{{old('user_address')}}" autocomplete="off">
            @error('user_address')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Phone no. *</span>
            <input class="form-control @error('user_phone') is-invalid @enderror" type="number"
                   name="user_phone" value="{{old('user_phone')}}" autocomplete="off">
            @error('user_phone')
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
                        <option value="{{$product->id}}" data-price="{{$product->price / 100}}">{{$product->title}} - {{$product->price / 100}} Eur</option>
                    @empty
                        <option value="0" disabled>No available products</option>
                    @endforelse
                </select>
            </div>
            <div class="mt-3">
                <select class="form-control select-search w-100" name="user_id">
                    <option selected>Select user</option>
                    @forelse($users as $user)
                        <option value="{{$user->id}}">#{{$user->id}} - {{$user->name}}</option>
                    @empty
                        <option value="0" disabled>No users</option>
                    @endforelse
                </select>
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
                      name="user_message">{{old('user_message', '')}}</textarea>
            <input type="hidden" name="status_id" value="3">
            <small class="d-block mb-3">* Required info</small>
            <button class="btn btn-primary btn-m" type="submit">CREATE</button>
            @csrf
        </form>
    </div>
    <script>
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            weekStartDay: 1,
            minDate: function() {
                const date = new Date();
                date.setDate(date.getDate()+1);
                return new Date(date.getFullYear(), date.getMonth(), date.getDate());
            },
            maxDate: function() {
                const date = new Date();
                date.setDate(date.getDate()+90);
                return new Date(date.getFullYear(), date.getMonth(), date.getDate());
            },
            uiLibrary: 'bootstrap4',
            showRightIcon: false
        });

        $('#product').on('change',function(){
            const price = $(this).children('option:selected').data('price');
            $('#price').val(price);

        });
    </script>
@endsection
