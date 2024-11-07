<?php

namespace Classes;


use SQLite3;
use Classes\Deck;
use SQLite3Result;

class DataBase {

    public const DATABASE_FILE = "db.sqlite";

    private SQLite3 $_sqlite3;

    public function __construct()
    {
        $this -> _sqlite3 = new SQLite3(self::DATABASE_FILE, SQLITE3_OPEN_READWRITE);
    }

    public function __destruct()
    {
        $this -> _sqlite3 -> close();
    }


    public function ExecuteInstallQuery(string $query):bool {
        return $this -> _sqlite3 -> exec($query);
    }

    public function DefaultDescription () {
        $default = <<<DEFAULT
            <div class="output-container-item">
            <h1>Добро пожаловать в органайзер задач</h1>
            </div>
            <div class="output-container-item task-list">
            <p class="main-text">Этот органайзер поможет вам следить за задачами и не забывать о них. Приятного пользования</p>
            </div>
        DEFAULT;

        echo ($default);
        return;
    }

    public function SendToArchive ($ID) {

        $queryName = <<<TASK_NAME_QUERY
        SELECT Name
        FROM Tasks
        WHERE ID="$ID"
        TASK_NAME_QUERY;

        $queryDescription = <<<TASK_DESCRIPTION_QUERY
        SELECT Description
        FROM Tasks
        WHERE ID="$ID"
        TASK_DESCRIPTION_QUERY;
        
        $queryDate = <<<TASK_DATE_QUERY
        SELECT Date
        FROM Tasks
        WHERE ID="$ID"
        TASK_DATE_QUERY;
        
        $queryState = <<<TASK_STATE_QUERY
        SELECT State
        FROM Tasks
        WHERE ID="$ID"
        TASK_STATE_QUERY;

        $rowToArchiveName = $this -> _sqlite3 -> query($queryName);
        $rowToArchiveDescription = $this -> _sqlite3 -> query($queryDescription);
        $rowToArchiveDate = $this -> _sqlite3 -> query($queryDate);
        $rowToArchiveState = $this -> _sqlite3 -> query($queryState);
    }

    public function SendToExpired () {
        ;
    }

    public function SortTasks () {
        ;
    }
}