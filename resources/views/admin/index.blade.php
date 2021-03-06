@extends('layouts.dashboard')

@section('content')
    <h2 class="mb-4">New bookings</h2>
    <div class="justify-content-center pl-md-5 pr-md-5">
        @if($notConfirmed->isEmpty())
            <div class="d-flex text-center justify-content-center">
                <h2 class="mt-5">No new bookings</h2>
            </div>
        @else
            <table class="table table-sortable">
                <thead>
                <tr>
                    <th class="mobile-hide" scope="col">@sortablelink('order_number', '#')</th>
                    <th scope="col">@sortablelink('date', 'Date')</th>
                    <th class="mobile-hide" scope="col">@sortablelink('name', 'Name')</th>
                    <th scope="col">@sortablelink('product_id', 'Product')</th>
                    <th class="mobile-hide" scope="col">@sortablelink('status', 'Status')</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($notConfirmed as $order)
                    <tr class="hover-zoom">
                        <td class="mobile-hide">{{$order->order_number}}</td>
                        <td>{{$order->date}}</td>
                        <td class="mobile-hide">{{$order->name}}</td>
                        <td>{{$order->orderProducts->title}}</td>
                        <td class="mobile-hide">{{$order->status}}</td>
                        <td class="d-flex mobile-hide justify-content-end">
                            <form action="{{route('edit.order', $order)}}">
                                <button type="submit" class="card-link btn btn-info btn-sm m-1"
                                >Details
                                </button>
                            </form>
                            <form method="POST" action="{{route('change.order', $order)}}">
                                <button type="submit" class="card-link btn btn-primary btn-sm m-1"
                                        @if($order->status_id == \App\Models\Order::STATUS_CONFIRMED ||
                                            $order->status_id == \App\Models\Order::STATUS_COMPLETED ||
                                            $order->status_id == \App\Models\Order::STATUS_CANCELLED)
                                        disabled
                                    @endif
                                >Confirm
                                </button>
                                <input type="hidden" name="status" value="{{\App\Models\Order::STATUS_CONFIRMED}}">
                                @csrf
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <div class="d-flex justify-content-center">
            {!! $notConfirmed->links() !!}
        </div>
@endsection
