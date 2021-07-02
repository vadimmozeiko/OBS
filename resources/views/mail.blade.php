<h2>Hi, {{ $data->user_name }}</h2>
<h3>Thank you for booking with us!</h3>
<h4>Your booking details: </h4>
<p><b>Name: </b>{{$data->user_name}}</p>
<p><b>Email: </b>{{$data->user_email}}</p>
<p><b>Date: </b>{{$data->order_date}}</p>
<p><b>Status: </b>Not confirmed</p>
