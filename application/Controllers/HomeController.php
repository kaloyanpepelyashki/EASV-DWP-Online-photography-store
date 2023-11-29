<?php
namespace Controllers;

use Models as M;

include_once(__DIR__ . '/../Models/DatabaseClient.php');
include_once(__DIR__ . '/../Models/ProductsModel.php');
include_once(__DIR__ . '/../Models/ShopAbout.php');


class HomeController
{
    private $dBClient;
    private $productsModel;

    private $shopInfoModel;

    public function __construct()
    {
        $this->dBClient = M\DatabaseClient::getInstance();
        $this->productsModel = new M\ProductsModel();
        $this->shopInfoModel = new M\ShopAbout();
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

    public function getShopInfo()
    {
        return $this->shopInfoModel;
    }

    public function updateTableById(string $table, int $idToUpdate, string $columnToUpdate, string $newValue) 
    {
        return $this->dBClient->updateTableById($table, $idToUpdate, $columnToUpdate, $newValue);
    }



}