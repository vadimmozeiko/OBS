<?php

namespace App\Models;


use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $user_name
 * @property string $user_email
 * @property string $user_phone
 * @property string|null $user_message
 * @property string $date
 * @property string $status
 * @property int|null $user_id
 * @property int|null $product_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product|null $orderProducts
 * @mixin Eloquent
 */
class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'order_number',
        'user_name',
        'user_email',
        'user_phone',
        'user_message',
        'user_address',
        'status_id',
        'date',
        'price',
        'user_id',
        'product_id'
    ];

    public const STATUS_NOT_CONFIRMED = 'not confirmed';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';


    public const STATUSES = [
        self::STATUS_NOT_CONFIRMED,
        self::STATUS_CONFIRMED,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED,
    ];

    public function orderProducts(): BelongsTo
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo('App\Models\Statuses', 'status_id', 'id');
    }

    public function setPriceAttribute($value){
        $value *= 100;
        $this->attributes['price'] = (int)$value;
    }
}
