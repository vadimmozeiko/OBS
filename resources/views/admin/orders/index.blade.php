@extends('layouts.dashboard')

@section('content')
    <h2 class="">Manage bookings</h2>
    <div class="justify-content-center pl-md-5 pr-md-5">
        <button type="button" id="filterBtn" class="btn btn-outline-info w-100 mb-3">FILTERS</button>
        <div id="filters" style="display: none">
        <form class="mb-4" action="{{route('list.order')}}" method="GET">
            <span class="input-group-addon" id="basic-addon1">Filter by status</span>
            <select class="form-control mb-3" name="order_status">
                <option value="0">All</option>
                @foreach(\App\Models\Order::STATUSES as $status)
                    <option value="{{$status}}" {{$orderStatus == $status ? 'selected': ''}}>
                        {{$status}}</option>
                @endforeach
            </select>
            <div class="mt-3 mb-3 w-100">
                <span class="input-group-addon" id="basic-addon1">Filter by user</span>
                <select class="form-control select-search w-100" name="user_id">
                    <option value="0" selected>All</option>
                    @forelse($users as $user)
                        <option value="{{$user->id}}" {{$userId == $user->id ? 'selected': ''}}>#{{$user->id}}
                            - {{$user->name}}</option>
                    @empty
                        <option value="0" disabled>No users</option>
                    @endforelse
                </select>
            </div>
            <span class="input-group-addon" id="basic-addon1">Filter by product</span>
            <select class="form-control mb-3" name="product">
                <option value="0">All</option>
                @foreach($products as $product)
                    <option value="{{$product->id}}" {{$productId == $product->id ? 'selected': ''}}>
                        {{$product->title}}</option>
                @endforeach
            </select>
            <button class="btn btn-info">Filter</button>
            <a href="{{route('list.order')}}" class="btn btn-info">Reset</a>
        </form>
        </div>
        <form action="{{route('list.order')}}">
            <div class="form-group mb-2 d-flex">
                <input class="form-control" name="search" type="text" value="{{$search}}" placeholder="Quick search...">
                <button type="submit" class="btn btn-primary mb-2 ml-3">Search</button>
            </div>
        </form>
        <table class="table table-sortable">
            <thead>
            <tr>
                <th class="mobile-hide" scope="col">@sortablelink('order_number', '#')</th>
                <th scope="col">@sortablelink('date', 'Date')</th>
                <th class="mobile-hide" scope="col">@sortablelink('name', 'Name')</th>
                <th scope="col">@sortablelink('product_id', 'Product')</th>
                <th class="mobile-hide" scope="col">@sortablelink('status', 'Status')</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="hover-zoom">
                    <td class="mobile-hide">{{$order->order_number}}</td>
                    <td>{{$order->date}}</td>
                    <td class="mobile-hide">{{$order->name}}</td>
                    <td>{{$order->orderProducts->title}}</td>
                    <td class="mobile-hide">{{$order->status}}</td>
                    <td class="d-flex mobile-hide justify-content-end">
                        @if($order->invoice)
                            <a href="{{asset('/assets/invoices/'. $order->order_number . '.pdf')}}" class="card-link btn btn-outline-success btn-sm m-1"
                            >Invoice
                            </a>
                        @endif
                        <form action="{{route('edit.order', $order)}}">
                            <button type="submit" class="card-link btn btn-info btn-sm m-1"
                            >Details
                            </button>
                        </form>
                        <form method="POST" action="{{route('change.order', $order)}}">
                            <button type="submit" class="card-link btn btn-primary btn-sm m-1"
                                    @if($order->status == \App\Models\Order::STATUS_CONFIRMED ||
                                        $order->status == \App\Models\Order::STATUS_COMPLETED ||
                                        $order->status == \App\Models\Order::STATUS_CANCELLED)
                                    disabled
                                @endif
                            >Confirm
                            </button>
                            <input type="hidden" name="status" value="{{\App\Models\Order::STATUS_CONFIRMED}}">
                            @csrf
                        </form>
                        <form method="POST" action="{{route('change.order', $order)}}">
                            <button type="submit" class="card-link btn btn-success btn-sm m-1"
                                    @if($order->status == \App\Models\Order::STATUS_NOT_CONFIRMED ||
                                        $order->status == \App\Models\Order::STATUS_COMPLETED ||
                                        $order->status == \App\Models\Order::STATUS_CANCELLED)
                                    disabled
                                @endif>Complete
                            </button>
                            <input type="hidden" name="status" value="{{\App\Models\Order::STATUS_COMPLETED}}">
                            @csrf
                        </form>
                        <form method="POST" action="{{route('change.order', $order)}}">
                            <button type="submit" class="card-link btn btn-danger btn-sm m-1"
                                    @if($order->status == \App\Models\Order::STATUS_COMPLETED ||
                                        $order->status == \App\Models\Order::STATUS_CANCELLED)
                                    disabled
                                @endif>CANCEL
                            </button>
                            <input type="hidden" name="status" value="{{\App\Models\Order::STATUS_CANCELLED}}">
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $orders->links() !!}
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
@endsection
