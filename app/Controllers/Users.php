<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index(): string
    {
        $users = (new UserModel())
            ->orderBy('full_name', 'ASC')
            ->findAll();

        return view('users/index', [
            'title'       => 'User Accounts',
            'description' => 'View the user accounts stored in the POS database.',
            'activePage'  => 'users',
            'users'       => $users,
        ]);
    }
}
