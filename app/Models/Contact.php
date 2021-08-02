<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $fillable = [
        'name',
        'email',
        'message',
        'status'
    ];

    public const STATUS_NEW = 'new';
    public const STATUS_READ = 'read';
    public const STATUS_COMPLETED = 'completed';


    public const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_READ,
        self::STATUS_COMPLETED,
    ];
}
