<?php

namespace Controllers;

use Models as M;

// Require_once statements to include necessary models
require_once(__DIR__ . '/../Models/DatabaseClient.php');
require_once(__DIR__ . '/../Models/CartProduct.php');
require_once(__DIR__ . '/../Models/Photo.php');

/**
 * This controller handles product fetch based on which product page is queried in the URL.
 * The controller gets the specific product and re-renders the view accordingly.
 */
class ProductOverviewController
{
    // Instance variables to store product information
    private int $id;
    private $product;
    private $dbClient;

    // Instance variable to hold a CartProduct model
    private M\CartProduct $cartProductsModel;

    /**
     * Constructs a new ProductOverviewController object.
     *
     * @param int $id The ID of the product.
     */
    public function __construct($id)
    {
        // Instantiate DatabaseClient singleton and assign it to $this->dbClient
        $this->dbClient = M\DatabaseClient::getInstance();
        
        // Retrieve product information from the database based on the provided ID
        $product = $this->dbClient->getSpecificID_FromTable("photo", $id);
        
        // Retrieve aspect ratio information from the database based on the product's aspect ratio ID
        $aspectRatio = $this->dbClient->getSpecificID_FromTable("aspectratio", $product[0]['ratio']);
        
        // Create a new Photo object with the retrieved information
        $photo = new M\Photo(
            $product[0]['id'],
            $product[0]['name'],
            $product[0]['description'],
            $product[0]['url'],
            $product[0]['published_at'],
            $product[0]['base_price'],
            $aspectRatio[0]['aspectRatio']
        );
        
        // Create a new CartProduct object with the Photo object
        $this->product = new M\CartProduct($photo);
    }

    /**
     * Gets the product.
     *
     * @return M\CartProduct The product.
     */
    public function getProduct()
    {
        // Return the stored product
        return $this->product;
    }
}
