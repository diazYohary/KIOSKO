<?php
function processWebhook($data) {
    if (isset($data['user'])) {
        $user = $data['user'];

        file_put_contents(__DIR__ . '/../log/webhookLog.txt', 
            "USER LOGIN: $user." . PHP_EOL, FILE_APPEND);
    }
}
?>