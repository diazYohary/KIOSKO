<?php
$password = "123";
echo $password."<br>";
$hash = hash('sha512', $password);
echo $hash."<br>";

$password = "hola";
echo $password."<br>";
$hash = hash('sha512', $password);
echo $hash."<br>";

$password = "pass";
echo $password."<br>";
$hash = hash('sha512', $password);
echo $hash."<br>";
?>
