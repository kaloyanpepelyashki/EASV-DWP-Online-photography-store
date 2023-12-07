<?php

namespace Controllers;

use Models as M;

include_once(__DIR__ . '/../Models/DatabaseClient.php');

class ProductOverviewController
{

    private $product;
    private $dbClient;

    public function __construct($id)
    {
        $this->dbClient = M\DatabaseClient::getInstance();

        $this->product = $this->dbClient->getSpecificID_FromTable("photo", $id);
    }

    public function getProduct()
    {
        return $this->product;
    }
}