<?php
namespace Controllers;

use Models as M;

include_once(__DIR__ . '/../Models/DatabaseClient.php');

class AdminLoginController
{
    private $dbClient;

    public function __construct()
    {
        $this->dbClient = M\DatabaseClient::getInstance();
    }

    public function signIn(string $password) //:bool
    {
        try {
            $hashedPassword = sha1($password);

            echo $hashedPassword;

            if (!empty($hashedPassword)) {
                return $this->dbClient->AuthenticationLogIn($hashedPassword);
            } else {
                echo "Empty password";
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
            throw new \RuntimeException("Error authenticating:" . $e->getMessage());
        }
    }
}