<?php

require "../utils/validator.php";
require "../utils/sendEmail/index.php";
require "../__config__/config.php";

function saveUser()
{
    $db = new DatabaseConnector(
        "YOUR-DB-HOST",
        "YOUR-DB-NAME",
        "YOUR-USERNAME",
        "YOUR-PASSWORD"
    );

    $response = array("message" => "Subscription Unsuccessfull", "success" => false, "error" => "");

    $connection = $db->getConnection();

    $name = "";
    $email = "";

    if (isset($_POST["name"]))
        $name = $_POST["name"];


    if (isset($_POST["email"]))
        $email = $_POST["email"];
    // No need else because if they are not set validators will throw error.

    try {
        $query = $connection->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute((array("email" => $email)));
        $result = $query->fetch();

        if ($result) {
            $response["error"] = "You are already subscribed.";
            echo json_encode($response);
            return;
        }
    } catch (Exception $e) {
        $response["error"] = "Database connection error. Please try again later.";
        echo json_encode($response);
        return;
    }

    try {
        Validator::validateName($name);
    } catch (Exception $e) {
        $response["error"] = $e->getMessage();
        echo json_encode($response);
        return;
    }

    try {
        Validator::validateEmail($email);
    } catch (Exception $e) {
        $response["error"] = $e->getMessage();
        echo json_encode($response);
        return;
    }

    try {
        $query = $connection->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $query->execute((array("name" => $name, "email" => $email)));

        if ($query->rowCount() > 0) {
            $response["success"] = true;
            try {
                sendEmail($email);
                $response["message"] = "Subscription successful.";
                $response["error"] = null;
            } catch (Exception $e) {
                $response["message"] = "Subscription successful but notification mail cannot be sent.";
                $response["error"] = $e->getMessage();
            }
        } else {
            $response["error"] = "Database connection error. Please try again later.";
        }
    } catch (Exception $e) {
        $response["error"] = "Database connection error. Please try again later.";
    }
    echo json_encode($response);
}

saveUser();