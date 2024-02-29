<?php

namespace Models;

// Load environment variables from the .env file
$envFile = __DIR__ . '../../.env';
$lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    // If the line is a comment, skip it
    if (strpos(trim($line), '#') === 0) {
        continue;
    }
    list($name, $value) = explode('=', $line, 2);
    $name = trim($name);
    $value = trim($value);
    putenv("$name=$value");
}

class DatabaseClient
{
    // Singleton instance
    private static $instance;

    // Database connection parameters
    private string $host;
    private int $port;
    private string $user;
    private string $password;
    private $dbConnection;

    // Constructor is protected to enforce singleton pattern
    protected function __construct()
    {
        // Set default database connection parameters
        $this->host = "mysql23.unoeuro.com";
        $this->port = 3306;
        $this->user = "okonord_dk";
        $this->password = "Afwcpyadm2RrFHteb5kD";

        // Establishing connection to the MySQL database
        $this->dbConnection = mysqli_connect($this->host, $this->user, $this->password, 'mysqli', $this->port);

        // Check if the connection is successful
        if (!$this->dbConnection) {
            die("Error connecting to MySQL database: " . mysqli_connect_error());
        }
    }

    // Clone method is private to enforce singleton pattern
    protected function __clone()
    {
    }

    // Get singleton instance of DatabaseClient
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Close the database connection
    public function closeConnection()
    {
        mysqli_close($this->dbConnection);
    }

    // Business Logic methods

    // This method returns all items from a table
    public function getAllFromTable(string $table): array|null
    {
        try {
            // Construct and execute the SELECT query
            $query = "SELECT * FROM $table";
            $result = mysqli_query($this->dbConnection, $query);

            // Check if the query is successful
            if (!$result) {
                die("Query failed: " . mysqli_error($this->dbConnection));
            }

            // Fetch all rows as associative array
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Free the result set
            mysqli_free_result($result);

            return $data;
        } catch (\Exception $e) {
            echo "Error retrieving data: {$e->getMessage()}";
            throw new \RuntimeException("Error retrieving data: {$e->getMessage()}", $e->getCode(), $e);
        }
    }

    // Gets an item from a table based on ID
    public function getSpecificID_FromTable(string $table, int $id)
    {
        try {
            // Construct and execute the SELECT query with a WHERE clause
            $query = "SELECT * FROM $table WHERE id=$id";
            $result = mysqli_query($this->dbConnection, $query);

            // Check if the query is successful
            if (!$result) {
                die("Query failed: " . mysqli_error($this->dbConnection));
            }

            // Fetch all rows
            $data = mysqli_fetch_all($result);

            // Free the result set
            mysqli_free_result($result);

            return $data;
        } catch (\Exception $e) {
            echo "Error retrieving data: {$e->getMessage()}";
            throw new \RuntimeException("Error retrieving data: {$e->getMessage()}", $e->getCode(), $e);
        }
    }

    // Updates a table based on a new value
    public function updateTableById(string $table, int $idToUpdate, string $columnToUpdate, string $newValue)
    {
        try {
            // Construct and execute the UPDATE query
            $query = "UPDATE $table SET $columnToUpdate='$newValue' WHERE id=$idToUpdate";
            $result = mysqli_query($this->dbConnection, $query)($this->dbConnection, $query);

            // Check if the query is successful
            if (!$result) {
                die("Query failed, update table by id" . mysqli_error($this->dbConnection));
            }

            // Fetch all rows
            $data = mysqli_fetch_all($result);

            // Free the result set
            mysqli_free_result($result);

            return $data;
        } catch (\PDOException $e) {
            echo "Error updating data: {$e->getMessage()}";
            throw new \RuntimeException("Error updating data: {$e->getMessage()}", $e->getCode(), $e);
        }
    }

    // Inserts into a table
    public function insertIntoTable(string $table, array $items)
    {
        // Helper function to get keys of an array as a string
        function getArrayKeys($items)
        {
            return "'" . implode("', '", array_keys($items)) . "'";
        }

        // Helper function to get values of an array as a string
        function getArrayValues(array $items)
        {
            return "'" . implode("', '", array_values($items)) . "'";
        }

        try {
            // Construct and execute the INSERT query
            $query = "INSERT INTO $table (" . getArrayKeys($items) . ") VALUES ( " . getArrayValues($items) . ")";
            $result = mysqli_query($this->dbConnection, $query);

            // Check if the query is successful
            if (!$result) {
                die("Query failed, insert into $table" . mysqli_last_error());
            }
        } catch (\Exception $e) {
            throw new \RuntimeException("Error inserting into table: " . $e->getMessage());
        }
    }

    // Authentication method for authenticating an admin using the database
    public function AuthenticationLogIn(string $password, string $username): bool
    {
        try {
            // Construct and execute the SELECT query with parameters
            $query = "SELECT * FROM administrators WHERE password=$1 AND username=$2";
            $result = mysqli_query_params($this->dbConnection, $query, array($password, $username));

            // Check if the query is successful
            if (!$result) {
                echo "Error connecting to database" . mysqli_last_error();
                die("Error connecting to database" . mysqli_last_error());
            } else {
                // Fetch the first row as an associative array
                $row = mysqli_fetch_assoc($result);
                return $row !== false;
            }
        } catch (\PDOException $e) {
            throw new \RuntimeException("Error authenticating: " . $e->getMessage());
        }
    }
}
