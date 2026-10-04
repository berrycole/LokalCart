<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/** @internal */
final class AuthenticationTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
        $_SESSION = [];
        $db = db_connect();
        $db->query('CREATE TABLE IF NOT EXISTS db_users (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT NOT NULL UNIQUE, full_name TEXT NOT NULL, email TEXT NOT NULL, avatar TEXT NULL, password TEXT NOT NULL, created_at TEXT NOT NULL)');
        $db->query('CREATE TABLE IF NOT EXISTS db_customers (id INTEGER PRIMARY KEY AUTOINCREMENT, full_name TEXT NOT NULL, email TEXT NOT NULL, phone TEXT NOT NULL, created_at TEXT NOT NULL)');
        $db->table('users')->emptyTable();
        $db->table('customers')->emptyTable();
        $db->table('users')->insert([
            'id' => 1, 'username' => 'staff', 'full_name' => 'Store Staff', 'email' => '',
            'password' => password_hash('TestPassword123!', PASSWORD_DEFAULT), 'created_at' => date('Y-m-d H:i:s'),
        ]);
        $db->table('customers')->insert([
            'id' => 1, 'full_name' => 'Test Customer', 'email' => 'customer@example.com', 'phone' => '', 'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public static function protectedRoutes(): array
    {
        return [
            ['GET', '/customers'], ['GET', '/customers/new'], ['GET', '/customers/1/edit'],
            ['GET', '/users'], ['GET', '/users/new'], ['GET', '/users/1/edit'],
            ['POST', '/customers'], ['POST', '/customers/1'], ['POST', '/users'], ['POST', '/users/1'],
        ];
    }

    /** @dataProvider protectedRoutes */
    public function testGuestsCannotAccessAccountRoutes(string $method, string $path): void
    {
        $this->call($method, $path, ['csrf_test_name' => csrf_hash()])->assertRedirectTo(site_url('login'));
        $this->assertSame(1, db_connect()->table('users')->countAllResults());
        $this->assertSame(1, db_connect()->table('customers')->countAllResults());
    }

    public function testValidLoginStoresIdentityWithoutPassword(): void
    {
        $result = $this->post('/login', [
            'csrf_test_name' => csrf_hash(), 'username' => 'staff', 'password' => 'TestPassword123!',
        ]);
        $result->assertRedirectTo(site_url('customers'));
        $this->assertTrue(session('isLoggedIn'));
        $this->assertSame(1, session('user_id'));
        $this->assertSame('staff', session('username'));
        $this->assertNull(session('password'));
    }

    public function testInvalidLoginDoesNotAuthenticateOrEchoPassword(): void
    {
        foreach (['staff', 'unknown'] as $username) {
            $result = $this->post('/login', [
                'csrf_test_name' => csrf_hash(), 'username' => $username, 'password' => 'WrongSecret123!',
            ]);
            $result->assertSee('The username or password is incorrect.');
            $result->assertDontSee('WrongSecret123!');
            $this->assertNotSame(true, session('isLoggedIn'));
        }
    }

    public function testLoggedInStaffCanOpenEveryAccountPage(): void
    {
        foreach (['/customers', '/customers/new', '/customers/1/edit', '/users', '/users/new', '/users/1/edit'] as $path) {
            $result = $this->withSession(['isLoggedIn' => true, 'user_id' => 1, 'username' => 'staff'])->get($path);
            $result->assertStatus(200);
            $result->assertSee('Sign out');
            $this->assertStringContainsString('no-store', $result->response()->getHeaderLine('Cache-Control'));
        }
    }

    public function testLogoutDestroysSessionAndBlocksFurtherAccess(): void
    {
        $this->withSession(['isLoggedIn' => true, 'user_id' => 1, 'username' => 'staff'])
            ->post('/logout', ['csrf_test_name' => csrf_hash()])->assertRedirectTo(site_url('login'));
        $this->assertNotSame(true, session('isLoggedIn'));
        $this->withSession([])->get('/customers')->assertRedirectTo(site_url('login'));
    }

    public function testLogoutCannotBeTriggeredByGet(): void
    {
        $this->expectException(\CodeIgniter\Exceptions\PageNotFoundException::class);
        $this->get('/logout');
    }

    public function testUserPasswordsAreHashedAndBlankEditPreservesHash(): void
    {
        $this->withSession(['isLoggedIn' => true, 'user_id' => 1, 'username' => 'staff']);
        $values = ['username' => 'new.staff', 'full_name' => 'New Staff', 'email' => '', 'password' => 'NewPassword123!'];
        $this->post('/users', $values + ['csrf_test_name' => csrf_hash()])->assertRedirectTo(site_url('users'));
        $user = db_connect()->table('users')->where('username', 'new.staff')->get()->getRowArray();
        $this->assertTrue(password_verify($values['password'], $user['password']));
        $this->assertNotSame($values['password'], $user['password']);
        $values['password'] = '';
        $this->post('/users/' . $user['id'], $values + ['csrf_test_name' => csrf_hash()])->assertRedirectTo(site_url('users'));
        $unchanged = db_connect()->table('users')->where('id', $user['id'])->get()->getRowArray();
        $this->assertSame($user['password'], $unchanged['password']);
        $values['password'] = 'ChangedPassword123!';
        $this->post('/users/' . $user['id'], $values + ['csrf_test_name' => csrf_hash()])->assertRedirectTo(site_url('users'));
        $changed = db_connect()->table('users')->where('id', $user['id'])->get()->getRowArray();
        $this->assertTrue(password_verify($values['password'], $changed['password']));
        $this->assertFalse(password_verify('NewPassword123!', $changed['password']));
    }

    public function testNewUserRequiresPasswordAndDoesNotEchoItOnFailure(): void
    {
        $this->withSession(['isLoggedIn' => true, 'user_id' => 1, 'username' => 'staff']);
        foreach (['', 'short', str_repeat('é', 40), "null\0password"] as $password) {
            $result = $this->post('/users', [
                'csrf_test_name' => csrf_hash(), 'username' => 'new.staff', 'full_name' => 'New Staff', 'email' => '', 'password' => $password,
            ]);
            $result->assertSee('Please correct the highlighted fields');
            $result->assertDontSee('value="short"');
        }
        $this->assertSame(1, db_connect()->table('users')->countAllResults());
    }
}
