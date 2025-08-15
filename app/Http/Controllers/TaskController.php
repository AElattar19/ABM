<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskController extends Controller
{
private TaskRepositoryInterface $TaskRepository;
    
    public function __construct(TaskRepositoryInterface $TaskRepository)
    {
        $this->TaskRepository = $TaskRepository;
    }


    public function index()
    {
             try {
                $userId = auth()->id();
             $all_task = $this->TaskRepository->getAllByUser($userId);
                   return TaskResource::collection($all_task);
               } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' =>  $e->getMessage()
            ], 500);
        }

    }

    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $task = $this->TaskRepository->create($data);

        return new TaskResource($task);

    }

    public function update(TaskRequest $request, $taskId)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $task = $this->TaskRepository->update((int) $taskId, $data);

        if (!$task) {
            return response()->json([
                'status' => false,
                'message' => 'Task not found'
            ], 404);
        }

        return new TaskResource($task);
    }

    public function destroy($itemId)
    {
        try {
            $item = $this->TaskRepository->delete($itemId);
            if (!$item) {
                return response()->json([
                    'status' => false,
                    'message' => 'Item not found'
                ], 404);
            }


            return response()->json([
                'status' => true,
                'message' => 'Item removed from task'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' =>  $e->getMessage()
            ], 500);
        }
    }

}
