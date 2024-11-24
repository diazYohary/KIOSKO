<?php
require_once 'MyFirebase.php';
use MyFirebase\Firebase as Fb;

$project = 'myfirebase-a99eb-default-rtdb';
$firebase = new Fb($project);

$res=$firebase->getUser("root");
echo $res;


