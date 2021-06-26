@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-3 ">
                    <div class="card-header" style="background-color: var(--blue);"></div>
                    <div class="card-body ">
                        <div class="justify-content-center">
                            <form class="mb-4" action="{{route('user.orders', $user)}}" method="GET">
                                <span class="input-group-addon" id="basic-addon1">Filter by status</span>
                                <select class="form-control mb-3" name="order_status">
                                    <option value="0">All</option>
                                    <option value="not confirmed" @if($orderStatus == 'not confirmed') selected @endif>not confirmed</option>
                                    <option value="confirmed" @if($orderStatus == 'confirmed') selected @endif>confirmed</option>
                                    <option value="completed" @if($orderStatus == 'completed') selected @endif>completed</option>
                                </select>
                                <button class="btn btn-info">Filter</button>
                                <a href="{{route('user.orders', $user)}}" class="btn btn-info">Reset</a>
                            </form>
                            <table class="table table-sortable">
                                <thead>
                                <tr>
                                    <th class="sort-order" scope="col"># <i class="order fas fa-sort-numeric-up"></i></th>
                                    <th class="sort-date" scope="col">Date <i class="date fas fa-sort-numeric-up"></i>
                                    </th>
                                    <th class="sort-title" scope="col">Title <i class="title fas fa-sort-alpha-up"></i></th>
                                    <th class="sort-status" scope="col">Status <i class="status fas fa-sort-alpha-up"></i></th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userOrders as $key => $order)
                                <tr
                                    @if($order->status == 'not confirmed')
                                    style="cursor:pointer;"
                                    onclick="window.location='{{route('order.edit', $order)}}'"
                                    @endif>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$order->date}}</td>
                                    <td>{{$order->orderProducts->title}}</td>
                                    <td>{{$order->status}}</td>
                                    <td>
                                        <form method="POST" action="{{route('order.destroy', $order)}}">
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                    @if($order->status == 'completed' ||
                                                        $order->status == 'cancelled')
                                                    disabled
                                                    @endif
                                            >CANCEL</button>
                                        </form>
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
