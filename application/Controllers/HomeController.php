<?php
namespace Controllers;

use Models as M;

include_once(__DIR__ . '/../Models/DatabaseClient.php');
include_once(__DIR__ . '/../Models/ProductsModel.php');


class HomeController
{
    private $dBClient;
    private $productsModel;

    public function __construct()
    {
        $this->dBClient = M\DatabaseClient::getInstance();
        $this->productsModel = new M\ProductsModel();
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

}