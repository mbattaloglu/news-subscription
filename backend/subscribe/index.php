<?php

require "../utils/validator.php";
require "../utils/sendEmail/index.php";
require "../__config__/config.php";

function saveUser()
{
    $dbObject = new DatabaseConnector(
        "YOUR-DB-HOST",
        "YOUR-DB-NAME",
        "YOUR-USERNAME",
        "YOUR-PASSWORD"
    );

    $connection = $dbObject->getConnection();

    $name = $_POST["name"];
    $email = $_POST["email"];

    try {
        $query = $connection->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute((array("email" => $email)));
        $result = $query->fetch();

        if ($result) {
            echo json_encode((array("message" => "Subscription unsuccessful.", "success" => false, "error" => "You are already subscribed.")));
            return;
        }
    } catch (Exception $e) {
        echo json_encode((array("message" => "Subscription unsuccessful.", "success" => false, "error" => "Database Error. Please try again later.")));
        return;
    }

    try {
        Validator::validateName($name);
    } catch (Exception $e) {
        echo json_encode((array("message" => "Subscription unsuccessful.", "success" => false, "error" => $e->getMessage())));
        return;
    }

    try {
        Validator::validateEmail($email);
    } catch (Exception $e) {
        echo json_encode((array("message" => "Subscription unsuccessful.", "success" => false, "error" => $e->getMessage())));
        return;
    }

    try {
        $query = $connection->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $query->execute((array("name" => $name, "email" => $email)));

        if ($query->rowCount() > 0) {
            try {
                sendEmail($email);
                echo json_encode((array("message" => "Subscription successful.", "success" => true, "error" => null)));
            } catch (Exception $e) {
                echo json_encode((array("message" => "Subscription success but information mail cannot be sent.", "success" => false, "error" => $e->getMessage())));
            }
        } else {
            echo json_encode((array("message" => "Subscription unsuccessful.", "success" => false, "error" => "Database Error. Please try again later.")));
        }
    } catch (Exception $e) {
        echo json_encode((array("message" => "Subscription unsuccessful.", "success" => false, "error" => $e->getMessage())));
    }
}

saveUser();