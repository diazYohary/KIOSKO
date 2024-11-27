<?php
$logFile = __DIR__ . '/log/webhookLog.txt';
$logs = file_get_contents($logFile);
echo $logs ? $logs : "EMPTY LOGS";
?>