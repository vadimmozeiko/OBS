@extends('layouts.dashboard')

@section('content')
    <h2 class="mb-4">Manage messages</h2>
    <div class="justify-content-center pl-md-5 pr-md-5">
            <form action="{{route('message.index')}}">
                <div class="form-group mb-2 d-flex">
                    <input class="form-control" name="search" type="text" value="{{$search}}" placeholder="Quick search...">
                    <button type="submit" class="btn btn-primary mb-2 ml-3">Search</button>
                </div>
            </form>
        @if($messages->isEmpty())
            <div class="d-flex text-center justify-content-center">
                <h2 class="mt-5">No messages</h2>
            </div>
        @else
            <table class="table table-sortable">
                <thead>
                <tr>
                    <th class="mobile-hide" scope="col">@sortablelink('id', '#')</th>
                    <th scope="col">@sortablelink('created_at', 'Date')</th>
                    <th scope="col">@sortablelink('name', 'Name')</th>
                    <th scope="col">@sortablelink('email', 'Email')</th>
                    <th scope="col">@sortablelink('status', 'Status')</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($messages as $message)
                    <tr class="hover-zoom">
                        <td class="mobile-hide">{{$message->id}}</td>
                        <td>{{$message->created_at}}</td>
                        <td>{{$message->name}}</td>
                        <td>{{$message->email}}</td>
                        <td class="mobile-hide">{{$message->status}}</td>
                        <td class="d-flex mobile-hide justify-content-end">
                            <form action="{{route('message.show', $message)}}">
                                <button type="submit" class="card-link btn btn-info btn-sm m-1"
                                >Details
                                </button>
                            </form>
                            <form action="{{route('message.update', $message)}}" method="POST">
                                <input type="hidden" name="status" value="{{\App\Models\Contact::STATUS_READ}}">
                                <button type="submit" class="card-link btn btn-warning btn-sm m-1"
                                        @if($message->status == \App\Models\Contact::STATUS_READ||
                                            $message->status == \App\Models\Contact::STATUS_REPLIED)
                                        disabled
                                    @endif
                                >Mark as read
                                </button>
                                @csrf
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <div class="d-flex justify-content-center">
            {!! $messages->links() !!}
        </div>
@endsection
