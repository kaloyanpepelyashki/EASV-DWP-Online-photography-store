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

/**
 * Class DatabaseClient
 * 
 * Represents a client for interacting with the database.
 */
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

    /**
     * DatabaseClient constructor.
     * 
     * Initializes the database connection parameters and establishes a connection to the MySQL database.
     */
    protected function __construct()
    {
        // Set default database connection parameters
        $this->host = "db";
        $this->port = 3306;
        $this->user = "user";
        $this->password = "user";
        $this->database = "store";

        // Establishing connection to the MySQL database
        $this->dbConnection = mysqli_connect($this->host, $this->user, $this->password, $this->database, $this->port);

        // Check if the connection is successful
        if (!$this->dbConnection) {
            die("Error connecting to MySQL database: " . mysqli_connect_error());
        }
    }

    /**
     * DatabaseClient clone method.
     * 
     * Prevents cloning of the DatabaseClient instance.
     */
    protected function __clone()
    {
    }

    /**
     * Get singleton instance of DatabaseClient.
     * 
     * @return DatabaseClient The singleton instance of DatabaseClient.
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Close the database connection.
     */
    public function closeConnection()
    {
        mysqli_close($this->dbConnection);
    }

    // Business Logic methods

    /**
     * Get all items from a table.
     * 
     * @param string $table The name of the table.
     * @return array|null The array of items from the table, or null if the query fails.
     * @throws \RuntimeException If there is an error retrieving the data.
     */
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

    /**
     * Get an item from a table based on ID.
     * 
     * @param string $table The name of the table.
     * @param int $id The ID of the item.
     * @return array The item from the table.
     * @throws \RuntimeException If there is an error retrieving the data.
     */
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

    /**
     * Update a table based on a new value.
     * 
     * @param string $table The name of the table.
     * @param int $idToUpdate The ID of the item to update.
     * @param string $columnToUpdate The column to update.
     * @param string $newValue The new value.
     * @return array The updated data.
     * @throws \RuntimeException If there is an error updating the table.
     */
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

    /**
     * Insert into a table.
     * 
     * @param string $table The name of the table.
     * @param array $items The items to insert.
     * @throws \RuntimeException If there is an error inserting into the table.
     */
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

    /**
     * Authentication method for authenticating an admin using the database.
     * 
     * @param string $password The admin's password.
     * @param string $username The admin's username.
     * @return bool True if the authentication is successful, false otherwise.
     * @throws \RuntimeException If there is an error authenticating.
     */
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
