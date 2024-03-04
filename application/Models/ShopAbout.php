<?php

namespace Models;

// This model stores the shop about information such as tel, email, working hours
class ShopAbout
{
    private $dbClient;
    private string $shopAboutText;
    private string $shopOwnerTel;
    private string $shopOwnerMail;
    private string $openingHour;
    private string $closingHour;

    /**
     * Constructor for the ShopAbout class.
     * Initializes the database client and retrieves the shop information from the database.
     */
    public function __construct()
    {
        // Get an instance of the DatabaseClient
        $this->dbClient = DatabaseClient::getInstance();
        
        // Retrieve information from the 'shopInfo' table
        $getInfo = DatabaseClient::getInstance()->getAllFromTable('shopInfo');

        // Assign the retrieved shop information to the corresponding properties
        $this->shopAboutText = $getInfo[0]["about"];
        $this->shopOwnerTel = $getInfo[0]["ownerPhone"];
        $this->shopOwnerMail = $getInfo[0]["ownerEmail"];
        $this->openingHour = $getInfo[0]["openingHour"];
        $this->closingHour = $getInfo[0]["closingHour"];
    }

    /**
     * Retrieves the shop about information.
     * @return array|null An array containing the shop about information, or null if no information is available.
     */
    public function getShopAbout(): array|null
    {
        // Array holding all the different shop about points
        $shopInfo = array("about" => $this->shopAboutText, "ownerTelNumber" => $this->shopOwnerTel, "ownerMail" => $this->shopOwnerMail, "openingHour" => $this->openingHour, "closingHour" => $this->closingHour);

        // Check if the shopInfo array is empty
        if (count($shopInfo) < 0) {
            return null;
        } else {
            return $shopInfo;
        }
    }

    /**
     * Updates the shop about information.
     * @param string $column The column to update.
     * @param string $newValue The new value to update to.
     */
    public function updateShopAboutField(string $column, string $newValue)
    {
        // Get an instance of the DatabaseClient
        $dbClient = $this->dbClient;

        // Update the shop about information in the 'shopinfo' table
        $dbClient->updateTableById("shopinfo", 1, $column, $newValue);
    }
}
