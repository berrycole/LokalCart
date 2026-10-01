<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Throwable;

class Users extends BaseController
{
    public function index(): string
    {
        return view('users/index', [
            'title' => 'User Accounts',
            'description' => 'Manage user accounts in LokalCart.',
            'activePage' => 'users',
            'users' => (new UserModel())->orderBy('full_name', 'ASC')->findAll(),
        ]);
    }

    public function new(): string
    {
        return $this->form(null, ['username' => '', 'full_name' => '', 'email' => '', 'avatar' => null]);
    }

    public function create()
    {
        $values = $this->values();

        if (! $this->validateData($values, $this->rules())) {
            return $this->form(null, $values, $this->validator->getErrors());
        }

        (new UserModel())->insert($values + ['created_at' => date('Y-m-d H:i:s')]);

        return redirect()->to(site_url('users'))->with('success', 'User created.');
    }

    public function edit(int $id): string
    {
        return $this->form($id, $this->user($id));
    }

    public function update(int $id)
    {
        $existing = $this->user($id);
        $values = $this->values();
        $values['avatar'] = $existing['avatar'];
        $file = $this->request->getFile('avatar');
        $hasUpload = $file !== null && $file->getError() !== UPLOAD_ERR_NO_FILE;
        if (! $this->validateData($values, $this->rules($id))) {
            return $this->form($id, $values, $this->validator->getErrors());
        }

        if ($hasUpload && ! $this->validate([
            'avatar' => 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpeg,image/png]|max_size[avatar,2048]',
        ])) {
            return $this->form($id, $values, $this->validator->getErrors());
        }

        $newAvatar = null;

        if ($hasUpload) {
            try {
                $directory = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';

                if (! is_dir($directory) && ! mkdir($directory, 0755, true) && ! is_dir($directory)) {
                    throw new \RuntimeException('Unable to create the avatar directory.');
                }

                $extension = $file->getMimeType() === 'image/png' ? 'png' : 'jpg';
                $newAvatar = bin2hex(random_bytes(16)) . '.' . $extension;
                $path = $directory . DIRECTORY_SEPARATOR . $newAvatar;

                if (! service('image')->withFile($file->getTempName())->fit(256, 256)->save($path)) {
                    throw new \RuntimeException('Unable to save the prepared avatar.');
                }

                $values['avatar'] = $newAvatar;
            } catch (Throwable $exception) {
                if ($newAvatar !== null && is_file($directory . DIRECTORY_SEPARATOR . $newAvatar)) {
                    unlink($directory . DIRECTORY_SEPARATOR . $newAvatar);
                }

                log_message('error', 'Avatar preparation failed: {message}', ['message' => $exception->getMessage()]);

                $values['avatar'] = $existing['avatar'];

                return $this->form($id, $values, ['avatar' => 'The image could not be prepared. Please try another JPG or PNG.']);
            }
        }

        $model = new UserModel();

        if (! $model->update($id, $values)) {
            if ($newAvatar !== null) {
                unlink($directory . DIRECTORY_SEPARATOR . $newAvatar);
            }

            $values['avatar'] = $existing['avatar'];

            return $this->form($id, $values, $model->errors());
        }

        if ($newAvatar !== null && ! empty($existing['avatar'])) {
            $oldPath = $directory . DIRECTORY_SEPARATOR . basename($existing['avatar']);

            if (is_file($oldPath)) {
                unlink($oldPath);
            }
        }

        return redirect()->to(site_url('users'))->with('success', 'User updated.');
    }

    private function user(int $id): array
    {
        $user = (new UserModel())->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User not found.');
        }

        return $user;
    }

    private function values(): array
    {
        return [
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email' => trim((string) $this->request->getPost('email')),
        ];
    }

    private function rules(?int $id = null): array
    {
        $unique = $id === null ? 'is_unique[users.username]' : 'is_unique[users.username,id,' . $id . ']';

        return [
            'username' => 'required|max_length[50]|' . $unique,
            'full_name' => 'required|max_length[100]',
            'email' => 'permit_empty|valid_email|max_length[100]',
        ];
    }

    private function form(?int $id, array $values, array $errors = []): string
    {
        return view('users/form', [
            'title' => $id === null ? 'New User' : 'Edit User',
            'description' => 'Create or update a user account.',
            'activePage' => 'users',
            'id' => $id,
            'values' => $values,
            'errors' => $errors,
        ]);
    }
}
