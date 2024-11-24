<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIOSKO HOME</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="flex columnDiv centerDiv centerText">
        <h1 class="kioskoHome noMargin">KIOSKO</h1>
        <div class="vr"></div>
    </div>
    <div class="flex mainDiv">
        <div class="sidebar flex columnDiv">
            <?php
            require_once 'menuTools.php';
            $menu = new menu\MenuTools;
            $menu->mainMenu();
            ?>
        </div>
        <div class="mainContent flex columnDiv">
            <!--FIRST LINE-->
            <div>
                <p class="title noMargin">New Books</p>
                <div class="flex spaceRow">
                    <?php

                    require_once 'MyFirebase.php';

                    use MyFirebase\Firebase as Fb;

                    $project = 'myfirebase-a99eb-default-rtdb';
                    $firebase = new Fb($project);
                    $document = 'Books';

                    $res = $firebase->getProducts($document);
                    $cProd = 0;
                    if (!is_null($res)) {
                        foreach ($res as $key => $value) {
                            $cProd++;
                        }

                        $onlyFive = $cProd - 5;
                        for ($i = $cProd; $i > $onlyFive; $i--) {
                            $code = 'BOK00' . $i;
                            $title = $res[$code];

                            echo '<div class="flex columnDiv centerDiv centerText contCover">';
                            
                            //img
                            $ruta_imagen = "img/" . $code . ".jpg";
                            if (file_exists($ruta_imagen) && is_file($ruta_imagen)) {
                                // Si existe, mostramos la imagen
                                echo "<img class='cover' src='$ruta_imagen'>";
                            } else {
                                // Si no existe, mostramos un mensaje
                                echo '<img class="cover" src="img/null.png">';
                            }
                            
                            echo "<form action='prodDet.php' method='post'>";
                            echo "<input class='link textCover' type='submit' value=\"".htmlspecialchars($title)."\">";
                            echo "<input type='hidden' name='productId' value='".$code."'>";
                            echo "</form>";

                            echo '</div>';
                        }
                    } else {
                        echo '<br>No se encontraron resultados<br>';
                    }
                    ?>
                </div>
            </div>
            <!--BANNER-->
            <div>
                <a href="newProd.php"><img class="banner" src="alt-img/banner1.jpg" alt=""></a>
            </div>

            <div>
            <p class="title noMargin">Comics</p>
                <div class="flex spaceRow">
                    <?php
                    $document = 'Comics';

                    $res = $firebase->getProducts($document);
                    $cProd = 0;
                    if (!is_null($res)) {
                        foreach ($res as $key => $value) {
                            $cProd++;
                        }

                        for ($i=1; $i <=5; $i++) {
                            $code = 'COM00' . $i;
                            if(!is_null($res[$code])){
                                $title = $res[$code];

                            echo '<div class="flex columnDiv centerDiv centerText contCover">';
                            //img
                            $ruta_imagen = "img/" . $code . ".jpg";
                            if (file_exists($ruta_imagen) && is_file($ruta_imagen)) {
                                // Si existe, mostramos la imagen
                                echo "<img class='cover' src='$ruta_imagen'>";
                            } else {
                                // Si no existe, mostramos un mensaje
                                echo '<img class="cover" src="img/null.png">';
                            }
                            
                            echo "<form class'contCover' action='prodDet.php' method='post'>";
                            echo "<input class='link textCover' type='submit' value=\"".htmlspecialchars($title)."\">";
                            echo "<input type='hidden' name='productId' value='".$code."'>";
                            echo "</form>";

                            echo '</div>';
                            }
                            
                        }
                    } else {
                        echo '<br>No se encontraron resultados<br>';
                    }
                    ?>
                </div>
            </div>

            <!--BANNER-->
            <div>
                <a href="userNWP.php"><img class="banner" src="alt-img/banner2.jpg" alt=""></a>
            </div>

            <div>
            <p class="title noMargin">Magazines</p>
                <div class="flex spaceRow">
                    <?php
                    $document = 'Magazines';

                    $res = $firebase->getProducts($document);
                    $cProd = 0;
                    if (!is_null($res)) {
                        foreach ($res as $key => $value) {
                            $cProd++;
                        }

                        for ($i=1; $i <=5; $i++) {
                            $code = 'MAG00' . $i;
                            if(!is_null($res[$code])){
                                $title = $res[$code];

                            echo '<div class="flex columnDiv centerDiv centerText contCover">';
                            //img
                            $ruta_imagen = "img/" . $code . ".jpg";
                            if (file_exists($ruta_imagen) && is_file($ruta_imagen)) {
                                // Si existe, mostramos la imagen
                                echo "<img class='cover' src='$ruta_imagen'>";
                            } else {
                                // Si no existe, mostramos un mensaje
                                echo '<img class="cover" src="img/null.png">';
                            }
                            
                            echo "<form class'contCover' action='prodDet.php' method='post'>";
                            echo "<input class='link textCover' type='submit' value=\"".htmlspecialchars($title)."\">";
                            echo "<input type='hidden' name='productId' value='".$code."'>";
                            echo "</form>";

                            echo '</div>';
                            }
                            
                        }
                    } else {
                        echo '<br>No se encontraron resultados<br>';
                    }
                    ?>
                </div>
            </div>

            <!--
            <div>
                <p class="title noMargin">New Books</p>
                <div class="flex spaceRow">
                    <div class="flex columnDiv centerDiv centerText">
                        <img class="cover" src="img/null.png" alt="">
                        <a class="link" href="">Lorem ipsum dolor</a>
                    </div>

                    <div class="flex columnDiv centerDiv centerText">
                        <img class="cover" src="img/null.png" alt="">
                        <a class="link" href="">Lorem ipsum dolor</a>
                    </div>

                    <div class="flex columnDiv centerDiv centerText">
                        <img class="cover" src="img/null.png" alt="">
                        <a class="link" href="">Lorem ipsum dolor</a>
                    </div>
                    <div class="flex columnDiv centerDiv centerText">
                        <img class="cover" src="img/null.png" alt="">
                        <a class="link" href="">Lorem ipsum dolor</a>
                    </div>

                    <div class="flex columnDiv centerDiv centerText">
                        <img class="cover" src="img/null.png" alt="">
                        <a class="link" href="">Lorem ipsum dolor</a>
                    </div>
                </div>
            </div>
            -->
        </div>

    </div>
</body>

</html>