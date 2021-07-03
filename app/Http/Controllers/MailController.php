<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function notConfirmed(Request $request)
    {

        $data = ['data' => $request];
        Mail::send('mail.confirmation', $data, function ($message) {
            $message->to(Auth::user()->email, Auth::user()->name)->subject
            ('Your booking is pending for approval');
//            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
//            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
//        echo "Email Sent with attachment. Check your inbox.";
    }

    public function statusChange(Order $order)
    {

        $data = ['name' => Auth::user()->name, 'order' => $order];
        Mail::send('mail.status', $data, function ($message) {
            $message->to(Auth::user()->email, Auth::user()->name)->subject
            ('Your booking was changed');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
//        echo "HTML Email Sent. Check your inbox.";
    }

}
