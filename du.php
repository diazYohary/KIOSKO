<?php
session_start();
$user = $_POST["user"];

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

    // Se devuelve true o false
    return $resBool;
}

$proyecto = 'myfirebase-a99eb-default-rtdb';
$coleccion = 'users';

$res = delete_document($proyecto, $coleccion, $user);
if( $res ) {
    $_SESSION['duMsg'] = "User Deleted Successfully";
            header('Location: deleteUser.php');
            exit;
} else {
    $_SESSION['duMsg'] = "User not found";
        header('Location: deleteUser.php');
        exit;
}
?>