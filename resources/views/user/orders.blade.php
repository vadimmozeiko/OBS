@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card text-white mb-3 text-center">
                    <div class="card-header" style="background-color: var(--blue);"></div>
                    <div class="card-body text-center">
                        <div class="justify-content-center">
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
                                            {{$order->status == 'completed' ? 'disabled' : ''}}
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
