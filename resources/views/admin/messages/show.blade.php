@extends('layouts.dashboard')

@section('content')

    <h2 class="">Message #{{$message->id}}</h2>
    <div class="pl-md-5 pr-md-5 mb-5">

        <div class="form-group row">
            <label for="name" class="col-md-10 col-form-label text-md-left">Name</label>

            <div class="col-md-10">
                <input id="name" type="text" class="form-control" name="name" value="{{$message->name}}" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-10 col-form-label text-md-left">Email</label>
            <div class="col-md-10">
                <input id="email" type="email" class="form-control" name="email" value="{{$message->email}}" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label for="message" class="col-md-10 col-form-label text-md-left">Message </label>
            <div class="col-md-10">
                    <textarea rows="6" class="form-control"
                              name="message" disabled>{{$message->message}}</textarea>
            </div>
        </div>
        @if($message->reply)
        <div class="form-group row">
            <label for="message" class="col-md-10 col-form-label text-md-left">Reply </label>
            <div class="col-md-10">
                    <textarea rows="6" class="form-control"
                              name="message" disabled>{{$message->reply}}</textarea>
            </div>
        </div>
        @endif
        <div class="form-group row">
            <label for="status" class="col-md-10 col-form-label text-md-left">Status</label>
            <div class="col-md-10">
                <input id="status" type="text" class="form-control" name="status" value="{{$message->status}}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="received_at" class="col-md-10 col-form-label text-md-left">Received at</label>
            <div class="col-md-10">
                <input id="received_at" type="text" class="form-control" name="created_at" value="{{$message->created_at}}" disabled>
            </div>
        </div>
        @if($message->status == \App\Models\Contact::STATUS_READ)
            <div class="form-group row">
                <label for="read_at" class="col-md-10 col-form-label text-md-left">Read</label>
                <div class="col-md-10">
                    <input id="received_at" type="text" class="form-control" name="read_at" value="{{$message->status()->whenWas('read')}}" disabled>
                </div>
            </div>
        @endif
        @if($message->status == \App\Models\Contact::STATUS_REPLIED)
        <div class="form-group row">
            <label for="received_at" class="col-md-10 col-form-label text-md-left">Replied</label>
            <div class="col-md-10">
                <input id="received_at" type="text" class="form-control" name="created_at" value="{{$message->status()->whenWas('replied')}}" disabled>
            </div>
        </div>
        @endif
        <div class="d-flex">
        <form action="{{route('message.reply', $message)}}">
            <button type="submit" class="card-link btn btn-primary btn-m m-1
                    @if($message->status == \App\Models\Contact::STATUS_REPLIED)
                    d-none
                @endif
            ">Reply
            </button>
        </form>
        <form action="{{route('message.update', $message)}}" method="POST">
            <input type="hidden" name="status" value="{{\App\Models\Contact::STATUS_READ}}">
            <button type="submit" class="card-link btn btn-warning btn-m m-1
                    @if($message->status == \App\Models\Contact::STATUS_READ||
                        $message->status == \App\Models\Contact::STATUS_REPLIED)
                    d-none
                @endif
            ">Mark as read
            </button>
            @csrf
        </form>
        <a class="card-link btn btn-primary m-1"
           href="{{url()->previous()}}">Back</a>
        </div>
    </div>
@endsection
