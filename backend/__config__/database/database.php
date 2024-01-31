<?php

class DatabaseConnector
{
    private $connection = null;
    private $hostName = "";
    private $databaseName = "";
    private $username = "";
    private $password = "";
    public function __construct(
        string $hostName,
        string $databaseName,
        string $username,
        string $password,
    ) {
        $this->hostName = $hostName;
        $this->databaseName = $databaseName;
        $this->username = $username;
        $this->password = $password;

        try {
            $this->connection = new PDO(`mysql:hostname=$this->hostName;dbname=$this->databaseName;charset=utf8`, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "" . $e->getMessage();
            die();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}