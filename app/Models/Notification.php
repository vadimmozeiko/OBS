<?php

namespace App\Models;

use App\StateMachines\NotificationStatusStateMachine;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    use HasStateMachines;

    protected $guarded = [];


    protected $fillable = [
        'order_id',
        'event',
        'status',
    ];

    public const STATUS_NEW = 'new';
    public const STATUS_SEEN = 'seen';


    public const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_SEEN,
    ];


    public $stateMachines = [
        'status' => NotificationStatusStateMachine::class
    ];

    public static function getNumberOfNotifications(): int
    {
        return count(Notification::where('status', self::STATUS_NEW)->get());
    }
}
