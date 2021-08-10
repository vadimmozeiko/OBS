<?php

namespace App\Models;

use App\StateMachines\ProductStatusStateMachine;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $image
 * @property string $category
 * @property string $title
 * @property string $price
 * @property string $short_description
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at

 * @mixin Eloquent
 */
class Product extends Model
{
    use HasFactory;
    use HasStateMachines;

    protected $guarded = [];

    protected $fillable = [
        'image',
        'category',
        'title',
        'price',
        'description',
        'status'
    ];

    public const STATUS_AVAILABLE = 'available';
    public const STATUS_UNAVAILABLE = 'unavailable';
    public const STATUS_BROKEN= 'broken';


    public const STATUSES = [
        self::STATUS_AVAILABLE,
        self::STATUS_UNAVAILABLE,
        self::STATUS_BROKEN,
    ];

    public array $stateMachines = [
        'status' => ProductStatusStateMachine::class
    ];

    public function setPriceAttribute($value){
        $value *= 100;
        $this->attributes['price'] = (int)$value;
    }

}
