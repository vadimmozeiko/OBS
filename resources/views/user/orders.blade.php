@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-10 col-lg-10">
                <div class="card mb-3 ">
                    <div class="card-header"></div>
                    <div class="card-body ">
                        <div class="justify-content-center">
                            <form class="mb-4" action="{{route('user.orders', $user)}}" method="GET">
                                <span class="input-group-addon" id="basic-addon1">Filter by status</span>
                                <select class="form-control mb-3" name="order_status">
                                    <option value="0">All</option>
                                    @foreach(\App\Models\Order::STATUSES as $status)
                                        <option value="{{$status}}" {{$orderStatus == $status ? 'selected': ''}}>
                                            {{$status}}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-info">Filter</button>
                                <a href="{{route('user.orders', $user)}}" class="btn btn-info">Reset</a>
                            </form>
                            <table class="table table-sortable">
                                <thead>
                                <tr>
                                    <th class="mobile-hide" scope="col">@sortablelink('order_number', '#')</th>
                                    <th scope="col">@sortablelink('date', 'Date') </th>
                                    <th  scope="col">@sortablelink('product_id', 'Product')</th>
                                    <th class="mobile-hide" scope="col">@sortablelink('status', 'Status')</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userOrders as $order)
                                <tr
                                    @if($order->status != \App\Models\Order::STATUS_COMPLETED &&
                                        $order->status != \App\Models\Order::STATUS_CANCELLED)
                                    style="cursor:pointer;"
                                    onclick="window.location='{{route('order.edit', $order)}}'"
                                    @endif class="hover-zoom">
                                    <td class="mobile-hide">{{$order->order_number}}</td>
                                    <td>{{$order->date}}</td>
                                    <td>{{$order->orderProducts->title}}</td>
                                    <td class="mobile-hide">{{$order->status}}</td>
                                    <td class="d-flex mobile-hide">
                                        <a class="card-link btn btn-primary btn-sm m-1"
                                           href="{{route('order.show', $order)}}">Details</a>
                                        @if($order->invoice)
                                            <a href="{{asset('/assets/invoices/'. $order->order_number . '.pdf')}}" class="card-link btn btn-outline-success btn-sm m-1"
                                            >Invoice
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {!! $userOrders->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
