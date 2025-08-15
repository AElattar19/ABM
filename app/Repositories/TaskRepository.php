<?php

namespace App\Repositories;

use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Models\Task; // Assumption: You have a Model with the same name

class TaskRepository implements TaskRepositoryInterface
{
    public function getAllByUser($userId, $perPage = 10)
    {
        return Task::where('user_id', $userId)->paginate($perPage);
    }

    public function getById($id)
    {
        return Task::find($id);
    }

    public function create(array $attributes)
    {
        return Task::create($attributes);
    }

    public function update($id, array $attributes)
    {
        $record = Task::find($id);
        if ($record) {
            $record->update($attributes);
            return $record;
        }
        return null;
    }

    public function delete($id)
    {
        $record = Task::find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }
}
