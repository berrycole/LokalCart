<?php
namespace App\Controllers;
use App\Models\UserModel;
class Profile extends BaseController
{
    public function index(): string
    {
        $user = (new UserModel())->orderBy('id', 'ASC')->first();
        return view('profile/index', ['title' => 'Profile', 'description' => 'The demo user profile for the Tasks for Today system.', 'activePage' => 'profile', 'user' => $user]);
    }
}
