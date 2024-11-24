<?php
session_start();
$user = $_POST["user"];
$pass = $_POST["pass"];

function create_document($project, $collection, $document) {
    $url = 'https://'.$project.'.firebaseio.com/'.$collection.'.json';

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
$coleccion = 'users';

$data = '{
    "'.$user.'": "'.hash('sha512',$pass).'"
}';
$res = create_document($proyecto, $coleccion, $data);
if( !is_null($res) ) {
    $_SESSION['auMsg'] = "User Created Successfully";
    header('Location: addUsers.php');
            exit;
} else {
    $_SESSION['auMsg'] = "ERROR";
    header('Location: addUsers.php');
            exit;
}

?>