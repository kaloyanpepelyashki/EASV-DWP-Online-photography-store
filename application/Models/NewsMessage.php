<?php

namespace Models;

class NewsMessage {
    private $dbClient;
    private string $newsMessageText;
    private string $newsMessageDate;

    public function __construct()
    {
        $this->dbClient = DatabaseClient::getInstance();
        $getInfo = DatabaseClient::getInstance()->getAllFromTable('news');
        $this->newsMessageText = $getInfo[0]["news"];
        $this->newsMessageDate = $getInfo[0]["date"];
    }

    public function getNewsMessage(): array|null
    {
        $newsMessage = array("newsMessageText" => $this->newsMessageText, "newsMessageDate" => $this->newsMessageDate);

        if (count($newsMessage) < 0) {
            return null;
        } else {
            return $newsMessage;
        }
    }

    //This method updates the news message. 
    //Takes as parameters the column it needs to update and the new value to update to
    public function updateNewsMessage(string $column, string $newValue)
    {
        $dbClient = $this->dbClient;

        $dbClient->updateTableById("news", 1, $column, $newValue);
    }
}

