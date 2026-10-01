<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/** @internal */
final class AccountFormsTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();

        $db = db_connect();
        $db->query('CREATE TABLE IF NOT EXISTS db_customers (id INTEGER PRIMARY KEY AUTOINCREMENT, full_name TEXT NOT NULL, email TEXT NOT NULL, phone TEXT NOT NULL, created_at TEXT NOT NULL)');
        $db->query('CREATE TABLE IF NOT EXISTS db_users (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT NOT NULL UNIQUE, full_name TEXT NOT NULL, email TEXT NOT NULL, avatar TEXT NULL, created_at TEXT NOT NULL)');
        $db->query('DELETE FROM db_customers');
        $db->query('DELETE FROM db_users');
    }

    public function testNewFormsRenderWithCsrfTokens(): void
    {
        $this->get('/customers/new')->assertSee('Create customer');
        $this->get('/users/new')->assertSee('Create user');
        $this->get('/users/new')->assertSee('csrf_test_name');
    }

    public function testCustomerValidationKeepsEnteredValues(): void
    {
        $result = $this->post('/customers', [
            'csrf_test_name' => csrf_hash(),
            'full_name' => 'Alex Rivera',
            'email' => 'invalid-email',
            'phone' => '1234',
        ]);

        $result->assertStatus(200);
        $result->assertSee('Alex Rivera');
        $result->assertSee('invalid-email');
        $result->assertSee('Please correct the highlighted fields');
        $this->assertSame(0, db_connect()->table('customers')->countAllResults());
    }

    public function testCreateAndEditAccounts(): void
    {
        $customer = $this->post('/customers', [
            'csrf_test_name' => csrf_hash(),
            'full_name' => 'Alex Rivera',
            'email' => 'alex@example.com',
            'phone' => '1234',
        ]);
        $customer->assertRedirect();
        $customerId = db_connect()->table('customers')->get()->getRowArray()['id'];

        $this->get('/customers/' . $customerId . '/edit')->assertSee('alex@example.com');
        $this->post('/customers/' . $customerId, [
            'csrf_test_name' => csrf_hash(),
            'full_name' => 'Alex Rivera',
            'email' => 'alex.updated@example.com',
            'phone' => '1234',
        ])->assertRedirect();
        $this->assertSame('alex.updated@example.com', db_connect()->table('customers')->get()->getRowArray()['email']);

        $this->post('/users', [
            'csrf_test_name' => csrf_hash(),
            'username' => 'alex',
            'full_name' => 'Alex Rivera',
            'email' => 'alex@example.com',
        ])->assertRedirect();
        $userId = db_connect()->table('users')->get()->getRowArray()['id'];
        $this->get('/users/' . $userId . '/edit')->assertSee('Profile picture');
        $this->post('/users/' . $userId, [
            'csrf_test_name' => csrf_hash(),
            'username' => 'alex',
            'full_name' => 'Alex R.',
            'email' => 'alex@example.com',
        ])->assertRedirect();
        $this->assertSame('Alex R.', db_connect()->table('users')->get()->getRowArray()['full_name']);
    }

    public function testDuplicateUsernameIsRejected(): void
    {
        db_connect()->table('users')->insert([
            'username' => 'alex', 'full_name' => 'Alex', 'email' => '', 'created_at' => date('Y-m-d H:i:s'),
        ]);

        $result = $this->post('/users', [
            'csrf_test_name' => csrf_hash(),
            'username' => 'alex',
            'full_name' => 'Another Alex',
            'email' => '',
        ]);

        $result->assertStatus(200);
        $result->assertSee('Another Alex');
        $result->assertSee('Please correct the highlighted fields');
        $this->assertSame(1, db_connect()->table('users')->countAllResults());
    }
}
