<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreRequest;
use App\Http\Resources\ProjectResource;
use App\Jobs\ProjectImportJob;
use App\Models\File;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(10);
        $projects = ProjectResource::collection($projects);
        return inertia('Project/Index', compact('projects'));
    }

    public function import()
    {
        return inertia('Project/Import');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $path = Storage::disk('public')->put('files/', $data['file']);
        $file = File::create([
            'name' => $data['file']->getClientOriginalName(),
            'mime' => $data['file']->getClientOriginalExtension(),
            'path' => $path,
        ]);

        $task = Task::create([
            'user_id' => auth()->id(),
            'file_id' => $file->id
        ]);

        ProjectImportJob::dispatchSync($file, $task);
    }
}
