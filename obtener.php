<?php
// Se establece la URL de la API de Firebase donde se encuentran los presupuestos
$url = "https://myfirebase-a99eb-default-rtdb.firebaseio.com/pruebas.json";

// Se inicializa una nueva sesión cURL para hacer la petición HTTP
$ch = curl_init();

// Se configura la sesión cURL para realizar una petición GET a la URL especificada
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Para obtener la respuesta como una cadena

// Se ejecuta la petición y se almacena la respuesta en la variable $response
$response = curl_exec($ch);

// Se cierra la sesión cURL
curl_close($ch);

// Se decodifica la respuesta JSON en un array asociativo
$data = json_decode($response, true);

// Se itera sobre los datos y se muestra el concepto y el ID de cada presupuesto
foreach ($data as $key => $value) {
    echo $data[$key]["concepto"] . " - " . $data[$key]["ID"] . "<br>";
}
?>