<?php
require_once "ConnectMysql.php";
$info = include 'config.php';

try{
    $dbh = new PDO("mysql:host={$info['host']}", $info['username'], $info['password']);
    $dbh->exec("CREATE DATABASE {$info['dbname']}");
    $sql = "CREATE TABLE IF NOT EXISTS  message(
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(250) NOT NULL DEFAULT '',
        message VARCHAR(250) NOT NULL DEFAULT '',
        created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )DEFAULT CHARSET='utf8mb4'";
    $pdo = ConnectMysql::getPDO();
    $pdo->exec($sql);
}catch(PDOException $e){

}

