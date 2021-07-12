@extends('admin.dashboard')

@section('content')
    <div class="justify-content-center pl-md-5 pr-md-5">
        <h2 class="">New orders</h2>
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
            @foreach($notConfirmed as $order)
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
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <script src="{{ asset('js/app.js') }}"></script>
@endsection
