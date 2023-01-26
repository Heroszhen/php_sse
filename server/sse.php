<?php
require_once "cors.php";
//Set file mime type event-stream
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');



set_time_limit(0); //
ob_end_clean(); //
ob_implicit_flush(1); //

$time1 = (new DateTime())->modify("+1 hour");
$time2 = (new DateTime())->modify("+1 hour")->modify("-5 second");

$req = "select * from message where created >= :time2 and created <= :time1";
$result = ConnectMysql::execRequete($req,[
    "time1" => $time1->format("y-m-d H:i:s"),
    "time2" => $time2->format("y-m-d H:i:s")
]);
$result = $result->fetchAll();
if(count($result) > 0)echo "data: ".json_encode($result)."\n\n";

//Flush buffer (force sending data to client)
//flush();

