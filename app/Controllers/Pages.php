<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index(): string
    {
        return view('pages/home', [
            'title'       => 'Dashboard',
            'description' => 'A clear starting point for the LokalCart point-of-sale system.',
            'activePage'  => 'home',
        ]);
    }

    public function about(): string
    {
        return view('pages/about', [
            'title'       => 'About',
            'description' => 'Learn how this CodeIgniter POS foundation uses routes, controllers, and views.',
            'activePage'  => 'about',
        ]);
    }
}
