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
            $response = array("message" => "Subscription Unsuccessfull", "success" => false, "error" => "Database connection failed. Get contact with the admins.");
            echo json_encode($response);
            die();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function checkUserExists(string $email)
    {
        $query = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute((array("email" => $email)));
        $result = $query->fetch();

        return $result;
    }

    public function insertUser(string $name, string $email)
    {
        $query = $this->connection->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $query->execute((array("name" => $name, "email" => $email)));

        return ($query->rowCount() > 0);
    }
}