<?php
namespace Controllers;

use Models as M;

include_once(__DIR__ . '/../Models/DatabaseClient.php');
include_once(__DIR__ . '/../Models/ProductsModel.php');
include_once(__DIR__ . '/../Models/ShopAbout.php');
include_once(__DIR__ . '/../Models/ShoppingCart.php');


class HomeController
{
    private $dBClient;
    private $productsModel;

    private $shopInfoModel;

    private $shoppingCart;

    public function __construct()
    {
        $this->dBClient = M\DatabaseClient::getInstance();
        $this->productsModel = new M\ProductsModel();
        $this->shopInfoModel = new M\ShopAbout();
        $this->shoppingCart = M\ShoppingCart::getInstance();
    }

    public function getDatabaseClient()
    {
        return $this->dBClient;
    }

    public function getAllProducts(): array
    {
        return $this->productsModel->getAllProducts();
    }

    public function getProduct_byId(int $id)
    {
        return $this->productsModel->getProduct_ById($id);
    }

    public function updateTableById(string $table, int $idToUpdate, string $columnToUpdate, string $newValue)
    {
        return $this->dBClient->updateTableById($table, $idToUpdate, $columnToUpdate, $newValue);
    }

    public function getShopInfo()
    {
        return $this->shopInfoModel;
    }

    public function getShoppingCartItems()
    {
        return $this->shoppingCart->getCartItems();
    }

}