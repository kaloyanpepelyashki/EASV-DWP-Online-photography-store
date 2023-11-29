<?php

class ShoppingCart {

    protected static $instance;
    private $items = array();

    protected function __construct() {}

    private function __clone() {}

    public static function getInstance() 
    {
        if (!isset(self::$instance)) {
                self::$instance = new ShoppingCart();
        }

        return self::$instance;
    }

    public function addToCart($item) 
    {
        array_push($this->items, $item);
    }
    
}