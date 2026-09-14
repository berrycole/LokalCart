<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index(): string
    {
        $customers = [
            ['fullName' => 'Mikaela Santos', 'email' => 'mikaela.santos@example.com', 'phone' => '+63 917 420 1842'],
            ['fullName' => 'Paolo Reyes', 'email' => 'paolo.reyes@example.com', 'phone' => '+63 918 735 2096'],
            ['fullName' => 'Alyssa Lim', 'email' => 'alyssa.lim@example.com', 'phone' => '+63 905 641 3378'],
            ['fullName' => 'Gabriel Cruz', 'email' => 'gabriel.cruz@example.com', 'phone' => '+63 927 116 8504'],
            ['fullName' => 'Nicole Mendoza', 'email' => 'nicole.mendoza@example.com', 'phone' => '+63 916 802 4791'],
            ['fullName' => 'Andre Villanueva', 'email' => 'andre.villanueva@example.com', 'phone' => '+63 998 253 6610'],
        ];

        return view('customers/index', [
            'title'       => 'Customer Accounts',
            'description' => 'View the customer directory used by the POS foundation.',
            'activePage'  => 'customers',
            'customers'   => $customers,
        ]);
    }
}
