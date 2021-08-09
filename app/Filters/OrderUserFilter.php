<?php

namespace App\Filters;

class OrderUserFilter
{
    public function filter($builder, $value)
    {
        return $builder->select('*')->where('user_id', $value)->orderBy('date', 'desc')->get();
    }

}
