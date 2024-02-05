<?php

require "../__config__/cors/cors.php";
require "../__config__/database/database.php";

header('Content-type: application/json');

corsHandler();

//In case if developer sends data with JSON 
$data = json_decode(file_get_contents("php://input"), true);
print_r($data);