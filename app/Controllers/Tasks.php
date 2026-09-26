<?php
namespace App\Controllers;
use App\Models\TaskModel;
class Tasks extends BaseController
{
    public function index(): string
    {
        $tasks = (new TaskModel())->orderBy('task_date', 'ASC')->orderBy('created_at', 'ASC')->findAll();
        return view('tasks/index', ['title' => 'Task List', 'description' => 'Every task stored in the Tasks for Today database.', 'activePage' => 'tasks', 'tasks' => $tasks]);
    }
}
