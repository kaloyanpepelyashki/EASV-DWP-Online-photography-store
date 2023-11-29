<?php

namespace Models;


class ShopAbout
{
    public string $shopAboutText;
    public string $shopOwnerTel;
    public string $openingHour;
    public string $closingHour;


    public function __construct()
    {
        $getInfo = DatabaseClient::getInstance()->getAllFromTable('shopInfo');
        $this->shopAboutText = $getInfo[0]["about"];
        $this->shopOwnerTel = $getInfo[0]["owner_phone"];
    }


}