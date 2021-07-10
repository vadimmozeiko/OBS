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
                                    <option value="3" {{$orderStatus == '3' ? 'selected': ''}}>not confirmed</option>
                                    <option value="4" {{$orderStatus == '4' ? 'selected': ''}}>confirmed</option>
                                    <option value="5" {{$orderStatus == '5' ? 'selected': ''}}>completed</option>
                                    <option value="6" {{$orderStatus == '6' ? 'selected': ''}}>cancelled</option>
                                </select>
                                <button class="btn btn-info">Filter</button>
                                <a href="{{route('user.orders', $user)}}" class="btn btn-info">Reset</a>
                            </form>
                            <table class="table table-sortable">
                                <thead>
                                <tr>
                                    <th class="sort-order sortable mobile-hide" scope="col">Booking# <i class="order fas fa-sort-numeric-up"></i></th>
                                    <th class="sort-date sortable" scope="col">Date <i class="date fas fa-sort-numeric-up"></i>
                                    </th>
                                    <th class="sort-title sortable" scope="col">Title <i class="title fas fa-sort-alpha-up"></i></th>
                                    <th class="sort-status sortable mobile-hide" scope="col">Status <i class="status fas fa-sort-alpha-up"></i></th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userOrders as$order)
                                <tr
                                    @if($order->status_id != '5' &&
                                        $order->status_id != '6')
                                    style="cursor:pointer;"
                                    onclick="window.location='{{route('order.edit', $order)}}'"
                                    @endif class="hover-zoom">
                                    <td class="mobile-hide">{{$order->id}}</td>
                                    <td>{{$order->date}}</td>
                                    <td>{{$order->orderProducts->title}}</td>
                                    <td class="mobile-hide">{{$order->orderStatus->status}}</td>
                                    <td class="d-flex mobile-hide">
                                        <a class="card-link btn btn-primary btn-sm m-1"
                                           href="{{route('order.show', $order)}}">Details</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
