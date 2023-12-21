<?php

namespace Controllers;

use Models as M;

include_once(__DIR__ . '/../Models/DatabaseClient.php');
include_once(__DIR__ . '/../Models/CartProduct.php');
include_once(__DIR__ . '/../Models/Photo.php');

//This controller handles product fetch based on which product page is queried in the url.
//The controller get the specific product and re-renders the view accrodingly
class ProductOverviewController
{
    private int $id;
    private $product;
    private $dbClient;

    private M\CartProduct $cartProductsModel;

    public function __construct($id)
    {
        $this->dbClient = M\DatabaseClient::getInstance();
        $product = $this->dbClient->getSpecificID_FromTable("photo", $id);
        $aspectRatio = $this->dbClient->getSpecificID_FromTable("aspectratio", $product[0]['ratio']);

        $photo = new M\Photo($product[0]['id'], $product[0]['name'], $product[0]['description'], $product[0]['url'], $product[0]['published_at'], $product[0]['base_price'], $aspectRatio[0]['aspectRatio']);

        $this->product = new M\CartProduct($photo);
    }

    public function getProduct()
    {
        return $this->product;
    }
}