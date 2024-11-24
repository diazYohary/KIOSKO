<?php
$data=[
    "order_id"=>1234,
    "customer_name"=>"jesus",
    "total_amount"=>12.5
];

$ch=curl_init("http://localhost:8081/PROYECTO/src/webhook.php");

curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response=curl_exec($ch);
curl_close($ch);

echo "respuesta: ".$response;

?>