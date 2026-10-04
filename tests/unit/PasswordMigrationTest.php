<?php

use App\Database\Migrations\AddUserPasswords;
use CodeIgniter\Test\CIUnitTestCase;

/** @internal */
final class PasswordMigrationTest extends CIUnitTestCase
{
    public function testUpgradePreservesRecordsAndExistingHashes(): void
    {
        require_once APPPATH . 'Database/Migrations/2026-10-04-000001_AddUserPasswords.php';
        $db = db_connect();
        $forge = \Config\Database::forge();
        $forge->dropTable('users', true);
        $db->query('CREATE TABLE db_users (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT NOT NULL, full_name TEXT NOT NULL)');
        $db->table('users')->insertBatch([
            ['username' => 'first', 'full_name' => 'First Staff'],
            ['username' => 'second', 'full_name' => 'Second Staff'],
        ]);
        $db->query('CREATE UNIQUE INDEX users_username_unique ON db_users (username)');
        $before = $db->table('users')->get()->getResultArray();
        $migration = new AddUserPasswords($forge);
        $migration->up();
        $after = $db->table('users')->get()->getResultArray();
        foreach ($after as $index => $user) {
            $this->assertSame($before[$index]['id'], $user['id']);
            $this->assertSame($before[$index]['full_name'], $user['full_name']);
            $this->assertTrue(password_verify((string) env('TFA4_INITIAL_PASSWORD', 'LokalCart2026!'), $user['password']));
        }
        $this->assertNotSame($after[0]['password'], $after[1]['password']);
        $migration->up();
        $this->assertSame($after, $db->table('users')->get()->getResultArray());
        $db->resetDataCache();
        $migration->down();
        $this->assertFalse($db->fieldExists('password', 'users'));
        $this->assertSame($before, $db->table('users')->get()->getResultArray());
        $forge->dropTable('users');
    }
}
