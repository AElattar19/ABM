<?php

namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface
{
    public function getAllByUser($userId);
    public function getById($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
}
