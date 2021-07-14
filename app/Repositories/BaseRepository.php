<?php


namespace App\Repositories;


class BaseRepository
{
    public function getAll($model)
    {
        return $model::paginate(10);
    }

    public function getByStatus($model, int $status)
    {
        return $model::where('status_id', $status)->paginate(10);
    }

    public function getByUser($model, int $userId)
    {
        return $model::select('*')->where('user_id', $userId)->orderBy('date', 'desc')->paginate(10);
    }

}
