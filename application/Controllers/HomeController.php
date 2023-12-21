<?php
namespace Controllers;

use Models as M;

require_once(__DIR__ . '/../Models/DatabaseClient.php');
require_once(__DIR__ . '/../Models/ProductsModel.php');
require_once(__DIR__ . '/../Models/ShopAbout.php');
require_once(__DIR__ . '/../Models/ShoppingCart.php');
require_once(__DIR__ . '/../Models/NewsMessage.php');

//This controller handles all basic operations related to the initial view of the application "/"
class HomeController
{
    private $dBClient;
    private $productsModel;

    private $shopInfoModel;

    private $shoppingCart;

    private $newsMessage;

    public function __construct()
    {
        $this->dBClient = M\DatabaseClient::getInstance();
        $this->productsModel = new M\ProductsModel();
        $this->shopInfoModel = new M\ShopAbout();
        $this->shoppingCart = M\ShoppingCart::getInstance();
        $this->newsMessage = new M\NewsMessage();
    }


    public function getAllProducts(): array
    {
        return $this->productsModel->getAllProducts();
    }

    public function getShopInfo()
    {
        return $this->shopInfoModel->getShopAbout();
    }

    public function getLatestProduct()
    {
        return $this->productsModel->getLatestProduct();
    }

    public function getNewsMessage()
    {
        return $this->newsMessage->getNewsMessage();
    }

}