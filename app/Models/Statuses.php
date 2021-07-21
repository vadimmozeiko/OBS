<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $status
 */

class Statuses extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const STATUS_NEW = 'new';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_DELETED = 'deleted';
    public const STATUS_NOT_CONFIRMED = 'not confirmed';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';



    public const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_ACTIVE,
        self::STATUS_DELETED,
        self::STATUS_NOT_CONFIRMED,
        self::STATUS_CONFIRMED,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED,
    ];
}
