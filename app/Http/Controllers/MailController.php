<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    private Payment $bankDetails;

    public function __construct()
    {
        $this->bankDetails = Payment::all()->first();
    }

    public function notConfirmed($order)
    {
        $date = str_replace('-', '', "$order->date");
        $data = ['order' => $order, 'date' => $date, 'bankDetails' => $this->bankDetails];
        Mail::send('mail.confirmation', $data, function ($message) use ($order) {
            $message->to($order->email, $order->name)->subject
            ('Your booking#' . $order->order_number . ' is pending for approval');
            $message->attach('C:\xampp\htdocs\obs\public\assets\documents\Terms and Conditions.pdf');
            // TODO enable when using Docker Container
//            $message->attach('/var/www/html/public/assets/documents/Terms and Conditions.pdf');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

    public function orderChange(Order $order)
    {
        $data = ['order' => $order];
        Mail::send('mail.change', $data, function ($message) use ($order) {
            $message->to($order->email, $order->name)->subject
            ('Your booking#' . $order->order_number . ' details were changed');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

    public function statusChange(Order $order)
    {
        $data = ['order' => $order];
        Mail::send('mail.change', $data, function ($message) use ($order) {
            $message->to($order->email, $order->name)->subject
            ('Your booking#' . $order->order_number . ' status was changed');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

    public function cancelled(Order $order)
    {
        $data = ['order' => $order];
        Mail::send('mail.cancelled', $data, function ($message) use ($order) {
            $message->to($order->email, $order->name)->subject
            ('Your booking#' . $order->order_number . ' was cancelled');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

    public function register(User $user)
    {
        $data = ['user' => $user];
        Mail::send('mail.register', $data, function ($message) use ($user) {
            $message->to($user->email, $user->name)->subject
            ('Welcome to OBS');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

    public function welcome($user, $products)
    {
        $data = ['user' => $user, 'products' => $products];
        Mail::send('mail.welcome', $data, function ($message) use ($user) {
            $message->to($user['email'], $user['name'])->subject
            ('Welcome to OBS');
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

    public function completed(Order $order, $pdf)
    {
        $data = ['order' => $order];
        Mail::send('mail.completed', $data, function ($message) use ($order, $pdf) {
            $message->to($order->email, $order->name)->subject
            ('Booking #'. $order->order_number . ' ' . 'invoice')->attachData(base64_decode($pdf), "$order->order_number.pdf");
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

    public function sendReply(Contact $contact, Request $request)
    {
        $data = ['details' => $contact, 'request' => $request];
        Mail::send('mail.reply', $data, function ($message) use ($contact, $request) {
            $message->to($contact->email, $contact->name)->subject($request->subject);
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

    public function sendMessage(Request $request)
    {
        $data = ['request' => $request];
        Mail::send('mail.new', $data, function ($message) use ($request) {
            $message->to($request->email, $request->name)->subject($request->subject);
            $message->from(env('MAIL_FROM_ADDRESS'), 'OBS');
        });
    }

}
