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
$coleccion = 'details';


//BOOKS
for ($i = 1; $i <= 3; $i++) {
    $data = '{
        "BOK00'.$i.'": {
            "Title": "Book '.$i.'",
            "Author": "Author Name",
            "Publisher": "Publisher Name",
            "Publication Date": 2002
        } 
    }';

    $res = create_document($proyecto, $coleccion, $data);
    if (!is_null($res)) {
        echo '<br>Insersión exitosa<br>';
    } else {
        echo '<br>Insersión fallida<br>';
    }
}

//COMICS
for ($i = 1; $i <= 3; $i++) {
    $data = '{
        "COM00'.$i.'": {
            "Title": "Comic '.$i.'",
            "Author": "Author Name",
            "Publisher": "Publisher Name",
            "Publication Date": 2002
        } 
    }';

    $res = create_document($proyecto, $coleccion, $data);
    if (!is_null($res)) {
        echo '<br>Insersión exitosa<br>';
    } else {
        echo '<br>Insersión fallida<br>';
    }
}

//MAGAZINES
for ($i = 1; $i <= 3; $i++) {
    $data = '{
        "MAG00'.$i.'": {
            "Title": "Magazine '.$i.'",
            "Author": "Author Name",
            "Publisher": "Publisher Name",
            "Publication Date": 2002
        } 
    }';

    $res = create_document($proyecto, $coleccion, $data);
    if (!is_null($res)) {
        echo '<br>Insersión exitosa<br>';
    } else {
        echo '<br>Insersión fallida<br>';
    }
}

//MANGA
for ($i = 1; $i <= 3; $i++) {
    $data = '{
        "MAN00'.$i.'": {
            "Title": "Manga '.$i.'",
            "Author": "Author Name",
            "Publisher": "Publisher Name",
            "Publication Date": 2002
        } 
    }';

    $res = create_document($proyecto, $coleccion, $data);
    if (!is_null($res)) {
        echo '<br>Insersión exitosa<br>';
    } else {
        echo '<br>Insersión fallida<br>';
    }
}

//NEWSPAPER
for ($i = 1; $i <= 3; $i++) {
    $data = '{
        "NWP00'.$i.'": {
            "Title": "Newspaper '.$i.'",
            "Author": "Author Name",
            "Publisher": "Publisher Name",
            "Publication Date": 2002
        } 
    }';

    $res = create_document($proyecto, $coleccion, $data);
    if (!is_null($res)) {
        echo '<br>Insersión exitosa<br>';
    } else {
        echo '<br>Insersión fallida<br>';
    }
}