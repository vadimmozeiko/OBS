<?php

namespace App\Filters;

class OrderSearchFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('date', 'like', "%$value%")
        ->orWhere('name', 'like', "%$value%")
        ->orWhere('email', 'like', "%$value%")
        ->orWhere('order_number', 'like', "%$value%")
        ->orderBy('date')
        ->paginate(10)
        ->withQueryString();
    }

}
