<?php


namespace App\Repositories;


use App\Models\Statuses;

class StatusRepository extends BaseRepository
{
    public function getUserStatuses()
    {
        return Statuses::query()->take(3)->get();
    }

    public function getOrderStatuses()
    {
       return Statuses::orderBy('id', 'desc')->take(4)->get();
    }
}
