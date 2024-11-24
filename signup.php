<?php
session_start();
$user = $_POST["user"];
$pass = $_POST["password"];
$pass2 = $_POST["password2"];

require_once 'MyFirebase.php';

use MyFirebase\Firebase as Fb;

$project = 'myfirebase-a99eb-default-rtdb';
$firebase = new Fb($project);

$checkUser = $firebase->checkUser($user);
if ($checkUser != true) {
    if ($pass == $pass2) {
        $data = '{
            "' . $user . '": "' . hash('sha512', $pass) . '"
        }';
        $newUser = $firebase->createUser($data);
        if ($newUser == true) {
            //webhook
            $data=[
                "user"=>$user
            ];
            
            $ch=curl_init("http://localhost:8081/PROYECTO/src/webhook.php");
            
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            
            $response=curl_exec($ch);
            curl_close($ch);

            header('Location: home.php');
            exit;
        } else {
            $_SESSION['msg'] = "Unknown error";
            header('Location: signup2.php');
            exit;
        }
    } else {
        $_SESSION['msg'] = "Passwords do not match";
        header('Location: signup2.php');
        exit;
    }
} else {
    $_SESSION['msg'] = "The user already exists";
    header('Location: signup2.php');
    exit;
}
