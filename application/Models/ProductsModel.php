<?php
namespace Models;

/**
 * This model handles everything related to the products in the database.
 */
class ProductsModel extends DatabaseClient
{
    private array $allProducts;

    /**
     * Constructs a new instance of the ProductsModel class.
     * Initializes the allProducts array by fetching all photo products from the database.
     */
    public function __construct()
    {
        // Get an instance of DatabaseClient
        DatabaseClient::getInstance();
        
        // Retrieve all photo products from the 'photo' table and store them in the allProducts array
        $this->allProducts = DatabaseClient::getInstance()->getAllFromTable("photo");
    }

    /**
     * Returns an array of all products.
     *
     * @return array The array of all products.
     */
    public function getAllProducts(): array
    {
        return $this->allProducts;
    }

    /**
     * Returns a specific product by its ID.
     *
     * @param int $id The ID of the product.
     * @return mixed The specific product.
     */
    public function getProduct_ById(int $id)
    {
        // Get a specific product from the 'photo' table based on its ID
        return DatabaseClient::getInstance()->getSpecificID_FromTable("photo", $id);
    }

    /**
     * Returns the latest product based on the published date.
     *
     * @return mixed The latest product.
     */
    public function getLatestProduct()
    {
        // Get the current date
        $currentDate = new \DateTime();
        
        // Initialize variables for finding the closest product
        $closestProduct = null;
        $mindifference = PHP_INT_MAX;

        // Iterate through all products to find the latest one
        foreach ($this->allProducts as $product) {
            $productDate = new \DateTime($product['published_at']);
            $difference = abs($productDate->diff($currentDate)->days);
            
            // Check if the current product has a smaller difference, making it closer to the current date
            if ($difference < $mindifference) {
                $closestProduct = $product;
                $mindifference = $difference;
            }

            // Return the closest product if found
            if ($closestProduct !== null) {
                return $closestProduct;
            }
        }
    }
}
