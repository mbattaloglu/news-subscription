<?php

require "../__config__/cors/cors.php";
require "../__config__/database/database.php";

cors();

$data = json_decode(file_get_contents("php://input"), true);
print_r($data);