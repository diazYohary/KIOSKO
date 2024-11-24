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
$data = '{
    "BOK001": {
        "Title": "Pedro Páramo",
        "Author": "Juan Rulfo",
        "Publisher": "Ediciones Cátedra",
        "Publication Date": 2023
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
/***************** */
$data = '{
    "BOK002": {
        "Title": "Crime and Punishment",
        "Author": "Fyodor Dostoyevsky",
        "Publisher": "Penguin Classics",
        "Publication Date": 2002
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
/***************** */
$data = '{
    "BOK003": {
        "Title": "La Biblioteca De La Medianoche",
        "Author": "Matt Haig",
        "Publisher": "Alianza de Novela",
        "Publication Date": 2021
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
/***************** */
$data = '{
    "BOK004": {
        "Title": "Metamorfosis",
        "Author": "Franz Kafkan",
        "Publisher": "Editores Mexicanos Unidos",
        "Publication Date": 2020
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}

/***************** */
$data = '{
    "BOK005": {
        "Title": "El gran Gatsby ",
        "Author": "Francis Scott Fitzgerald",
        "Publisher": "Editorial Planeta Mexicana, S.A. de C.V.;",
        "Publication Date": 2021
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
/***************** */
$data = '{
    "BOK006": {
        "Title": "La tregua",
        "Author": "Mario Benedetti",
        "Publisher": "Penguin Random House Grupo Editorial SA de CV",
        "Publication Date": 2019
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
/***************** */
$data = '{
    "BOK007": {
        "Title": "Neuromancer",
        "Author": "William Gibson",
        "Publisher": "Ace",
        "Publication Date": 1984
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}

/***************** */
$data = '{
    "BOK008": {
        "Title": "The Last Unicorn",
        "Author": "Peter S. Beagle",
        "Publisher": "Ace",
        "Publication Date": 1991
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
/***************** */
$data = '{
    "BOK009": {
        "Title": "The Poisonwood Bible: A Novel",
        "Author": "Barbara Kingsolver",
        "Publisher": "Harper Perennial Modern Classics",
        "Publication Date": 2008
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
//******************* */
$data = '{
    "COM001": {
        "Title": "Batman #13",
        "Author": "Tini Howard",
        "Publisher": "Editorial Panini",
        "Publication Date": 2024
    } 
}';
$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
//******************* */
$data = '{
    "COM002": {
        "Title": "Ultimate Spider-Man Vol.01",
        "Author": "Jonathan Hickman",
        "Publisher": "Editorial Panini",
        "Publication Date": 2024
    } 
}';
$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
//******************* */
$data = '{
    "COM003": {
        "Title": "The Complete Emily the Strange: All Things Strange",
        "Author": "Rob Reger",
        "Publisher": "Dark Horse Books",
        "Publication Date": 2021
    } 
}';
$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
//******************* */
$data = '{
    "COM004": {
        "Title": "Fahrenheit 451",
        "Author": "Ray Bradbury",
        "Publisher": "Penguin Random House Grupo Editorial",
        "Publication Date": 2023
    } 
}';
$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
//******************* */
$data = '{
    "COM005": {
        "Title": "Batman the Killing Joke",
        "Author": "Alan Moore",
        "Publisher": "DC Comics",
        "Publication Date": 2019
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
//******************* */
$data = '{
    "COM006": {
        "Title": "Watchmen",
        "Author": "Alan Moore",
        "Publisher": "DC Comics",
        "Publication Date": 2013
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
//******************* */
$data = '{
    "COM007": {
        "Title": "Spawn Compendium Volume 6",
        "Author": "Paul Jenkins",
        "Publisher": "Image Comics",
        "Publication Date": 2024
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
//MAGAZINES
/**************** */
$data = '{
    "MAG001": {
        "Title": "LIFE 11-23-1936",
        "Author": "Author",
        "Publisher": "LIFE",
        "Publication Date": 1936
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
/**************** */
$data = '{
    "MAG002": {
        "Title": "ROLLING STONE #199",
        "Author": "Author",
        "Publisher": "ROLLING STONE",
        "Publication Date": 2020
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
/**************** */
$data = '{
    "MAG003": {
        "Title": "TRASHER Magazine",
        "Author": "Author",
        "Publisher": "TRASHER Publisher",
        "Publication Date": 2022
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
/**************** */
$data = '{
    "MAG004": {
        "Title": "Vogue USA Magazine May 2024 Zendaya",
        "Author": "VOGUE",
        "Publisher": "VOGUE",
        "Publication Date": 2022
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
/**************** */
$data = '{
    "MAG005": {
        "Title": "Time Magazine May 27, 2024",
        "Author": "Time",
        "Publisher": "Time",
        "Publication Date": 2024
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
//MANGA

//////////////////////////////
$data = '{
    "MAN001": {
        "Title": "Berserk N.16",
        "Author": "Kentaro Miura",
        "Publisher": "Editorial Panini",
        "Publication Date": 2018
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
//////////////////////////////
$data = '{
    "MAN002": {
        "Title": "Spy X Family N.3",
        "Author": "Tatsuya Endō",
        "Publisher": "Editorial Panini",
        "Publication Date": 2021
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}

//////////////////////////////
$data = '{
    "MAN003": {
        "Title": "Chain Saw Man N.17",
        "Author": "Tatsuki Fujimoto",
        "Publisher": "Editorial Panini",
        "Publication Date": 2024
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}

//////////////////////////////
$data = '{
    "MAN004": {
        "Title": "Demon Slayer N.1 ",
        "Author": " Koyoharu Gotouge",
        "Publisher": "Editorial Panini",
        "Publication Date": 2020
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}
//////////////////////////////
$data = '{
    "MAN005": {
        "Title": "One Punch Man - N.30",
        "Author": "ONE",
        "Publisher": "Editorial Panini",
        "Publication Date": 2024
    } 
}';

$res = create_document($proyecto, $coleccion, $data);
if (!is_null($res)) {
    echo '<br>Insersión exitosa<br>';
} else {
    echo '<br>Insersión fallida<br>';
}



//NEWSPAPER
for ($i = 1; $i <= 13; $i++) {
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