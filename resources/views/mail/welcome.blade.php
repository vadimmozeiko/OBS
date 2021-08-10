@extends('layouts.mail')

@section('content')
    <td style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';max-width:100vw;padding:32px">
        <p style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';color:#3d4852;font-size:18px;font-weight:bold;margin-top:0;text-align:center">
            Hello,{{ $user['name'] }}!</p>
        <p style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:center">
            <b>Thanks for signing up with us!</b></p>
        <p style="text-align:center; box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;">
            <b>Start exploring our products</b></p>
        @foreach($products as $product)
            <tr style="width:100%; text-align:center">
                <td>
                    <h4>{{$product->title}}</h4>
                    <img style="width: 200px;" src="{{$product->image}}" alt="product image">
                </td>
            </tr>
        @endforeach
    </td>
@endsection


