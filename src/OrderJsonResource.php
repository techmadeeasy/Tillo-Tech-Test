<?php

namespace Interview2025;

class OrderJsonResource
{
    /**
     * OrderJsonResource constructor.
     */
    public function __construct(public $data)
    {
    }

    /**
     * Get the free order data.
     *
     * @return array
     */
    public function orders(): array
    {
        return $this->data;
    }

    /**
     * Get the paid orders.
     *
     * @return array
     */
    public function paidOrders(): array
    {
        return array_filter($this->data, fn ($order) => intval($order['price']) > 0);
    }

    /**
     * Get the orders with shipping address
     *
     * @return array
     */
    public function shippedOrders(): array
    {
        return array_filter(
            $this->data,
            fn ($order) => isset($order['customer']['shipping_address']['county'])
        );
    }
}
