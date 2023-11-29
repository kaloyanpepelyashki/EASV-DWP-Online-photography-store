<?php
namespace Models;

class ProductsModel extends DatabaseClient
{
    private array $allProducts;

    public function __construct()
    {
        DatabaseClient::getInstance();
        //Gets all of the photo products
        $this->allProducts = DatabaseClient::getInstance()->getAllFromTable("photo");
    }

    public function getAllProducts(): array
    {
        return $this->allProducts;
    }

    public function getProduct_ById(int $id)
    {
        return DatabaseClient::getInstance()->getSpecificID_FromTable("photo", $id);
    }

    


}