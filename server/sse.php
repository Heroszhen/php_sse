<?php
require_once "session.php";
//Set file mime type event-stream
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');



set_time_limit(0); //防止超时
ob_end_clean(); //清空(擦除)缓冲区并关闭输出缓冲
ob_implicit_flush(1); //这个函数强制每当有输出的时候，即刻把输出发送到浏览器。这样就不需要每次输出(echo)后，都用flush()来发送到浏览器了

$time1 = (new DateTime())->modify("+1 hour");
$time2 = (new DateTime())->modify("+1 hour")->modify("-5 second");

$req = "select * from message where created >= :time2 and created <= :time1";
$result = execRequete($req,[
    "time1" => $time1->format("y-m-d H:i:s"),
    "time2" => $time2->format("y-m-d H:i:s")
]);
$result = $result->fetchAll();
echo "data: ".json_encode($result)."\n\n";

//Flush buffer (force sending data to client)
//flush();

