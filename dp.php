<?php
session_start();
$code = $_POST["code"];
echo $code; 

function delete_document($project, $collection, $document) {
    $url = 'https://'.$project.'.firebaseio.com/'.$collection.'/'.$document.'.json';

    $ch =  curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);

    // Si no se obtuvieron resultados, entonces no existe la colección
    if( is_null(json_decode($response)) ) {
        $resBool =  false;
    } else {    // Si existe la colección, entnces se procede a eliminar la colección
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE" ); 
        curl_exec($ch);
        $resBool =  true;
    }
    curl_close($ch);
    return $resBool;
}

$proyecto = 'myfirebase-a99eb-default-rtdb';
$coleccion = 'details';
$res = delete_document($proyecto, $coleccion, $code);


$classCode = substr($code, 0, 3);
$typeProduct="null";
switch($classCode){
    case "BOK":
        $typeProduct='Books';
        break;
    case "COM":
        $typeProduct='Comics';
        break;
    case "MAG":
        $typeProduct='Magazines';
        break;
    case "MAN":
        $typeProduct='Mangas';
        break; 
    case "NWP":
        $typeProduct='Newspaper';
    break; 
}
echo $typeProduct;
$coleccion="prod";

function deleteProd($project, $collection, $document, $data) {
    $url = 'https://'.$project.'.firebaseio.com/'.$collection.'/'.$document.'/'.$data.'.json';

    $ch =  curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);

    // Si no se obtuvieron resultados, entonces no existe la colección
    if( is_null(json_decode($response)) ) {
        $resBool =  false;
    } else {    // Si existe la colección, entnces se procede a eliminar la colección
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE" ); 
        curl_exec($ch);
        $resBool =  true;
    }
    curl_close($ch);
    return $resBool;
}

$res = deleteProd($proyecto, $coleccion, $typeProduct,$code);
if($res) {
    
    $_SESSION['dpMsg'] = "Product Deleted Successfully";
            header('Location: deleteProduct.php');
            exit;
} else {
    $_SESSION['dpMsg'] = "Product not found";
        header('Location: deleteProduct.php');
        exit;
}

?>