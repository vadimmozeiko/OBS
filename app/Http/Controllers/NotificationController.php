<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function index()
    {
        $notifications = Notification::where('status', Notification::STATUS_NEW)->paginate(10);
        return view('admin.notifications.index', ['notifications' => $notifications]);
    }


    public function store(string $event, Order $order)
    {
        $event = '#'. $order->order_number . ' ' . $event . " ($order->updated_at)";
        Notification::create([
            'order_id' => $order->id,
            'event' => $event,
            'status' => Notification::STATUS_NEW
        ]);
    }

    public function seen(Notification $notification)
    {
        $notification->status()->transitionTo('seen');

        return redirect()->route('notifications.index');
    }
}
