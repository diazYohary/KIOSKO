<?php
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
$coleccion = 'prod';

//BOOKS
$data = '{
    "Books": {
        "BOK001": "Pedro Páramo",
        "BOK002": "Crime and Punishment",
        "BOK003": "La Biblioteca De La Medianoche",
        "BOK004": "Metamorfosis",
        "BOK005": "El gran Gatsby",
        "BOK006": "La tregua",
        "BOK007": "Neuromancer",
        "BOK008": "The Last Unicorn",
        "BOK009": "The Poisonwood Bible: A Novel"
    }
}';

$res = create_document($proyecto, $coleccion, $data);
if( !is_null($res) ) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}

//COMICS
$data = '{
    "Comics": {
        "COM001": "Batman #13",
        "COM002": "Ultimate Spider-Man Vol.01",
        "COM003": "The Complete Emily the Strange: All Things Strange",
        "COM004": "Fahrenheit 451",
        "COM005": "Batman the Killing Joke",
        "COM006": "Watchmen ",
        "COM007": "Spawn Compendium Volume 6"
    }
}';

$res = create_document($proyecto, $coleccion, $data);
if( !is_null($res) ) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
//MAGAZINES
$data = '{
    "Magazines": {
        "MAG001": "LIFE 11-23-1936",
        "MAG002": "ROLLING STONE #199",
        "MAG003": "TRASHER Magazine",
        "MAG004": "Vogue USA Magazine May 2024 Zendaya",
        "MAG005": "Time Magazine May 27, 2024"
    }
}';

$res = create_document($proyecto, $coleccion, $data);
if( !is_null($res) ) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}

//MANGA
$data = '{
    "Mangas": {
        "MAN001": "Berserk N.16",
        "MAN002": "Spy X Family N.3",
        "MAN003": "Chain Saw Man N.17",
        "MAN004": "Demon Slayer N.1 ",
        "MAN005": "One Punch Man - N.30"
    }
}';

$res = create_document($proyecto, $coleccion, $data);
if( !is_null($res) ) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}

//NEWSPAPER
$data = '{
    "Newspaper": {
        "NWP001": "Newspaper 1",
        "NWP002": "Newspaper 2",
        "NWP003": "Newspaper 3",
        "NWP004": "Newspaper 4",
        "NWP005": "Newspaper 5",
        "NWP006": "Newspaper 6",
        "NWP007": "Newspaper 7",
        "NWP008": "Newspaper 8",
        "NWP009": "Newspaper 9",
        "NWP0010": "Newspaper 10",
        "NWP0011": "Newspaper 11",
        "NWP0012": "Newspaper 12",
        "NWP0013": "Newspaper 13"
    }
}';

$res = create_document($proyecto, $coleccion, $data);
if( !is_null($res) ) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
