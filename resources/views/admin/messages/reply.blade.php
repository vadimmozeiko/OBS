@extends('layouts.dashboard')

@section('content')

    <h2 class="">Reply to message #{{$message->id}}</h2>
    <div class="pl-md-5 pr-md-5 mb-5">

        <form action="{{route('message.sendReply', $message)}}" method="POST">
            <div class="form-group row">
                <label for="to" class="col-md-10 col-form-label text-md-left">To</label>
                <div class="col-md-10">
                    <input id="to" type="text" class="form-control" name="email" value="{{$message->email}}"
                           disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="message" class="col-md-10 col-form-label text-md-left">Message</label>
                <div class="col-md-10">
                    <textarea rows="6" id="message" class="form-control"
                              name="message" disabled>"{{$message->message}}"</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="subject" class="col-md-10 col-form-label text-md-left">Subject</label>
                <div class="col-md-10">
                    <input id="subject" type="text" class="form-control" name="subject"
                           value="Reply to message #{{$message->id}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="answer" class="col-md-10 col-form-label text-md-left">Answer</label>
                <div class="col-md-10">
                    <textarea id="answer" rows="10" class="form-control" name="message"></textarea>
                </div>
            </div>
            <button type="submit" class="card-link btn btn-primary btn-m m-1">Send</button>
            <input type="hidden" name="status" value="{{\App\Models\Contact::STATUS_REPLIED}}">
            @csrf
        </form>
    </div>
@endsection
