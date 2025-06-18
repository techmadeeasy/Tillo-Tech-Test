<?php

namespace Interview2025;

class OrderDecorator
{
    private Order $orderJsonResource;

    public function __construct(Order $orderJsonResource)
    {
        $this->orderJsonResource = $orderJsonResource;
    }

    /**
     * Get the free order data.
     *
     * @return array
     */
    public function freeOrder(): array
    {
        return  array_filter(
            $this->orderJsonResource->orders(),
            fn ($order) => (float) $order['price'] == 0
        );
    }

    /**
     * Get the orders paid in GBP.
     *
     * @return array
     */
    public function paidInGBP(): array
    {
        return array_filter(
            $this->orderJsonResource->orders(),
            fn ($order) => strtoupper($order['currency']) === CurrencyEnum::GBP->name
        );
    }

    /**
     * Get the orders shipped to Essex county
     *
     * @return array
     */
    public function shippedToEssex(): array
    {
        return array_filter(
            $this->orderJsonResource->shippedOrders(),
            fn ($order) => strtolower($order['customer']['shipping_address']['county']) === 'essex'
        );
    }

    /**
     * Get the orders placed in GBP and with minimum amount.
     * @param float $minAmount
     * @return array
     */
    public function gbpOrdersWithMinAmount(float $minAmount = 100): array
    {
        return array_filter(
            $this->paidInGBP(),
            fn ($order) => (float) $order['price'] >= $minAmount
        );
    }

    /**
     * Get the orders placed in GBP and shipped to Essex.
     *
     * @return array
     */
    public function gbpOrdersShippedToEssex(): array
    {
        return array_filter(
            $this->shippedToEssex(),
            fn ($order) => strtoupper($order['currency']) === CurrencyEnum::GBP->name
        );
    }
}
