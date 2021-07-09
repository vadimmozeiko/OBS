@extends('admin.dashboard')

@section('content')

    <div class="justify-content-center pl-md-5 pr-md-5">
        <form class="mb-4" action="{{route('list.order')}}" method="GET">
            <span class="input-group-addon" id="basic-addon1">Filter by status</span>
            <select class="form-control mb-3" name="order_status">
                <option value="0">All</option>
                <option value="not confirmed" {{$orderStatus == 'not confirmed' ? 'selected': ''}}>not confirmed
                </option>
                <option value="confirmed" {{$orderStatus == 'confirmed' ? 'selected': ''}}>confirmed</option>
                <option value="completed" {{$orderStatus == 'completed' ? 'selected': ''}}>completed</option>
                <option value="cancelled" {{$orderStatus == 'cancelled' ? 'selected': ''}}>cancelled</option>
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
                    <td class="mobile-hide">{{$order->status}}</td>
                    <td class="d-flex mobile-hide justify-content-end">
                        <form method="POST" action="{{route('change.order', $order)}}">
                            <button type="submit" class="card-link btn btn-primary btn-sm m-1"
                                    @if($order->status == 'cancelled' ||
                                        $order->status == 'completed' ||
                                        $order->status == 'confirmed')
                                    disabled
                                @endif
                            >Confirm
                            </button>
                            <input type="hidden" name="status" value="confirmed">
                            @csrf
                        </form>
                        <form method="POST" action="">
                            <button type="submit" class="card-link btn btn-info btn-sm m-1"
                            >Edit
                            </button>
                            @csrf
                        </form>
                        <form method="POST" action="{{route('change.order', $order)}}">
                            <button type="submit" class="card-link btn btn-success btn-sm m-1"
                                    @if($order->status == 'cancelled' ||
                                        $order->status == 'completed')
                                    disabled
                                @endif>Complete
                            </button>
                            <input type="hidden" name="status" value="completed">
                            @csrf
                        </form>
                        <button type="submit" class="card-link btn btn-danger btn-sm m-1 ml-4"
                                data-toggle="modal" data-target="#cancelModal"
                                @if($order->status == 'cancelled' ||
                                    $order->status == 'completed')
                                disabled
                            @endif
                        >CANCEL
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- Logout Modal-->
        <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                    </div>
                    <div class="modal-body">
                        Are you sure you want to cancel this booking?
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{route('order.destroy', $order)}}">
                            @csrf
                            <button type="submit" class="btn btn-danger">YES</button>
                        </form>
                        <button type="button" class="btn btn-info" data-dismiss="modal">NO</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
