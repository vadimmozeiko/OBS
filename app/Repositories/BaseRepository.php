<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

class BaseRepository
{
    public function getAll($model): Collection|array
    {
        return $model::all();
    }

    public function getByStatus($model, int $status): Collection|array
    {
        return $model::where('status_id', $status)->get();
    }

    public function getByUser($model, int $userId): Collection|array
    {
        return $model::where('user_id', $userId)->get();
    }



}
