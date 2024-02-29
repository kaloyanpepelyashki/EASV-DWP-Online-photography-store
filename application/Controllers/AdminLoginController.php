<?php
namespace Controllers;

use Models as M;

// Include the DatabaseClient class
require_once(__DIR__ . '/../Models/DatabaseClient.php');

class AdminLoginController
{
    // DatabaseClient instance for database operations
    private $dbClient;

    // Constructor initializes the database client and calls init method
    public function __construct()
    {
        $this->dbClient = M\DatabaseClient::getInstance();
        $this->init();
    }

    // Initializes the session and sets default values
    private function init()
    {
        // Checks if a session is set
        if (session_status() == PHP_SESSION_NONE) {
            // If it's not, it starts the session
            session_start();
        }

        // Checks if $_SESSION['authState'] is already set
        if (!isset($_SESSION['authState'])) {
            // If it is not, it sets it to false
            $_SESSION['authState'] = false;
        }
    }

    // Performs user sign-in with password and username
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
            // Handle and log any exceptions
            echo "Error: " . $e->getMessage();
            throw new \RuntimeException("Error authenticating:" . $e->getMessage());
        }
    }

    // Updates the authentication state based on user sign-in
    public function setAuthState(string $password, string $username): bool
    {
        try {
            if ($this->signIn($password, $username)) {
                // If sign-in is successful, set authState to true
                $_SESSION["authState"] = true;
                return $this->signIn($password, $username);
            } else {
                // If sign-in fails, set authState to false
                $_SESSION["authState"] = false;
                return false;
            }
        } catch (\Exception $e) {
            // Handle and log any exceptions
            throw new \RuntimeException("Error authenticating : " . $e->getMessage());
        }
    }

    // Retrieves the current authentication state
    public function getAuthState()
    {
        return $_SESSION["authState"];
    }

    // Handles controller interaction based on HTTP request method and action
    public function handleControllerInteraction()
    {
        try {
            // Check if the request method is POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Check if 'action' is set in the POST data
                if (isset($_POST['action'])) {
                    // Switch statement to handle different actions
                    switch ($_POST['action']) {
                        case "signin":
                            // Extract username and password from the creditObject JSON
                            $creditObject = json_decode($_POST['creditObject'], true);

                            if ($creditObject !== null) {
                                $username = $creditObject['username'];
                                $password = $creditObject['password'];
                                
                                // Set the authentication state based on sign-in attempt
                                echo $this->setAuthState($password, $username);
                                break;
                            }
                        default:
                            echo "Error";
                            break;
                    }
                }
            }
            
            // Check if the request method is GET
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                // Check if 'action' is set in the GET data
                if (isset($_GET['action'])) {
                    // Switch statement to handle different actions
                    switch ($_GET['action']) {
                        case "getsession":
                            // Return the current authState value
                            echo $_SESSION['authState'];
                            break;
                        default:
                            echo false;
                    }
                }
            }
        } catch (\Exception $e) {
            // Handle and log any exceptions
            throw new \RuntimeException("Error authenticating : " . $e->getMessage());
        }
    }
}

// Create an instance of AdminLoginController
$controller = new AdminLoginController();

// Handle the controller interaction based on the current request
$controller->handleControllerInteraction();
