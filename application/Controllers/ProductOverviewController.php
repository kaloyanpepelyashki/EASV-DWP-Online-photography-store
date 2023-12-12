<?php

namespace Controllers;

use Models as M;

include_once(__DIR__ . '/../Models/DatabaseClient.php');
include_once(__DIR__ . '/../Models/Photo.php');

class ProductOverviewController
{

    private $product;
    private $dbClient;

    public function __construct($id)
    {
        $this->dbClient = M\DatabaseClient::getInstance();
        $product = $this->dbClient->getSpecificID_FromTable("photo", $id);

        $photo = new M\Photo($product[0]['name'], $product[0]['description'], $product[0]['url'], $product[0]['published_at'], $product[0]['base_price']);

        $this->product = $photo;
    }

    public function getProduct()
    {
        return $this->product;
    }
}