<?php
// Se define un string JSON con los datos a enviar
$data = '{"concepto":"Curso de PHP", "subtotal":"200", "ID":"1"}';

// Se establece la URL del endpoint donde se enviarán los datos
$url = "https://myfirebase-a99eb-default-rtdb.firebaseio.com/pruebas.json";

// Se inicializa una nueva sesión cURL
$ch = curl_init();

// Se configura la sesión cURL
curl_setopt($ch, CURLOPT_URL, $url); // Se establece la URL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Se indica que se devuelva la respuesta como una cadena
curl_setopt($ch, CURLOPT_POST, 1); // Se indica que se hará una petición POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Se establecen los datos a enviar en el cuerpo de la petición
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain')); // Se establece el tipo de contenido de los datos

// Se ejecuta la petición cURL y se almacena la respuesta
$response = curl_exec($ch);

// Se verifica si hubo algún error durante la ejecución
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    echo "Ya insertó";
}

// Se cierra la sesión cURL
curl_close($ch);
?>