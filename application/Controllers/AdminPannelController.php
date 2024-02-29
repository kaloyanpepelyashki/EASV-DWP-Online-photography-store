<?php

namespace Controllers;

use Models as M;

// Include necessary model files
require_once(__DIR__ . '/../Models/DatabaseClient.php');
require_once(__DIR__ . '/../Models/ShopAbout.php');

/**
 * This controller handles all basic operations related to the admin panel of the application.
 */
class AdminPannelController
{
    private $dbClient;          // Database client instance
    private $shopAboutModel;    // ShopAbout model instance

    /**
     * Initializes a new instance of the AdminPannelController class.
     */
    public function __construct()
    {
        // Instantiate ShopAbout model and DatabaseClient singleton
        $this->shopAboutModel = new M\ShopAbout();
        $this->dbClient = M\DatabaseClient::getInstance();
    }

    /**
     * Retrieves the shop about information.
     *
     * @return string The shop about information.
     */
    public function getShopAbout()
    {
        return $this->shopAboutModel->getShopAbout();
    }

    /**
     * Updates the shop about text.
     *
     * @param string $newValue The new value for the shop about text.
     * @return void
     */
    public function updateShopAboutInfo(string $newValue)
    {
        // Update shop about field with the provided new value
        $this->shopAboutModel->updateShopAboutField("about", $newValue);
    }

    /**
     * Updates the shop owner telephone number.
     *
     * @param string $newValue The new value for the shop owner telephone number.
     * @return void
     */
    public function updateShopOwnerTel(string $newValue)
    {
        // Update shop about field for owner's phone with the provided new value
        $this->shopAboutModel->updateShopAboutField("owner_phone", $newValue);
    }

    /**
     * Retrieves all products from the database.
     *
     * @return array An array of all products.
     */
    public function getAllProducts()
    {
        // Retrieve all rows from the 'photo' table in the database
        return $this->dbClient->getAllFromTable('photo');
    }

    /**
     * Retrieves all orders from the database.
     *
     * @return array An array of all orders.
     */
    public function getAllOrders()
    {
        // Retrieve all rows from the 'orders' table in the database
        return $this->dbClient->getAllFromTable("orders");
    }

    /**
     * Retrieves all undelivered orders from the database.
     *
     * @return array An array of all undelivered orders.
     */
    public function getAllUndelivered()
    {
        // Retrieve all rows from the 'notDelivered' table in the database (a view for undelivered orders)
        return $this->dbClient->getAllFromTable("notDelivered");
    }

    /**
     * Handles the interactions in the admin panel.
     *
     * @return void
     */
    public function handlePannelInteractions()
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if 'action' is set in the POST data
            if (isset($_POST['action'])) {
                // Switch case based on the value of 'action' in POST data
                switch ($_POST['action']) {
                    case "updateAboutText":
                        // Decode JSON data for updating about text and call the respective method
                        $newText = json_decode($_POST['newText']);
                        $this->updateShopAboutInfo("$newText");
                        echo "About text updated successfully.";
                        break;
                    case "updateOwnerTel":
                        // Decode JSON data for updating owner's telephone number and call the respective method
                        $newNumber = json_decode($_POST['newTel']);
                        $this->updateShopOwnerTel("$newNumber");
                        echo "Owner telephone number updated successfully.";
                        break;
                    default:
                        echo "Error";
                        break;
                }
            }
        }
    }
}

// Instantiate AdminPannelController and handle interactions
$controller = new AdminPannelController();
$controller->handlePannelInteractions();
