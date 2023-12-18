<?php

namespace Controllers;

use Models as M;

include_once(__DIR__ . '/../Models/DatabaseClient.php');
include_once(__DIR__ . '/../Models/ShopAbout.php');

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

    public function getAllOrders()
    {
        return $this->dbClient->getAllFromTable("orders");
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