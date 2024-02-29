<?php
namespace Controllers;

use Models as M;

// Require_once statements to include necessary models
require_once(__DIR__ . '/../Models/DatabaseClient.php');
require_once(__DIR__ . '/../Models/ProductsModel.php');
require_once(__DIR__ . '/../Models/ShopAbout.php');
require_once(__DIR__ . '/../Models/ShoppingCart.php');
require_once(__DIR__ . '/../Models/NewsMessage.php');

/**
 * This controller handles all basic operations related to the initial view of the application "/"
 */
class HomeController
{
    // Instance variables to hold various models
    private $dBClient;
    private $productsModel;
    private $shopInfoModel;
    private $shoppingCart;
    private $newsMessage;

    /**
     * Constructor for HomeController class.
     * Initializes the required models and database client.
     */
    public function __construct()
    {
        // Instantiate DatabaseClient singleton and assign it to $this->dBClient
        $this->dBClient = M\DatabaseClient::getInstance();
        
        // Instantiate ProductsModel and assign it to $this->productsModel
        $this->productsModel = new M\ProductsModel();
        
        // Instantiate ShopAbout model and assign it to $this->shopInfoModel
        $this->shopInfoModel = new M\ShopAbout();
        
        // Instantiate ShoppingCart singleton and assign it to $this->shoppingCart
        $this->shoppingCart = M\ShoppingCart::getInstance();
        
        // Instantiate NewsMessage model and assign it to $this->newsMessage
        $this->newsMessage = new M\NewsMessage();
    }

    /**
     * Retrieves all products from the products model.
     *
     * @return array An array of all products.
     */
    public function getAllProducts(): array
    {
        // Call the getAllProducts method of the ProductsModel
        return $this->productsModel->getAllProducts();
    }

    /**
     * Retrieves the shop information from the shop about model.
     *
     * @return mixed The shop information.
     */
    public function getShopInfo()
    {
        // Call the getShopAbout method of the ShopAbout model
        return $this->shopInfoModel->getShopAbout();
    }

    /**
     * Retrieves the latest product from the products model.
     *
     * @return mixed The latest product.
     */
    public function getLatestProduct()
    {
        // Call the getLatestProduct method of the ProductsModel
        return $this->productsModel->getLatestProduct();
    }

    /**
     * Retrieves the news message from the news message model.
     *
     * @return mixed The news message.
     */
    public function getNewsMessage()
    {
        // Call the getNewsMessage method of the NewsMessage model
        return $this->newsMessage->getNewsMessage();
    }
}
