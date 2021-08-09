<?php

namespace App\Filters;

class OrderStatusFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('status', $value)->get();
    }

}
