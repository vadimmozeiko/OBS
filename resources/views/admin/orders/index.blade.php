@extends('admin.dashboard')

@section('content')
    <h2 class="">Manage bookings</h2>
    <div class="justify-content-center pl-md-5 pr-md-5">
        <form class="mb-4" action="{{route('list.order')}}" method="GET">
            <span class="input-group-addon" id="basic-addon1">Filter by status</span>
            <select class="form-control mb-3" name="order_status">
                <option value="0">All</option>
                @foreach($statuses as $status)
                    <option value="{{$status->id}}" {{$orderStatus == $status->id ? 'selected': ''}}>
                        {{$status->status}}</option>
                @endforeach
            </select>
            <div class="mt-3 mb-3">
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
            <button class="btn btn-info">Filter</button>
            <a href="{{route('list.order')}}" class="btn btn-info">Reset</a>
        </form>
        <form action="{{route('list.order')}}">
            <div class="form-group mb-2 d-flex">
                <input class="form-control" name="search" type="text" value="{{$search}}" placeholder="Quick search...">
                <button type="submit" class="btn btn-primary mb-2 ml-3">Search</button>
            </div>
        </form>
        <table class="table table-sortable">
            <thead>
            <tr>
                <th class="sort-order sortable mobile-hide" scope="col"># <i class="order fas fa-sort-numeric-up"></i>
                </th>
                <th class="sort-date sortable" scope="col">Date <i class="date fas fa-sort-numeric-up"></i>
                </th>
                <th class="sort-name sortable mobile-hide" scope="col">Name <i class="name fas fa-sort-alpha-up"></i>
                </th>
                <th class="sort-title sortable" scope="col">Product <i class="title fas fa-sort-alpha-up"></i></th>
                <th class="sort-status sortable mobile-hide" scope="col">Status <i
                        class="status fas fa-sort-alpha-up"></i></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="hover-zoom">
                    <td class="mobile-hide">{{$order->id}}</td>
                    <td>{{$order->date}}</td>
                    <td class="mobile-hide">{{$order->user_name}}</td>
                    <td>{{$order->orderProducts->title}}</td>
                    <td class="mobile-hide">{{$order->orderStatus->status}}</td>
                    <td class="d-flex mobile-hide justify-content-end">
                        <form action="{{route('edit.order', $order)}}">
                            <button type="submit" class="card-link btn btn-info btn-sm m-1"
                            >Details
                            </button>
                        </form>
                        <form method="POST" action="{{route('change.order', $order)}}">
                            <button type="submit" class="card-link btn btn-primary btn-sm m-1"
                                    @if($order->status_id == '5' ||
                                        $order->status_id == '6' ||
                                        $order->status_id == '7')
                                    disabled
                                @endif
                            >Confirm
                            </button>
                            <input type="hidden" name="status_id" value="4">
                            @csrf
                        </form>
                        <form method="POST" action="{{route('change.order', $order)}}">
                            <button type="submit" class="card-link btn btn-success btn-sm m-1"
                                    @if($order->status_id == '4' ||
                                        $order->status_id == '6' ||
                                        $order->status_id == '7')
                                    disabled
                                @endif>Complete
                            </button>
                            <input type="hidden" name="status_id" value="5">
                            @csrf
                        </form>
                        <form method="POST" action="{{route('change.order', $order)}}">
                            <button type="submit" class="card-link btn btn-danger btn-sm m-1"
                                    @if($order->status_id == '6' ||
                                        $order->status_id == '7')
                                    disabled
                                @endif>CANCEL
                            </button>
                            <input type="hidden" name="status_id" value="7">
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
