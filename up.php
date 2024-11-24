<?php
session_start();
$user = $_POST["user"];
$pass = $_POST["pass"];
//UPDATE
function update_document($project, $collection, $document, $fields)
{
    $url = 'https://' . $project . '.firebaseio.com/' . $collection . '/' . $document . '.json';

    $ch =  curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);

    if (!is_null(json_decode($response))) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");  // en sustitución de curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
        $response = curl_exec($ch);
    }

    curl_close($ch);

    // Se convierte a Object o NULL
    return json_decode($response);
}
//READ
function readData($project, $collection)
{
    $url = 'https://' . $project . '.firebaseio.com/' . $collection . '/.json';

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
$proyecto = 'myfirebase-a99eb-default-rtdb';
$coleccion = 'users';

$readData = readData($proyecto, $coleccion);
$data = '"' . hash('sha512', $pass) . '"';

//SEARCH USER
if (!is_null($readData)) {
    //ciclo de busqueda
    $userFound = false;
    foreach ($readData as $key => $value) {
        if ($key == $user) {
            $userFound = true;
            break;
        }
    }

    if ($userFound == true) {
        $res = update_document($proyecto, $coleccion, $user, $data);
        if (!is_null($res)) {
            $_SESSION['upMsg'] = "Updated Password";
            header('Location: updatePass.php');
            exit;
        } else {
            $_SESSION['upMsg'] = "ERROR";
            header('Location: updatePass.php');
            exit;
        }
    } else {
        $_SESSION['upMsg'] = "User not found";
        header('Location: updatePass.php');
        exit;
    }
} else {
    echo '<br>No se encontraron resultados<br>';
}
