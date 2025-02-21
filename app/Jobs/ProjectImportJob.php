<?php

namespace App\Jobs;

use App\Imports\ProjectImport;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Maatwebsite\Excel\Facades\Excel;

class ProjectImportJob implements ShouldQueue
{
    use Queueable;

    private $file;
    private $task;

    /**
     * Create a new job instance.
     */
    public function __construct($file, $task)
    {
        $this->file = $file;
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->task->update(['status' => Task::STATUS_SUCCESS]);
        Excel::import(new ProjectImport($this->task), $this->file->path, 'public');
    }
}
