<?php

namespace Controllers;

use Models as M;

require_once(__DIR__ . '/../Models/ShoppingCart.php');
//THIS CONTROLLER HANDLES ALL OF THE ASYNC HTTP RESQUEST TO SHOPPING CART
class ShoppingCartController
{


    private $shoppingCart;

    public function __construct()
    {
        $this->shoppingCart = M\ShoppingCart::getInstance();
    }

    //The main method that handles http requests
    public function handleCartInteraction()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'add':
                        //Triggers the ShoppingCart addToCartMethod();
                        $item = json_decode($_POST['item']);
                        M\ShoppingCart::getInstance()->addToCart($item);
                        // header("Location: /", true, 301);
                        // exit();
                        break;
                    case 'remove':
                        $this->shoppingCart->removeFromCart($_POST['item']);
                        break;
                }
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['action']) && $_GET['action'] === 'get') {
                header("Content-type: application/json");
                echo json_encode($this->shoppingCart->getCartItems());
                exit;
            }
        }
    }

}


$shoppingCartController = new ShoppingCartController();
$shoppingCartController->handleCartInteraction();