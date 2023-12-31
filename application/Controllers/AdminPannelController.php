<?php

namespace Controllers;

use Models as M;

require_once(__DIR__ . '/../Models/DatabaseClient.php');
require_once(__DIR__ . '/../Models/ShopAbout.php');

//This controller handles all basic operations related to the admin panel of the application
class AdminPannelController
{
    private $dbClient;
    private $shopAboutModel;

    public function __construct()
    {
        $this->shopAboutModel = new M\ShopAbout();
        $this->dbClient = M\DatabaseClient::getInstance();
    }

    public function getShopAbout()
    {
        return $this->shopAboutModel->getShopAbout();
    }


    //Updates the shop about text
    public function updateShopAboutInfo(string $newValue)
    {
        $this->shopAboutModel->updateShopAboutField("about", $newValue);
    }

    //Updates the shop owner telephone number
    public function updateShopOwnerTel(string $newValue)
    {
        $this->shopAboutModel->updateShopAboutField("owner_phone", $newValue);
    }

    public function getAllProducts()
    {
        return $this->dbClient->getAllFromTable('photo');
    }

    public function getAllOrders()
    {
        return $this->dbClient->getAllFromTable("orders");
    }

    public function getAllUndelivered()
    {
        //Gets the database view for not delivered orders (pending orders)
        return $this->dbClient->getAllFromTable("notDelivered");
    }


    public function handlePannelInteractions()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case "updateAboutText":
                        $newText = json_decode($_POST['newText']);
                        $this->updateShopAboutInfo("$newText");
                        echo "About text updated successfully.";
                        break;
                    case "updateOwnerTel":
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

$controller = new AdminPannelController();
$controller->handlePannelInteractions();