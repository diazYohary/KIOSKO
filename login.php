<?php
session_start();
$user = $_POST["user"];
$pass = $_POST["password"];

require_once 'MyFirebase.php';

use MyFirebase\Firebase as Fb;

$project = 'myfirebase-a99eb-default-rtdb';
$firebase = new Fb($project);

$checkUser = $firebase->checkUser($user);
if ($checkUser == true) {
    $hashPass = hash('sha512', $pass);
    $userPass = $firebase->getPassword($user);

    if ($hashPass == $userPass) {

        if ($user == 'root') {
            # WEBHOOK
            $data = [
                "user" => $user
            ];

            $ch = curl_init("http://localhost:8081/PROYECTO/src/webhook.php");

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

            $response = curl_exec($ch);
            curl_close($ch);

            # go to admin page
            header('Location: menuAdmin.php');
            exit;
        } else {
            # webhook
            $data = [
                "user" => $user
            ];

            $ch = curl_init("http://localhost:8081/PROYECTO/src/webhook.php");

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

            $response = curl_exec($ch);
            curl_close($ch);
            # go to user page
            header('Location: home.php');
            exit;
        }
    } else {
        $_SESSION['msg'] = "Wrong password";
        header('Location: index2.php');
        exit;
    }
} else {
    $_SESSION['msg'] = "User not found";
    header('Location: index2.php');
    exit;
}