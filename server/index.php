<?php

require_once "cors.php";


$content = trim(file_get_contents("php://input"));
$json = json_decode($content, true);

$req = "insert into message (name, message) values (:name,:message)";
$result = ConnectMysql::execRequete($req,[
    "name" => $json['name'],
    "message" => $json["message"]
]);

echo 1;