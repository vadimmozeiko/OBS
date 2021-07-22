<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository extends BaseRepository
{
    public function getAllOrderName()
    {
        return User::orderBy('name')->paginate(10)->withQueryString();
    }

    public function getByStatusOrderName(int $status)
    {
        return User::where('status_id', $status)->orderBy('name')->paginate(10)->withQueryString();
    }

    public function search(string $search)
    {
        return User::where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();
    }

    public function getAuthUserId()
    {
      return auth()->user()->id;
    }
}
