<?php

namespace Interview2025;

class OrderDecorator
{
    private OrderJsonResource $orderJsonResource;

    public function __construct(OrderJsonResource $orderJsonResource)
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
            fn ($order) => (int) $order['price'] === 0
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
            $this->orderJsonResource->paidOrders(),
            fn ($order) => strtoupper($order['currency']) === 'GBP'
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
     * @param int $minAmount
     * @return array
     */
    public function gbpOrdersWithMinAmount(int $minAmount = 100): array
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
            fn ($order) => strtoupper($order['currency']) === 'GBP'
        );
    }
}
