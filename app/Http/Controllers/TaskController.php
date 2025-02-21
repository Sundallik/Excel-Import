<?php

namespace App\Http\Controllers;

use App\Http\Resources\FailedRowResource;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::paginate(10);
        $tasks = TaskResource::collection($tasks);
        return inertia('Task/Index', compact('tasks'));
    }

    public function failedRows(Task $task)
    {
        $failedRows = $task->failedRows()->paginate(10);
        $failedRows = FailedRowResource::collection($failedRows);
        return inertia('Task/FailedRows', compact('failedRows'));
    }
}
