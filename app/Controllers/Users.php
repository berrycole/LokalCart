<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index(): string
    {
        $users = [
            ['username' => 'admin.ramos', 'fullName' => 'Elena Ramos', 'role' => 'Administrator'],
            ['username' => 'manager.dizon', 'fullName' => 'Carlo Dizon', 'role' => 'Store Manager'],
            ['username' => 'cashier.ong', 'fullName' => 'Sofia Ong', 'role' => 'Cashier'],
            ['username' => 'cashier.flores', 'fullName' => 'Miguel Flores', 'role' => 'Cashier'],
            ['username' => 'stock.garcia', 'fullName' => 'Bea Garcia', 'role' => 'Inventory Clerk'],
            ['username' => 'support.tan', 'fullName' => 'Luis Tan', 'role' => 'Support Staff'],
        ];

        return view('users/index', [
            'title'       => 'User Accounts',
            'description' => 'View the staff members and roles assigned to the POS foundation.',
            'activePage'  => 'users',
            'users'       => $users,
        ]);
    }
}
