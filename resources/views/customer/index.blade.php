@extends('layouts.app')

@section('content')
@foreach($customer as $person)
{{$person->name}}
{{$person->email}}
{{$person->created_at}}

@endforeach
@endsection
