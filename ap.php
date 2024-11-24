<?php
require_once 'MyFirebase.php';
use MyFirebase\Firebase as Fb;

$project = 'myfirebase-a99eb-default-rtdb';
$firebase = new Fb($project);
session_start();

$prod = $_POST["prod"];
$title = $_POST["title"];
$author = $_POST["author"];
$publisher = $_POST["publisher"];
$pdate = $_POST["pdate"];


function create_document($project, $collection, $document, $index) {
    $url = 'https://' . $project . '.firebaseio.com/' . $collection . '/' . $index . '.json';

    $ch =  curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH" );  // en sustitución de curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $document);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);

    curl_close($ch);

    // Se convierte a Object o NULL
    return json_decode($response);
}

$proyecto = 'myfirebase-a99eb-default-rtdb';
$coleccion = 'prod';

$nProd = $firebase->getProducts($prod);
$cProd=0;
if (!is_null($nProd)) {
    foreach ($nProd as $key => $value) {
        $cProd++;
    }
} else {
    echo '<br>No se encontraron resultados<br>';
}
echo "Numero de ".$prod.": ".$cProd;
echo "nuevo n de ".$prod.": ".$cProd+1;

$cod;
switch ($prod) {
    case "Books":
        $cod='BOK00';
        break;
    case "Comics":
        $cod='COM00';
        break;
    case "Magazines":
        $cod='MAG00';
        break;
    case "Mangas":
        $cod='MAN00';
        break; 
    case "Newspaper":
        $cod='NWP00';
    break;  
}

$index=strval($cod.($cProd+1));
$data = '{
    "'. $index .'": "'. $title .'"
}';
echo $data;
$res = create_document($proyecto, $coleccion, $data, $prod);

if( !is_null($res) ) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}

$coleccion='details';
$data = '{
    "Title": "'. $title .'",
    "Author": "'. $author .'",
    "Publisher": "'. $publisher .'",
    "Publication Date": "'. $pdate .'"
}';
echo $data;
$res = create_document($proyecto, $coleccion, $data, $index);


if( !is_null($res) ) {
    $_SESSION['apMsg'] = "Product Added Successfully";
    header('Location: addProduct.php');
            exit;
} else {
    $_SESSION['apMsg'] = "ERROR";
    header('Location: addProduct.php');
            exit;
}
