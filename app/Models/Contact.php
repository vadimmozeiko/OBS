<?php

namespace App\Models;

use App\StateMachines\MessageStatusStateMachine;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    use HasStateMachines;

    protected $guarded = [];


    protected $fillable = [
        'name',
        'email',
        'message',
        'status'
    ];

    public const STATUS_NEW = 'new';
    public const STATUS_READ = 'read';
    public const STATUS_REPLIED = 'replied';


    public const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_READ,
        self::STATUS_REPLIED,
    ];


    public $stateMachines = [
        'status' => MessageStatusStateMachine::class
    ];

    public static function getNumberOfMessages(): int
    {
      return count(Contact::where('status', self::STATUS_NEW)->get());
    }
}
