<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

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
            'customers page' => ['/customers', 'Customer Accounts'],
            'users page'     => ['/users', 'User Accounts'],
        ];
    }

    public function testCustomerPageDisplaysAllStaticRecords(): void
    {
        $result = $this->get('/customers');
        $result->assertSee('Mikaela Santos');
        $result->assertSee('Andre Villanueva');
        $result->assertSee('6 sample customers');
    }

    public function testUserPageDisplaysAllStaticRecords(): void
    {
        $result = $this->get('/users');
        $result->assertSee('admin.ramos');
        $result->assertSee('support.tan');
        $result->assertSee('6 sample staff members');
    }
}
