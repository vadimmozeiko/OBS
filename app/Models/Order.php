<?php

namespace App\Models;


use App\Filters\OrderFilter;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Kyslik\ColumnSortable\Sortable;

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
    use Sortable;

    protected $guarded = [];

    public function scopeFilter(Builder $builder, $request): Builder
    {
        return (new OrderFilter($request))->filter($builder);
    }

    protected $fillable = [
        'order_number',
        'name',
        'email',
        'phone',
        'message',
        'address',
        'status',
        'date',
        'price',
        'user_id',
        'product_id',
        'invoice'
    ];

    public $sortable = [
        'order_number',
        'product_id',
        'name',
        'email',
        'phone',
        'address',
        'date',
        'status'];

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

    public function setPriceAttribute($value){
        $value *= 100;
        $this->attributes['price'] = (int)$value;
    }

    public static function getNumberOfNewOrders(): int
    {
        return count(Order::where('status', self::STATUS_NOT_CONFIRMED)->get());
    }
}
