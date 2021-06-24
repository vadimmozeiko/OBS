@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card text-white mb-3 text-center">
                    <div class="card-header" style="background-color: var(--blue);"></div>
                    <div class="card-body text-center">
                        <div class="justify-content-center">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userOrders as $key => $order)
                                <tr
                                    @if($order->status != 'completed')
                                    style="cursor:pointer; line-height: 3;"
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
