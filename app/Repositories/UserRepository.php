<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository extends BaseRepository
{
    public function getAllOrderName()
    {
        return User::orderBy('name')->paginate(10);
    }

    public function getByStatusOrderName(int $status)
    {
        return User::where('status_id', $status)->orderBy('name')->paginate(10)->withQueryString();
    }
}
