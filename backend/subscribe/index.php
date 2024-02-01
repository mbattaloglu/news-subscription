<?php

require "../utils/validator.php";
require "../utils/sendEmail/index.php";
require "../__config__/config.php";
require "../response/response.php";

function sendResponse()
{
    global $response;
    echo json_encode($response->genereateResponseJSON());
    exit; //terminate
}

$databaseError = "Database connection error. Please try again later";

$db = new DatabaseConnector(
    "YOUR-DB-HOST",
    "YOUR-DB-NAME",
    "YOUR-USERNAME",
    "YOUR-PASSWORD"
);

$response = new Response(
    "Subscription Unsuccessfull", //message
    false, //success
    $databaseError //error
);

$name = "";
$email = "";

if (isset($_POST["name"]))
    $name = $_POST["name"];


if (isset($_POST["email"]))
    $email = $_POST["email"];
// No need else because if they are not set validators will throw error.

try {
    if ($db->checkUserExists($email)) {
        $response->setError("You are already subscribed.");
        sendResponse();
    }
} catch (Exception $e) {
    sendResponse();
}

try {
    Validator::validateName($name);
} catch (Exception $e) {
    $response->setError($e);
    sendResponse();
}

try {
    Validator::validateEmail($email);
} catch (Exception $e) {
    $response->setError($e);
    sendResponse();
}

try {
    if ($db->insertUser($name, $email)) {
        $response->setSuccess(true);
        try {
            sendEmail($email);
            $response->setMessage("Subscription successful.");
        } catch (Exception $e) {
            $response->setMessage("Subscription successful but notification mail cannot be sent.");
            $response->setError($e);
        }
    }
} finally { // we can directly return the response without catching errors. Response is already set to database error.
    sendResponse();
}
