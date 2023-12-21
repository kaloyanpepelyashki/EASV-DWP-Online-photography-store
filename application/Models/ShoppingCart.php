<?php
namespace Models;

//Class that represents the shopping cart
//This model models the functionality of a shopping cart
//!!SINGLETON CLASS!!
//DON'T INSTANTIATE WITH "new ShoppingCart()";
//Instead use "ShoppingCart::getInstance()";
class ShoppingCart
{

    protected static $instance;
    private static $items = array();

    protected function __construct()
    {
        $this->init();
    }

    private function __clone()
    {
    }

    //This method initilizes the shopping cart $_SESSION['cart']
    private function init()
    {
        //Checks if a session is set
        if (session_status() == PHP_SESSION_NONE) {
            //If it's not it starts the session
            session_start();
        }

        //Checks if $_SESSION['cart'] is already set
        if (!isset($_SESSION['cart'])) {
            //If it is not, it sets it
            $_SESSION['cart'] = array();
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new ShoppingCart();
        }

        return self::$instance;
    }

    //Returns all the items from the global $_SESSEION['cart'] if any
    public function getCartItems(): array|string
    {
        if (count($_SESSION['cart']) == 0) {
            return "Nothing to show";
        } else {
            return $_SESSION['cart'];
        }
    }

    // Adds item to the cart in the global $_SESSION['cart']
    public function addToCart($item)
    {
        $exists = false;

        //Checks if any of the products in the cart has the same id as the product being added
        foreach ($_SESSION['cart'] as &$cartItem) {
            //If yes
            if (isset($cartItem->photo->id) && $cartItem->photo->id == $item->photo->id) {
                //It increments the quantity with 1
                $cartItem->quantity++;
                $exists = true;
                break;
            }
        }
        //If no matches are found it adds to product to the shopping cart
        if (!$exists) {
            $_SESSION['cart'][] = $item;
            return true;
        }
    }

    // Removes item to the cart in the global $_SESSION['cart']
    public function removeFromCart($removable)
    {
        //Chekcs if there are any items in the array
        if (count($_SESSION['cart']) <= 0) {
            return;
        } else {
            //If there are items in the array, it removes the item specified
            return $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], static function ($item) use ($removable) {
                return $item !== $removable;
            }));
        }
    }

}