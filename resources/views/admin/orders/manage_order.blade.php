@extends('admin.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card mb-3 ">
                    <div class="card-body ">
                        <div class="justify-content-center">
                            <form class="mb-4" action="{{route('list.order')}}" method="GET">
                                <span class="input-group-addon" id="basic-addon1">Filter by status</span>
                                <select class="form-control mb-3" name="order_status">
                                    <option value="0">All</option>
                                    <option value="not confirmed" {{$orderStatus == 'not confirmed' ? 'selected': ''}}>not confirmed</option>
                                    <option value="confirmed" {{$orderStatus == 'confirmed' ? 'selected': ''}}>confirmed</option>
                                    <option value="completed" {{$orderStatus == 'completed' ? 'selected': ''}}>completed</option>
                                    <option value="cancelled" {{$orderStatus == 'cancelled' ? 'selected': ''}}>cancelled</option>
                                </select>
                                <div class="mt-3 mb-3">
                                    <span class="input-group-addon" id="basic-addon1">Filter by user</span>
                                    <select class="form-control select-search w-100" name="user_id">
                                        <option value="0" selected>Select user</option>
                                        @forelse($users as $user)
                                            <option value="{{$user->id}}" {{$userId == $user->id ? 'selected': ''}}>#{{$user->id}} - {{$user->name}}</option>
                                        @empty
                                            <option value="0" disabled>No users</option>
                                        @endforelse
                                    </select>
                                </div>
                                <button class="btn btn-info">Filter</button>
                                <a href="{{route('list.order')}}" class="btn btn-info">Reset</a>
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
                                @foreach($orders as $order)
                                    <tr
                                        @if($order->status != 'completed' &&
                                            $order->status != 'cancelled')
                                        style="cursor:pointer;"
                                        onclick="window.location='{{route('order.edit', $order)}}'"
                                        @endif class="hover-zoom">
                                        <td class="mobile-hide">{{$order->id}}</td>
                                        <td>{{$order->date}}</td>
                                        <td>{{$order->orderProducts->title}}</td>
                                        <td class="mobile-hide">{{$order->status}}</td>
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
