<?php


namespace App\Repositories;


use App\Models\Statuses;

class StatusRepository extends BaseRepository
{
    public function getUserStatuses()
    {
        return Statuses::query()->take(2)->get();
    }

    public function getOrderStatuses()
    {
       return Statuses::orderBy('id', 'desc')->take(5)->get();
    }
}
