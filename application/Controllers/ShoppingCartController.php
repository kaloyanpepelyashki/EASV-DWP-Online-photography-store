<?php

namespace Controllers;

use Models as M;

// Require_once statement to include necessary model
require_once(__DIR__ . '/../Models/ShoppingCart.php');

/**
 * This class represents the ShoppingCartController, which handles all asynchronous HTTP requests to the shopping cart.
 */
class ShoppingCartController
{
    // Instance variable to hold a ShoppingCart singleton
    private $shoppingCart;

    /**
     * Constructs a new instance of the ShoppingCartController class.
     */
    public function __construct()
    {
        // Instantiate ShoppingCart singleton and assign it to $this->shoppingCart
        $this->shoppingCart = M\ShoppingCart::getInstance();
    }

    /**
     * Handles the interaction with the shopping cart based on the HTTP request method and action.
     */
    public function handleCartInteraction()
    {
        // Check if the HTTP request method is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if 'action' parameter is set in the POST request
            if (isset($_POST['action'])) {
                // Switch statement to handle different cart actions
                switch ($_POST['action']) {
                    case 'add':
                        // Decode the JSON string received in the 'item' parameter
                        $item = json_decode($_POST['item']);
                        
                        // Call the addToCart method of the ShoppingCart singleton with the decoded item
                        M\ShoppingCart::getInstance()->addToCart($item);
                        
                        // Uncomment the following lines if redirection is needed after adding to cart
                        // header("Location: /", true, 301);
                        // exit();
                        break;
                    case 'remove':
                        // Call the removeFromCart method of the ShoppingCart singleton with the item to remove
                        $this->shoppingCart->removeFromCart($_POST['item']);
                        break;
                }
            }
        } 
        // Check if the HTTP request method is GET
        elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Check if 'action' parameter is set in the GET request and it is 'get'
            if (isset($_GET['action']) && $_GET['action'] === 'get') {
                // Set the response content type to JSON
                header("Content-type: application/json");
                
                // Encode and echo the cart items as JSON and exit the script
                echo json_encode($this->shoppingCart->getCartItems());
                exit;
            }
        }
    }
}

// Create an instance of ShoppingCartController
$shoppingCartController = new ShoppingCartController();

// Call the handleCartInteraction method to process shopping cart interactions
$shoppingCartController->handleCartInteraction();
