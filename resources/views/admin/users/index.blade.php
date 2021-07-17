@extends('admin.dashboard')

@section('content')
    <h2 class="">Manage users</h2>
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
        <form action="{{route('list.user')}}">
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
                <th class="sort-date sortable" scope="col">Name <i class="date fas fa-sort-numeric-up"></i>
                </th>
                <th class="sort-name sortable mobile-hide" scope="col">Email <i class="name fas fa-sort-alpha-up"></i>
                </th>
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
                    <td class="mobile-hide">{{$user->userStatus->status}}</td>
                    <td class="d-flex mobile-hide justify-content-end">
                        <form action="{{route('edit.user', $user)}}">
                            <button type="submit" class="card-link btn btn-info btn-sm m-1"
                            >Details
                            </button>
                        </form>
                        <form method="POST" action="{{route('pass.reset', $user)}}">
                            <button type="submit" class="card-link btn btn-warning btn-sm m-1"
                                {{$user->status_id == 3 ? 'disabled' : ''}}
                            >Reset Password
                            </button>
                            @csrf
                        </form>
                        <form method="POST" action="{{route('login.as', $user)}}">
                            <button type="submit" class="card-link btn btn-dark btn-sm m-1"
                                {{$user->status_id == 3 ? 'disabled' : ''}}
                            >Login As
                            </button>
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $users->appends(['user_status' => $userStatus])->links() !!}
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
@endsection
