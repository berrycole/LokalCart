<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session('isLoggedIn') === true) {
            return redirect()->to(site_url('customers'));
        }

        return $this->form();
    }

    public function authenticate()
    {
        $values = [
            'username' => trim((string) $this->request->getPost('username')),
            'password' => (string) $this->request->getPost('password'),
        ];

        if (! $this->validateData($values, [
            'username' => 'required|max_length[50]',
            'password' => 'required|max_length[72]|passwordBytes',
        ])) {
            return $this->form($values['username'], 'Enter your username and password.');
        }

        $user = (new UserModel())->where('username', $values['username'])->first();

        if ($user === null || ! password_verify($values['password'], $user['password'])) {
            return $this->form($values['username'], 'The username or password is incorrect.');
        }

        // Replace the pre-login session ID to prevent session fixation.
        session()->regenerate(true);
        session()->set([
            'isLoggedIn' => true,
            'user_id' => (int) $user['id'],
            'username' => $user['username'],
            'full_name' => $user['full_name'],
        ]);

        return redirect()->to(site_url('customers'));
    }

    public function logout()
    {
        session()->remove(['isLoggedIn', 'user_id', 'username', 'full_name']);
        session()->destroy();

        return redirect()->to(site_url('login'));
    }

    private function form(string $username = '', ?string $error = null): string
    {
        $this->response->setHeader('Cache-Control', 'no-store, private');

        return view('auth/login', [
            'title' => 'Staff Login',
            'description' => 'Sign in to manage LokalCart customer and user accounts.',
            'activePage' => 'login',
            'username' => $username,
            'error' => $error,
        ]);
    }
}
