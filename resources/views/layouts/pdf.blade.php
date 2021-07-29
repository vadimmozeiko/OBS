{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>{{$order->order_number}}</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--<h1>Booking #{{$order->order_number}} invoice</h1>--}}
{{--<p>Report date: {{$time}}</p>--}}
{{--<h3>{{$order->name}}</h3>--}}
{{--<p> Phone no: <b>{{$order->phone}}</b></p>--}}
{{--<p> Email: <b>{{$order->email}}</b></p>--}}
{{--<p> Price: <b>{{$order->price / 100}} Eur</b></p>--}}
{{--</body>--}}
{{--</html>--}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img style="width: 100px; height: 100px;" src="https://i.ibb.co/zXv8ddR/Online-Booking-System-logos-transparent.png" alt="Online-Booking-System-logos-transparent" border="0">
                        </td>

                        <td>
                            Invoice #: {{$order->order_number}}<br />
                            Created: {{$time}}<br />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            OBS, Inc.<br />
                            12345 Sunny Road<br />
                            Sunnyville, CA 12345
                        </td>

                        <td style="width: 50%;">
                            {{$order->name}}<br />
                            {{$order->email}}<br />
                            {{$order->address}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Payment Method</td>

            <td></td>
        </tr>

        <tr class="details">
            <td>Bank transfer</td>

            <td>{{$order->price / 100}} Eur</td>
        </tr>

        <tr class="heading">
            <td>Item</td>

            <td>Price</td>
        </tr>

        <tr class="item">
            <td>{{$order->orderProducts->title}}</td>

            <td>{{$order->price / 100}} Eur</td>
        </tr>

        <tr class="total">
            <td></td>

            <td>Total: {{$order->price / 100}} Eur</td>
        </tr>
    </table>
</div>
</body>
</html>
