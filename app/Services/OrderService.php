<?php

namespace App\Services;

class OrderService
{
    static $order = [];

    /**
     * OrderService constructor.
     */
    public function __construct()
    {
        self::$order = [
            'name' => request()->input('order.name', 'created_at'),
            'value' => request()->input('order.value', 'created_at'),
        ];
    }
    /**
     * @param $order
     */
    public function init($order)
    {
        self::$order = $order;
    }

    /**
     * @param $name
     * @param $value
     * @return bool
     */
    public function compare($name, $value)
    {
        if (self::$order['name'] == $name && self::$order['value'] == $value) {
            return true;
        }

        return false;
    }
}
