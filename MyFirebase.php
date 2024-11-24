<?php

namespace MyFirebase;

class Firebase
{
    private $project;
    public function __construct($project)
    {
        $this->project = $project;
    }

    public function runCurl($collection, $document)
    {
        $url = 'https://' . $this->project . '.firebaseio.com/' . $collection . '/' . $document . '.json';

        $ch =  curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }
    function readData($collection)
    {
        $url = 'https://' . $this->project . '.firebaseio.com/' . $collection . '/.json';

        $ch =  curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        curl_close($ch);
        return json_decode($response, true);
    }

    function create_document($collection, $document) {
        $url = 'https://'. $this->project .'.firebaseio.com/'.$collection.'.json';
    
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
        return json_decode($response);
    }
    // CREATE USER
    public function createUser($data){
        $res=$this->create_document('users',$data);
        if (!is_null($res)) {
            return true;
        } else {
            return false;
        }
    }
    // VERIFY IN DB
    public function checkUser($name)
    {
        $res = $this->runCurl('users', $name);
        if (!is_null($res)) {
            return true;
        } else {
            return false;
        }
    }
    public function checkType($type)
    {
        $res = $this->runCurl('prod', $type);

        if (!is_null($res)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function checkDetails($code)
    {
        $res = $this->runCurl('details', $code);

        if (!is_null($res)) {
            return true;
        } else {
            return false;
        }
    }
    // GET DATA
    public function getPassword($user)
    {
        $res = $this->runCurl('users', $user);
        return $res;
    }

    public function getProducts($type)
    {
        $res = $this->runCurl('prod', $type);
        return $res;
    }

    public function getDetails($code)
    {
        $res = $this->runCurl('details', $code);
        return $res;
    }
    // LIST
    public function userList() {
        $res=$this->readData('users');
        return $res;
    }
    public function productList(){
        $res=$this->readData('details');
        return $res;
    }
    public function getMessage($code)
    {
        $res = $this->runCurl('msg', $code);
        return $res;
    }
}


$project = 'myfirebase-a99eb-default-rtdb';
$firebase = new Firebase($project);
/*
$respuesta = $firebase->obtainMessage('200');
var_dump($respuesta);
*/
