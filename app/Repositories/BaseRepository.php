<?php


namespace App\Repositories;


class BaseRepository
{
    public function getAll($model)
    {
        return $model::paginate(10)->withQueryString();
    }

    public function getByStatus($model, string $status)
    {
        return $model::where('status', $status)->paginate(10)->withQueryString();
    }

    public function getByUser($model, int $userId)
    {
        return $model::select('*')->where('user_id', $userId)->orderBy('date', 'desc')->paginate(10)->withQueryString();
    }

}
