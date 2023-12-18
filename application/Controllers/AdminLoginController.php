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

    public function signIn(string $password, string $username): bool
    {
        try {
            $hashedPassword = sha1($password);


            if (!empty($hashedPassword)) {
                return $this->dbClient->AuthenticationLogIn($hashedPassword, $username);
            } else {
                return false;
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
            throw new \RuntimeException("Error authenticating:" . $e->getMessage());
        }
    }

    public function handleControllerInteraction()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['action'])) {
                    switch ($_POST['action']) {
                        case "signin":
                            $creditObject = json_decode($_POST['creditObject'], true);

                            if ($creditObject !== null) {
                                $username = $creditObject['username'];
                                $password = $creditObject['password'];
                                echo "Db response" . $this->signIn($username, $password);
                                // echo "";
                                // echo "username $username password $password";

                            }
                        default:
                            echo "Error";
                            break;
                    }
                }
            }
        } catch (\Exception $e) {
            throw new \RuntimeException("Error authenticating : " . $e->getMessage());
        }
    }
}

$controller = new AdminLoginController();
$controller->handleControllerInteraction();