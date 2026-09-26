<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use App\Models\TaskModel;
use App\Models\UserModel;

/** @internal */
final class PagesTest extends CIUnitTestCase
{
    use FeatureTestTrait;

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
