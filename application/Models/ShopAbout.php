<?php

namespace Models;


class ShopAbout
{
    private $dbClient;
    private string $shopAboutText;
    private string $shopOwnerTel;
    private string $openingHour;
    private string $closingHour;


    public function __construct()
    {
        $this->dbClient = DatabaseClient::getInstance();
        $getInfo = DatabaseClient::getInstance()->getAllFromTable('shopInfo');
        $this->shopAboutText = $getInfo[0]["about"];
        $this->shopOwnerTel = $getInfo[0]["owner_phone"];
        $this->openingHour = $getInfo[0]["opening_hour"];
        $this->closingHour = $getInfo[0]["closing_hour"];
    }

    public function getShopAbout(): array|null
    {
        //Array holding all the different shop about points
        $shopInfo = array("about" => $this->shopAboutText, "ownerTelNumber" => $this->shopOwnerTel, "openingHour" => $this->openingHour, "closingHour" => $this->closingHour);

        if (count($shopInfo) < 0) {
            return null;
        } else {
            return $shopInfo;
        }
    }

    //This method updates the shop about info. 
    //Takes as parameters the coumn it needs to update and the new value to update to
    public function updateShopAboutField(string $column, string $newValue)
    {
        $dbClient = $this->dbClient;

        $dbClient->updateTableById("shopinfo", 1, $column, $newValue);
    }


}