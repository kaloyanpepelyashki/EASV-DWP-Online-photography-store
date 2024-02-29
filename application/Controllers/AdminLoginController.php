<?php
namespace Controllers;

use Models as M;

require_once(__DIR__ . '/../Models/DatabaseClient.php');


class AdminLoginController
{
    private $dbClient;

    public function __construct()
    {
        $this->dbClient = M\DatabaseClient::getInstance();
        $this->init();
    }

    private function init()
    {
        //Checks if a session is set
        if (session_status() == PHP_SESSION_NONE) {
            //If it's not it starts the session
            session_start();
        }

        //Checks if $_SESSION['cart'] is already set
        if (!isset($_SESSION['authState'])) {
            //If it is not, it sets it
            $_SESSION['authState'] = false;
        }
    }
    public function signIn(string $password, string $username): bool {
    try {
        // Hash the password using bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        if ($hashedPassword !== false) {
            // Perform authentication with the hashed password
            return $this->dbClient->AuthenticationLogIn($hashedPassword, $username);
        } else {
            return false;
        }
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
        throw new \RuntimeException("Error authenticating:" . $e->getMessage());
    }
}


    //This method updates the authentication state
    public function setAuthState(string $password, string $username): bool
    {
        try {
            if ($this->signIn($password, $username)) {
                $_SESSION["authState"] = true;
                return $this->signIn($password, $username);
            } else {
                $_SESSION["authState"] = false;
                return false;
            }
        } catch (\Exception $e) {
            throw new \RuntimeException("Error authenticating : " . $e->getMessage());
        }
    }

    public function getAuthState()
    {
        return $_SESSION["authState"];
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
                                echo $this->setAuthState($password, $username);
                                break;
                            }
                        default:
                            echo "Error";
                            break;
                    }
                }
            }
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case "getsession":
                            echo $_SESSION['authState'];
                            break;
                        default:
                            echo false;
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