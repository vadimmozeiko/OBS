<?php

namespace App\Filters;

class OrderFilter extends AbstractFilter
{
    protected array $filters = [
        'order_status' => OrderStatusFilter::class,
        'user_id' => OrderUserFilter::class,
        'product' => OrderProductFilter::class,
        'search' => OrderSearchFilter::class
    ];
}
