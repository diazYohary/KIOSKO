<?php
$logFile=__DIR__.'/../log/webhookLog.txt';
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data) {
    file_put_contents($logFile, date('Y-m-d H:i:s')."-WEBHOOK RECEIVED: ".json_encode($data).PHP_EOL, FILE_APPEND);
    require_once 'processWebhook.php';
    processWebhook($data);

    http_response_code(200);
    echo json_encode(['message' => 'WEBHOOK RECEIVED'])."\n";
} else {
    http_response_code(400);
    echo json_encode(['message' => 'WEBHOOK ERROR'])."\n";
}

?>