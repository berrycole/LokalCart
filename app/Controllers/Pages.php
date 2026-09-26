<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Pages extends BaseController
{
    public function index(): string
    {
        $today = date('Y-m-d');
        $tasks = (new TaskModel())->where('task_date', $today)->orderBy('created_at', 'ASC')->findAll();

        return view('pages/home', [
            'title'       => 'Tasks for Today',
            'description' => 'A focused view of tasks scheduled for today.',
            'activePage'  => 'home',
            'tasks'       => $tasks,
            'today'       => $today,
            'tasks'       => $tasks,
            'today'       => $today,
        ]);
    }

    public function about(): string
    {
        return view('pages/about', [
            'title'       => 'About',
            'description' => 'Learn about the Tasks for Today Management System and its developer.',
            'activePage'  => 'about',
        ]);
    }
}

