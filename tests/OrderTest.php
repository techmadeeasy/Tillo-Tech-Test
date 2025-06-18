<?php

use Interview2025\CurrencyEnum;
use PHPUnit\Framework\TestCase;
use Interview2025\Order;
use Interview2025\OrderDecorator;

class OrderTest extends TestCase
{
    private array $data;
    private Order $jsonResource;
    private OrderDecorator $decorator;

    protected function setUp(): void
    {
        $this->data = [
            ['id' => 1, 'price' => 0, 'currency' => CurrencyEnum::USD->name],
            ['id' => 2, 'price' => 50, 'currency' => CurrencyEnum::GBP->name],
            ['id' => 3, 'price' => 150, 'currency' =>  CurrencyEnum::GBP->name, 'customer' => ['shipping_address' => ['county' => 'Essex']]],
            ['id' => 4, 'price' => 0, 'currency' =>  CurrencyEnum::GBP->name, 'customer' => ['shipping_address' => ['county' => 'Essex']]],
            ['id' => 5, 'price' => 200, 'currency' =>  CurrencyEnum::GBP->name, 'customer' => ['shipping_address' => ['county' => 'London']]],
            ['id' => 6, 'price' => 250, 'currency' =>  CurrencyEnum::GBP->name, 'customer' => ['shipping_address' => ['county' => 'Essex']]],
            ['id' => 7, 'price' => 75, 'currency' =>  CurrencyEnum::GBP->name, 'customer' => ['shipping_address' => ['county' => 'essex']]],
        ];

        $this->jsonResource = new Order($this->data);
        $this->decorator = new OrderDecorator($this->jsonResource);
    }

    public function testFreeOrder(): void
    {
        $result = $this->decorator->freeOrder();
        $expectedIds = [1, 4];
        $resultIds = array_column($result, 'id');
        sort($expectedIds);
        sort($resultIds);
        $this->assertEquals($expectedIds, $resultIds);
    }

    public function testPaidInGBP(): void
    {
        $result = $this->decorator->paidInGBP();
        $expectedIds = [2, 3, 4, 5, 6, 7];
        $resultIds = array_column($result, 'id');
        sort($expectedIds);
        sort($resultIds);
        $this->assertEquals($expectedIds, $resultIds);
    }

    public function testShippedToEssex(): void
    {
        $result = $this->decorator->shippedToEssex();
        // Orders with shipping details available and county equaling 'essex' (case-insensitive)
        $expectedIds = [3, 4, 6, 7];
        $resultIds = array_column($result, 'id');
        sort($expectedIds);
        sort($resultIds);
        $this->assertEquals($expectedIds, $resultIds);
    }

    public function testGbpOrdersWithMinAmount(): void
    {
        $result = $this->decorator->gbpOrdersWithMinAmount();
        // Should filter paid GBP orders with price >= 100
        $expectedIds = [3, 5, 6];
        $resultIds = array_column($result, 'id');
        sort($expectedIds);
        sort($resultIds);
        $this->assertEquals($expectedIds, $resultIds);
    }

    public function testGbpOrdersShippedToEssex(): void
    {
        $result = $this->decorator->gbpOrdersShippedToEssex();
        // From shipped orders, filter those with GBP currency
        $expectedIds = [3, 4, 6, 7];
        $resultIds = array_column($result, 'id');
        sort($expectedIds);
        sort($resultIds);
        $this->assertEquals($expectedIds, $resultIds);
    }
}