<?php
function readData($project,$collection){
    $url = 'https://'.$project.'.firebaseio.com/'.$collection.'/.json';

    $ch =  curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);

    curl_close($ch);

    // Se convierte a Object o NULL
    return json_decode($response, true);
}
function read_document($project, $collection, $document) {
    $url = 'https://'.$project.'.firebaseio.com/'.$collection.'/'.$document.'.json';

    $ch =  curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);

    curl_close($ch);

    // Se convierte a Object o NULL
    return json_decode($response);
}

$proyecto = 'myfirebase-a99eb-default-rtdb';
$coleccion = 'users';

$res = readData($proyecto, $coleccion);
if(!is_null($res)) {
    foreach ($res as $key => $value) {
        echo $key.": ".$value;
        //print_r($value); // Print each element for demonstration
        echo "<br>";
      }
} else {
    echo '<br>No se encontraron resultados<br>';
}

?>