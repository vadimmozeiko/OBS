<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function notConfirmed($order)
    {
        $date = str_replace('-', '', "$order->date");
        $data = ['order' => $order, 'date' => $date];
        Mail::send('mail.confirmation', $data, function ($message) use ($order) {
            $message->to(Auth::user()->email, Auth::user()->name)->subject
            ('Your booking#' . $order->id . ' is pending for approval');
            $message->attach('/var/www/html/public/assets/documents/Terms and Conditions.pdf');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

    public function orderChange(Order $order)
    {
        $data = ['name' => Auth::user()->name, 'order' => $order];
        Mail::send('mail.change', $data, function ($message) use ($order) {
            $message->to(Auth::user()->email, Auth::user()->name)->subject
            ('Your booking#' . $order->id . ' details was changed');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

    public function statusChange(Order $order)
    {
        $data = ['name' => Auth::user()->name, 'order' => $order];
        Mail::send('mail.change', $data, function ($message) use ($order) {
            $message->to(Auth::user()->email, Auth::user()->name)->subject
            ('Your booking#' . $order->id . ' status was changed');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

}
