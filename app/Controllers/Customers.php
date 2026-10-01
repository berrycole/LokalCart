<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customers extends BaseController
{
    public function index(): string
    {
        return view('customers/index', [
            'title' => 'Customer Accounts',
            'description' => 'Manage customer accounts in LokalCart.',
            'activePage' => 'customers',
            'customers' => (new CustomerModel())->orderBy('full_name', 'ASC')->findAll(),
        ]);
    }

    public function new(): string
    {
        return $this->form(null, ['full_name' => '', 'email' => '', 'phone' => '']);
    }

    public function create()
    {
        $values = $this->values();

        if (! $this->validateData($values, $this->rules())) {
            return $this->form(null, $values, $this->validator->getErrors());
        }

        (new CustomerModel())->insert($values + ['created_at' => date('Y-m-d H:i:s')]);

        return redirect()->to(site_url('customers'))->with('success', 'Customer created.');
    }

    public function edit(int $id): string
    {
        return $this->form($id, $this->customer($id));
    }

    public function update(int $id)
    {
        $this->customer($id);
        $values = $this->values();

        if (! $this->validateData($values, $this->rules())) {
            return $this->form($id, $values, $this->validator->getErrors());
        }

        (new CustomerModel())->update($id, $values);

        return redirect()->to(site_url('customers'))->with('success', 'Customer updated.');
    }

    private function customer(int $id): array
    {
        $customer = (new CustomerModel())->find($id);

        if ($customer === null) {
            throw PageNotFoundException::forPageNotFound('Customer not found.');
        }

        return $customer;
    }

    private function values(): array
    {
        return [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => trim((string) $this->request->getPost('phone')),
        ];
    }

    private function rules(): array
    {
        return [
            'full_name' => 'required|max_length[100]',
            'email' => 'required|valid_email|max_length[100]',
            'phone' => 'permit_empty|max_length[30]',
        ];
    }

    private function form(?int $id, array $values, array $errors = []): string
    {
        return view('customers/form', [
            'title' => $id === null ? 'New Customer' : 'Edit Customer',
            'description' => 'Create or update a customer account.',
            'activePage' => 'customers',
            'id' => $id,
            'values' => $values,
            'errors' => $errors,
        ]);
    }
}
