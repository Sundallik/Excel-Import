<?php

namespace App\Console\Commands;

use App\Imports\ProjectImport;
use App\Models\Task;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import excel file test';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $task = Task::find(1);
        $task->update(['status' => Task::STATUS_SUCCESS]);
        Excel::import(new ProjectImport($task), 'projects.xlsx', 'public');
    }
}
