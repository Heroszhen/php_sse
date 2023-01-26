<?php
class ConnectMysql{
    private static $pdo = null;

    private function __construct() {}

    public static function getPDO(){
        if (self::$pdo === null) {
            $config = include 'config.php';
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
        }

        return $pdo;
    }

    public static function execRequete(string $req, array $params = []){
        // Sanitize
        if ( !empty($params)){
            foreach($params as $key => $value){
                $params[$key] = trim(strip_tags($value));
            }
        }
    
        $r = self::getPDO()->prepare($req);
        $r->execute($params);
        if( !empty($r->errorInfo()[2]) ){
            die('Erreur rencontrée lors de la requête : '.$r->errorInfo()[2]);
        }
    
        return $r;
    }
}