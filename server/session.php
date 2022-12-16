<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
header("Content-Type: application/json; charset=utf-8");


function execRequete(string $req, array $params = []){
    // Sanitize
    if ( !empty($params)){
        foreach($params as $key => $value){
            $params[$key] = trim(strip_tags($value));
        }
    }

    $config = [
        "host" => "localhost:8889",
        "dbname" => "sse",
        "username" => "root",
        "password" => "root"
    ];
    $pdo = new PDO(
        'mysql:host='.$config["host"].';dbname='.$config["dbname"],
        $config["username"],
        $config["password"],
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        )
    );

    //global $pdo;

    $r = $pdo->prepare($req);
    $r->execute($params);
    if( !empty($r->errorInfo()[2]) ){
        die('Erreur rencontrée lors de la requête : '.$r->errorInfo()[2]);
    }

    return $r;
}