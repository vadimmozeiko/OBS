@extends('layouts.dashboard')

@section('content')
    <h2 class="mb-4">Notifications</h2>
    <div class="justify-content-center pl-md-5 pr-md-5">
        @if($notifications->isEmpty())
            <div class="d-flex text-center justify-content-center">
                <h2 class="mt-5">No notifications</h2>
            </div>
        @else
                @foreach($notifications as $notification)
                <div class="card mb-3">
                    <div class="card-body p-2">
                        <p class="card-text d-inline-block float-left gj-font-size-16 mb-0"><a href="{{route('edit.order', $notification->order_id)}}">{{$notification->event}}</a> </p>
                        <form method="POST" action="{{route('notifications.seen', $notification)}}">
                            <button type="submit" class="btn pt-1 pb-1 btn-outline-success d-inline-block float-right"><i class="fas fa-check"></i></button>
                            @csrf
                        </form>
                    </div>
                </div>
                @endforeach
        @endif
        <div class="d-flex justify-content-center">
            {!! $notifications->links() !!}
        </div>
@endsection
