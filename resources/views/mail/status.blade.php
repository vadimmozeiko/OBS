<p>Hi, {{ $order->user_name }}</p>

<h4>Your booking details has been changed: </h4>

<p>{{$order->orderProducts->title}}</p>
<img style="max-width: 200px;" src="{{$order->orderProducts->image}}" alt="product_image">
<p><b>Name: </b>{{$order->user_name}}</p>
<p><b>Email: </b>{{$order->user_email}}</p>
<p><b>Date: </b>{{$order->date}}</p>
<p><b>Status: </b>{{$order->status}}</p>
