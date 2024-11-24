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
        "BOK001": "Book 1",
        "BOK002": "Book 2",
        "BOK003": "Book 3"
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
        "COM001": "Comic 1",
        "COM002": "Comic 2",
        "COM003": "Comic 3"
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
        "MAG001": "Magazine 1",
        "MAG002": "Magazine 2",
        "MAG003": "Magazine 3"
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
        "MAN001": "Manga 1",
        "MAN002": "Manga 2",
        "MAN003": "Manga 3"
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
        "NWP003": "Newspaper 3"
    }
}';

$res = create_document($proyecto, $coleccion, $data);
if( !is_null($res) ) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
?>