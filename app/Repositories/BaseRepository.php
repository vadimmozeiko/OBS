<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

class BaseRepository
{
    public function getAll($model)
    {
        return $model::paginate(10);
    }

    public function getByStatus($model, int $status)
    {
        // TODO pagination added here
        return $model::where('status_id', $status)->paginate(10);
    }

    public function getByUser($model, int $userId)
    {
        return $model::where('user_id', $userId)->paginate(10);
    }



}
