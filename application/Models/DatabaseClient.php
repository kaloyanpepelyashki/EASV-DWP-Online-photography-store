<?php

namespace Models;



//Class that holds all of the interaction with database
//DON'T INSTANTIATE WITH "new DatabaseClient()";
//Instead use "DatabaseClient::getInstance()";
class DatabaseClient
{
    private static $instance;
    private string $supabaseUrl;
    private $port;
    private string $user;
    private string $password;
    private string $supabaseApiKey;
    private $dbConnection;

    protected function __construct()
    {
        $this->supabaseUrl = "https://vuuiepkmjneplgvssvhc.supabase.co/rest/v1/";
        $this->supabaseApiKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InZ1dWllcGttam5lcGxndnNzdmhjIiwicm9sZSI6ImFub24iLCJpYXQiOjE2OTkzNDA4ODIsImV4cCI6MjAxNDkxNjg4Mn0.QfI5GY0eWPmpG9XBpuUy7yTQHwSlJRtGtnk0bkwQtmU";
        $this->port = 5432;
        $this->user = "postgres";
        $this->password = "DWP_1244_p2121";

        //Establishing connection to the database
        $this->dbConnection = pg_connect("user=$this->user password=$this->password host=db.vuuiepkmjneplgvssvhc.supabase.co port=$this->port dbname=postgres");

        //Checking if the connection was not established
        if (!$this->dbConnection) {
            die("Error connecting to database:" . pg_last_error());
        }

    }

    protected function __clone()
    {
    }

    //The static method for getting instance
    public static function getInstance()
    {

        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function closeConnection()
    {
        pg_close($this->dbConnection);
    }

    //Bussiness Logic methods

    //This method returns all items from a table
    //The table is being specified as a string argument
    public function getAllFromTable(string $table): array|null
    {
        try {

            $query = "SELECT * FROM $table";

            $result = pg_query($this->dbConnection, $query);

            if (!$result) {
                die("Query failed: " . pg_last_error());
            }
            $data = pg_fetch_all($result);

            // Free the result set
            pg_free_result($result);

            // Close the database connection
            // pg_close($this->dbConnection);

            return $data;
            // //We query the data with a simple http get request
        } catch (\Exception $e) {
            //Handling exceptions in the catch block
            echo "Error retreiving data: {$e->getMessage()}";
            throw new \RuntimeException("Error retrieving data: {$e->getMessage()}", $e->getCode(), $e);
        }

    }

    //Gets an item from a table based on ID
    public function getSpecificID_FromTable(string $table, int $id)
    {
        try {

            $query = "SELECT * FROM $table WHERE id=$id";

            $result = pg_query($this->dbConnection, $query);

            if (!$result) {
                die("Query failed: " . pg_last_error());
            }
            $data = pg_fetch_all($result);

            // Free the result set
            pg_free_result($result);

            // Close the database connection
            // pg_close($this->dbConnection);

            return $data;

        } catch (\Exception $e) {
            echo "Error retreiving data: {$e->getMessage()}";
            throw new \RuntimeException("Error retrieving data: {$e->getMessage()}", $e->getCode(), $e);
        }
    }

    public function testMethod(string $table)
    {
        try {
            $query = "SELECT * FROM $table";

            $result = pg_query($this->dbConnection, $query);

            if (!$result) {
                die("Query failed: " . pg_last_error());
            }
            $data = pg_fetch_all($result);

            // Free the result set
            pg_free_result($result);

            // Close the database connection
            // pg_close($this->dbConnection);

            return $data;

        } catch (\Exception $e) {
            echo "Error retreiving data: {$e->getMessage()}";
            throw new \RuntimeException("Error retrieving data: {$e->getMessage()}", $e->getCode(), $e);
        }
    }

}