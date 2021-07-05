<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function notConfirmed($order)
    {

        $data = ['order' => $order];
        Mail::send('mail.confirmation', $data, function ($message) {
            $message->to(Auth::user()->email, Auth::user()->name)->subject
            ('Your booking is pending for approval');
            $message->attach('/var/www/html/public/assets/documents/Terms and Conditions.pdf');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

    public function orderChange(Order $order)
    {

        $data = ['name' => Auth::user()->name, 'order' => $order];
        Mail::send('mail.change', $data, function ($message) {
            $message->to(Auth::user()->email, Auth::user()->name)->subject
            ('Your booking details was changed');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

    public function statusChange(Order $order)
    {

        $data = ['name' => Auth::user()->name, 'order' => $order];
        Mail::send('mail.change', $data, function ($message) {
            $message->to(Auth::user()->email, Auth::user()->name)->subject
            ('Your booking status was changed');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

}
