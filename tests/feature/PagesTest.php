<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use App\Models\CustomerModel;
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
            'landing page'   => ['/', 'Your store team and customers'],
            'about page'     => ['/about', 'A simple MVC request flow'],
        ];
    }

    public function testDatabaseModelsAreAvailable(): void
    {
        $this->assertTrue(class_exists(CustomerModel::class));
        $this->assertTrue(class_exists(UserModel::class));
    }
}
