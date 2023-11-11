<?php
namespace Views;

use Models as M;

include_once(__DIR__ . '/../Models/DatabaseClient.php');

class HomeViewBLOC
{
    private $dBClient;

    public function __construct()
    {
        $this->dBClient = M\DatabaseClient::getInstance();
    }

    public function getDatabaseClient()
    {
        return $this->dBClient;
    }

}