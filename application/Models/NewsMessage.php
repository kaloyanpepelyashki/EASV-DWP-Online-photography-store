<?php

namespace Models;

class NewsMessage {
    private $dbClient;
    private string $newsMessageText;
    private string $newsMessageDate;

    /**
     * Constructs a new NewsMessage object.
     * Initializes the database client and retrieves the news message and date from the database.
     */
    public function __construct()
    {
        // Get an instance of the DatabaseClient
        $this->dbClient = DatabaseClient::getInstance();
        
        // Retrieve information from the 'news' table
        $getInfo = $this->dbClient->getAllFromTable('news');
        
        // Assign the retrieved news message and date to the corresponding properties
        $this->newsMessageText = $getInfo[0]["news"];
        $this->newsMessageDate = $getInfo[0]["date"];
    }

    /**
     * Retrieves the news message and date.
     * Returns an array containing the news message text and date, or null if no news message is found.
     *
     * @return array|null The news message and date.
     */
    public function getNewsMessage(): array|null
    {
        // Create an array containing the news message text and date
        $newsMessage = array("newsMessageText" => $this->newsMessageText, "newsMessageDate" => $this->newsMessageDate);

        // Check if the newsMessage array is empty
        if (count($newsMessage) < 0) {
            return null;
        } else {
            return $newsMessage;
        }
    }

    /**
     * Updates the news message in the database.
     *
     * @param string $column The column to update.
     * @param string $newValue The new value to update to.
     */
    public function updateNewsMessage(string $column, string $newValue)
    {
        // Get an instance of the DatabaseClient
        $dbClient = $this->dbClient;

        // Update the news message in the 'news' table
        $dbClient->updateTableById("news", 1, $column, $newValue);
    }
}
