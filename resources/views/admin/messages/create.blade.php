@extends('layouts.dashboard')

@section('content')

    <h2 class="">Create new message</h2>
    <div class="pl-md-5 pr-md-5 mb-5">

        <form action="{{route('message.sendMessage')}}" method="POST">

            <div style="width: 83%; margin-left: 0;" class="form-group row mt-4">
                <select id="user" class="form-control select-search" name="name">
                    <option value="0" selected>Select user</option>
                    @forelse($users as $user)
                        <option value="{{old('name', $user->name)}}"
                                data-email="{{$user->email}}"
                            {{$user->name == $userName ? 'selected': ''}}
                        >{{$user->name}}</option>
                    @empty
                        <option value="" disabled>No users</option>
                    @endforelse
                </select>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-10 col-form-label text-md-left">To</label>
                <div class="col-md-10">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{old('email')}}">
                    @error('email')
                    <small class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="subject" class="col-md-10 col-form-label text-md-left">Subject</label>
                <div class="col-md-10">
                    <input id="subject" type="text" class="form-control" name="subject"
                           value="{{old('subject')}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="message" class="col-md-10 col-form-label text-md-left">Message</label>
                <div class="col-md-10">
                    <textarea id="message" rows="10" class="form-control @error('message') is-invalid @enderror"
                              name="message">{{old('message')}}</textarea>
                    @error('message')
                    <small class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>

            <button type="submit" class="card-link btn btn-primary btn-m m-1">Send</button>
            @csrf
        </form>
    </div>
    <script>
        $('#user').on('change', function () {
            const user = $(this).children('option:selected').data('email');
            $('#email').val(user);
        });
    </script>
@endsection
