<?php

namespace Interview2025;

class OrderJsonResource
{
    public $data = [];
    /**
     * OrderJsonResource constructor.
     */
    public function __construct()
    {
        $this->data = json_decode(file_get_contents(__DIR__ . '/' . "../orders.json"), true);
    }

    /**
     * Get the free order data.
     *
     * @return array
     */
    public function freeOrder()
    {
        $freeOrders = [];
        foreach ($this->data as $order) {
            if ($order['price'] === 0) {
                $freeOrders[] = $order;
            }
        }
        return $freeOrders;
    }
}