<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index(): string
    {
        $customers = (new CustomerModel())
            ->orderBy('full_name', 'ASC')
            ->findAll();

        return view('customers/index', [
            'title'       => 'Customer Accounts',
            'description' => 'View the customer directory stored in the POS database.',
            'activePage'  => 'customers',
            'customers'   => $customers,
        ]);
    }
}
