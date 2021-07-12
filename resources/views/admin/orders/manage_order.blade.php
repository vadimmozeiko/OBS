@extends('admin.dashboard')

@section('content')

    <div class="justify-content-center pl-md-5 pr-md-5">
        <form class="mb-4" action="{{route('list.order')}}" method="GET">
            <span class="input-group-addon" id="basic-addon1">Filter by status</span>
            <select class="form-control mb-3" name="order_status">
                {{--            // TODO refactor to get statuses from DB--}}
                <option value="0">All</option>
                <option value="3" {{$orderStatus == '3' ? 'selected': ''}}>not confirmed
                </option>
                <option value="4" {{$orderStatus == '4' ? 'selected': ''}}>confirmed</option>
                <option value="5" {{$orderStatus == '5' ? 'selected': ''}}>completed</option>
                <option value="6" {{$orderStatus == '6' ? 'selected': ''}}>cancelled</option>
            </select>
            <div class="mt-3 mb-3">
                <span class="input-group-addon" id="basic-addon1">Filter by user</span>
                <select class="form-control select-search w-100" name="user_id">
                    <option value="0" selected>Select user</option>
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
        <div class="form-outline mb-2">
            <input name="search" type="text" id="search-field" class="form-control" placeholder="Search...">
        </div>
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
                            @csrf
                        </form>
                        <form method="POST" action="{{route('change.order', $order)}}">
                            <button type="submit" class="card-link btn btn-primary btn-sm m-1"
                                    @if($order->status_id == '4' ||
                                        $order->status_id == '5' ||
                                        $order->status_id == '6')
                                    disabled
                                @endif
                            >Confirm
                            </button>
                            <input type="hidden" name="status_id" value="4">
                            @csrf
                        </form>
                        <form method="POST" action="{{route('change.order', $order)}}">
                            <button type="submit" class="card-link btn btn-success btn-sm m-1"
                                    @if($order->status_id == '3' ||
                                        $order->status_id == '5' ||
                                        $order->status_id == '6')
                                    disabled
                                @endif>Complete
                            </button>
                            <input type="hidden" name="status_id" value="5">
                            @csrf
                        </form>
                        <form method="POST" action="{{route('change.order', $order)}}">
                            <button type="submit" class="card-link btn btn-danger btn-sm m-1"
                                    @if($order->status_id == '5' ||
                                        $order->status_id == '6')
                                    disabled
                                @endif>CANCEL
                            </button>
                            <input type="hidden" name="status_id" value="6">
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
