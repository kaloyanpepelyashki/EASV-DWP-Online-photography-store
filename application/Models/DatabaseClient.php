<?php
namespace Models;

//Requires the path to the autoload.php, where the supabase library is initialized
require_once __DIR__ . '/../vendor/autoload.php';

//Class that holds all of the interaction with database
//DON'T INSTANTIATE WITH NEW Class();
class DatabaseClient
{
    private static $instance;
    private $supabaseUrl;
    private string $supabaseApiKey = " ";

    protected function __construct()
    {
        $this->supabaseUrl = "https://vuuiepkmjneplgvssvhc.supabase.co/rest/v1/";
        $this->supabaseApiKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InZ1dWllcGttam5lcGxndnNzdmhjIiwicm9sZSI6ImFub24iLCJpYXQiOjE2OTkzNDA4ODIsImV4cCI6MjAxNDkxNjg4Mn0.QfI5GY0eWPmpG9XBpuUy7yTQHwSlJRtGtnk0bkwQtmU";
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

    //BL methods 
    public function getAllFromTable(string $table): array|null
    {
        try {

            $context = stream_context_create([
                'http' => [
                    'header' => [
                        'Content-Type: application/json',
                        'apikey: ' . $this->supabaseApiKey,
                    ],
                    'method' => 'GET',
                ],
            ]);
            $response = file_get_contents("{$this->supabaseUrl}/{$table}?select=*", false, $context);

            if (!$response) {
                // Handle error
                echo "Error querying data";
                //in case of error it returns an empty array
                return [];
            } else {
                // Access the data
                $data = json_decode($response, true);
                return $data;
            }
        } catch (\Exception $e) {
            echo "Error retreiving data: {$e->getMessage()}";
            throw new \RuntimeException("Error retrieving data: {$e->getMessage()}", $e->getCode(), $e);
        }

    }

}