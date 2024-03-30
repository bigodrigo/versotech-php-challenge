<?php

class Connection {
    private $databaseFile;
    private $connection;

    public function __construct()
    {
        $this->databaseFile = realpath(__DIR__ . "/database/db.sqlite");
        $this->connect();
    }

    private function connect()
    {
        return $this->connection = new PDO("sqlite:{$this->databaseFile}");
    }

    public function getConnection()
    {
        return $this->connection ?: $this->connection = $this->connect();
    }

    public function query($query)
    {
        $result = $this->getConnection()->query($query);
        $result->setFetchMode(PDO::FETCH_OBJ);
        return $result;
    }

    public function disconnect()
    {
        $this->connection = null; // Set the connection to null to close it
    }

    public function migrate()
    {
        // Run migrations
        $migrations = file_get_contents(__DIR__ . '/migrations/create_table_colors.sql');
        $this->query($migrations);
    }

    public function seed()
    {
        // Run seeds
        $seeds = file_get_contents(__DIR__ . '/seeds/insert_colors_seed.sql');
        $this->query($seeds);
    }
}

class Migration {
    public static function run()
    {
        try {
            $connection = new Connection();
            $connection->migrate();
            $connection->disconnect();
        } catch (PDOException $e) {
            echo "Migration failed: " . $e->getMessage();
        }
    }
}

class Seed {
    public static function run()
    {
        try {
            $connection = new Connection();
            $connection->seed();
            $connection->disconnect();
        } catch (PDOException $e) {
            echo "Seed failed: " . $e->getMessage();
        }
    }
}