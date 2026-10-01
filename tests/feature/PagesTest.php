<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use App\Models\TaskModel;
use App\Models\UserModel;

/** @internal */
final class PagesTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();

        $db = db_connect();
        $db->query('CREATE TABLE IF NOT EXISTS db_tasks (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT NOT NULL, status TEXT NOT NULL, task_date TEXT NOT NULL, created_at TEXT NOT NULL)');
        $db->query('CREATE TABLE IF NOT EXISTS db_users (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT NOT NULL UNIQUE, full_name TEXT NOT NULL, email TEXT NOT NULL, avatar TEXT NULL, created_at TEXT NOT NULL)');
        $db->query('DELETE FROM db_tasks');
        $db->query('DELETE FROM db_users');
        $db->table('tasks')->insert([
            'title' => 'Review inventory counts',
            'status' => 'pending',
            'task_date' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $db->table('users')->insert([
            'username' => 'berry.cole',
            'full_name' => 'Berry Cole',
            'email' => 'berry.cole@example.com',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /** @dataProvider pageProvider */
    public function testRequiredPagesLoad(string $path, string $expectedText): void
    {
        $result = $this->get($path);
        $result->assertStatus(200);
        $result->assertSee($expectedText);
        $result->assertSee('LokalCart');
    }

    public static function pageProvider(): array
    {
        return [
            'today dashboard' => ['/', 'Tasks for today'],
            'task list' => ['/tasks', 'Task List'],
            'profile page' => ['/profile', 'Profile'],
            'about page' => ['/about', 'Built by Berry Cole'],
        ];
    }

    public function testRequiredModelsAreAvailable(): void
    {
        $this->assertTrue(class_exists(TaskModel::class));
        $this->assertTrue(class_exists(UserModel::class));
    }
}
