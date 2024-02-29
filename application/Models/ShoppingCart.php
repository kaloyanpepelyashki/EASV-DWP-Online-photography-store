<?php
namespace Models;

/**
 * Class ShoppingCart
 * 
 * Class that represents the shopping cart.
 * This model models the functionality of a shopping cart.
 * 
 * @package Models
 */
class ShoppingCart
{

    protected static $instance;
    private static $items = array();

    /**
     * ShoppingCart constructor.
     * 
     * Initializes the shopping cart instance.
     * 
     * @access protected
     */
    protected function __construct()
    {
        $this->init();
    }

    /**
     * Prevent cloning of the ShoppingCart instance.
     * 
     * @access private
     */
    private function __clone()
    {
    }

    /**
     * Initializes the shopping cart $_SESSION['cart'].
     * 
     * Checks if a session is set and starts it if not.
     * Checks if $_SESSION['cart'] is already set and sets it if not.
     * 
     * @access private
     */
    private function init()
    {
        // Checks if a session is set
        if (session_status() == PHP_SESSION_NONE) {
            // If it's not, it starts the session
            session_start();
        }

        // Checks if $_SESSION['cart'] is already set
        if (!isset($_SESSION['cart'])) {
            // If it is not, it sets it
            $_SESSION['cart'] = array();
        }
    }

    /**
     * Get the instance of the ShoppingCart class.
     * 
     * @access public
     * @static
     * @return ShoppingCart
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new ShoppingCart();
        }

        return self::$instance;
    }

    /**
     * Get all the items from the global $_SESSION['cart'] if any.
     * 
     * @access public
     * @return array|string Returns the items in the cart or "Nothing to show" if the cart is empty.
     */
    public function getCartItems(): array|string
    {
        if (count($_SESSION['cart']) == 0) {
            return "Nothing to show";
        } else {
            return $_SESSION['cart'];
        }
    }

    /**
     * Add an item to the cart in the global $_SESSION['cart'].
     * 
     * @access public
     * @param mixed $item The item to be added to the cart.
     * @return bool Returns true if the item was added successfully, false otherwise.
     */
    public function addToCart($item)
    {
        $exists = false;

        // Checks if any of the products in the cart has the same id as the product being added
        foreach ($_SESSION['cart'] as &$cartItem) {
            // If yes
            if (isset($cartItem->photo->id) && $cartItem->photo->id == $item->photo->id) {
                // It increments the quantity with 1
                $cartItem->quantity++;
                $exists = true;
                break;
            }
        }
        // If no matches are found, it adds the product to the shopping cart
        if (!$exists) {
            $_SESSION['cart'][] = $item;
            return true;
        }
    }

    /**
     * Remove an item from the cart in the global $_SESSION['cart'].
     * 
     * @access public
     * @param mixed $removable The item to be removed from the cart.
     * @return void
     */
    public function removeFromCart($removable)
    {
        // Checks if there are any items in the array
        if (count($_SESSION['cart']) <= 0) {
            return;
        } else {
            // If there are items in the array, it removes the specified item
            return $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], static function ($item) use ($removable) {
                return $item !== $removable;
            }));
        }
    }

}
