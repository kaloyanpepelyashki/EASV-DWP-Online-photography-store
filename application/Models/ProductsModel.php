<?php
namespace Models;

//This model handles everything related to the products in database.
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

    public function getLatestProduct()
    {
        $currentDate = new \DateTime();
        $closestProduct = null;
        $mindifference = PHP_INT_MAX;


        foreach ($this->allProducts as $product) {
            $productDate = new \DateTime($product['published_at']);
            $difference = abs($productDate->diff($currentDate)->days);
            if ($difference < $mindifference) {
                $closestProduct = $product;
                $mindifference = $difference;
            }

            if ($closestProduct !== null) {
                return $closestProduct;
            }
        }

    }


}