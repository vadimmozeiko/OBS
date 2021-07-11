@extends('admin.dashboard')

@section('content')

    <div class="justify-content-center pl-md-5 pr-md-5">
        <form class="mb-4" action="{{route('list.user')}}" method="GET">
            <span class="input-group-addon" id="basic-addon1">Filter by status</span>
            <select class="form-control mb-3" name="user_status">
                <option value="0">All</option>
                @foreach($statuses as $status)
                    <option value="{{$status->id}}" {{$userStatus == $status->id ? 'selected': ''}}>
                        {{$status->status}}</option>
                @endforeach
            </select>
            <button class="btn btn-info">Filter</button>
            <a href="{{route('list.user')}}" class="btn btn-info">Reset</a>
        </form>
        <div class="form-outline mb-2">
            <input name="search" type="text" id="search-field" class="form-control" placeholder="Search...">
        </div>
        <table class="table table-sortable">
            <thead>
            <tr>
                <th class="sort-order sortable mobile-hide" scope="col"># <i class="order fas fa-sort-numeric-up"></i>
                </th>
                <th class="sort-date sortable" scope="col">Name <i class="date fas fa-sort-numeric-up"></i>
                </th>
                <th class="sort-name sortable mobile-hide" scope="col">Email <i class="name fas fa-sort-alpha-up"></i>
                </th>
                <th class="sort-title sortable" scope="col">Address <i class="title fas fa-sort-alpha-up"></i></th>
                <th class="sort-status sortable mobile-hide" scope="col">Phone <i
                        class="status fas fa-sort-alpha-up"></i></th>
                <th class="sort-title sortable" scope="col">Status <i class="title fas fa-sort-alpha-up"></i></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="hover-zoom">
                    <td class="mobile-hide">{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td class="mobile-hide">{{$user->email}}</td>
                    <td>{{$user->address}}</td>
                    <td class="mobile-hide">{{$user->phone}}</td>
                    <td class="mobile-hide">{{$user->userStatus->status}}</td>
                    <td class="d-flex mobile-hide justify-content-end">
                        <form action="{{route('edit.order', $user)}}">
                            <button type="submit" class="card-link btn btn-info btn-sm m-1"
                            >Details
                            </button>
                            @csrf
                        </form>
                        {{--                        <form method="POST" action="{{route('change.order', $order)}}">--}}
                        {{--                            <button type="submit" class="card-link btn btn-primary btn-sm m-1"--}}
                        {{--                                    @if($order->status_id == '4' ||--}}
                        {{--                                        $order->status_id == '5' ||--}}
                        {{--                                        $order->status_id == '6')--}}
                        {{--                                    disabled--}}
                        {{--                                @endif--}}
                        {{--                            >Confirm--}}
                        {{--                            </button>--}}
                        {{--                            <input type="hidden" name="status_id" value="4">--}}
                        {{--                            @csrf--}}
                        {{--                        </form>--}}
                        {{--                        <form method="POST" action="{{route('change.order', $order)}}">--}}
                        {{--                            <button type="submit" class="card-link btn btn-success btn-sm m-1"--}}
                        {{--                                    @if($order->status_id == '3' ||--}}
                        {{--                                        $order->status_id == '5' ||--}}
                        {{--                                        $order->status_id == '6')--}}
                        {{--                                    disabled--}}
                        {{--                                @endif>Complete--}}
                        {{--                            </button>--}}
                        {{--                            <input type="hidden" name="status_id" value="5">--}}
                        {{--                            @csrf--}}
                        {{--                        </form>--}}
                        {{--                        <form method="POST" action="{{route('change.order', $order)}}">--}}
                        {{--                            <button type="submit" class="card-link btn btn-danger btn-sm m-1"--}}
                        {{--                                    @if($order->status_id == '5' ||--}}
                        {{--                                        $order->status_id == '6')--}}
                        {{--                                    disabled--}}
                        {{--                                @endif>CANCEL--}}
                        {{--                            </button>--}}
                        {{--                            <input type="hidden" name="status_id" value="6">--}}
                        {{--                            @csrf--}}
                        {{--                        </form>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <script src="{{ asset('js/app.js') }}"></script>
@endsection
