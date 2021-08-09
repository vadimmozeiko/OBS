<?php

namespace App\Filters;

class OrderProductFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('product_id', $value)->get();
    }

}
